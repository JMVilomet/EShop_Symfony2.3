<?php
/*
 * This file is part of the EShop application.
 *
 * (c) Jean-Michel VILOMET <jmvilomet@faeryscape.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace EShop\BoutiqueBundle\Controller;

use DateTime;
use EShop\BoutiqueBundle\Entity\article;
use EShop\BoutiqueBundle\Entity\Livraison;
use EShop\BoutiqueBundle\Entity\LivraisonPanier;
use Swift_Image;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;

class DefaultController extends Controller
{
    /**
     * Affiche la énième page du catalogue
     * @param type $page    page à visualiser
     */
    public function catalogueAction($page)
    {
        // init doctrine
        $em = $this->getDoctrine()->getManager();
        $article = new article();
        $er = $em->getRepository("EShopBoutiqueBundle:article");

        // traitement de la pagination
        $pagination = $this->container->getParameter('e_shop_boutique.pagination');
        $dernierePage = $er->findLastPage($pagination);
        if ($page==0)   
            $page = 1;
        if ($page>=$dernierePage){
            $suivante = $page = $dernierePage;
        }else{
            $suivante = $page+1;
        }
        if ($page<=1){
            $precedente = $page = 1;
        }else{
            $precedente = $page-1;
        }
        
        // affichage des produits de la page en cours
        $produits = $er->findBy(array("enligne"=>1),array("designation"=>"ASC"),$pagination,$pagination*($page-1));
        $dernierProduit = $er->findLastAdded();
        
        // Affichage de la popin à la première connexion
        // Inactivation par la création d'un cookie
        $request = $this->getRequest();
        if ($request->cookies->get("Eshop_Symfony_shown")==1){
            $montreAlerte = false;
        }else{
            $montreAlerte = true;
            $cookie = new Cookie("Eshop_Symfony_shown",1);
        }
        
        // Le service panier initialise également la session
        $eSPanier = $this->get('e_shop_boutique.panier');

        // Récupération du panier puis des désignations des articles
        $panier = $eSPanier->lister();
        foreach ($panier as $id=>&$values){
            $article = $er->find($id);
            $values["designation"] = $article->getDesignation();
        }
        
        // Vue
        $twigParam = array(
            "nouveau_produit" => $dernierProduit,
            "produits" => $produits,
            "montreAlerte" => $montreAlerte,
            "page" => $page,
            "precedente" => $precedente,
            "suivante" => $suivante,
            "derniere" => $dernierePage,
            "tva" => $this->container->getParameter('e_shop_boutique.tva'),
            "panier" => $panier,
            "panier_total" => $eSPanier->total($this->container->getParameter('e_shop_boutique.tva')),
        );
        $render = $this->render('EShopBoutiqueBundle:Default:catalogue.html.twig',$twigParam);
        
        // Positionne le cookie le cas échéant
        if (isset($cookie)){
            $render->headers->setCookie($cookie);
        }
        
        return $render;
    }

    /**
     * Affiche la page de commande (panier+saisie de coordonnées)
     * En appel POST: sauvegarde la commande en base et envoi un email au client
     */
    public function commanderAction()
    {
        // Récupération du panier
        $esPanier = $this->get('e_shop_boutique.panier');
        $panier = $esPanier->lister();
        // doctrine
        $em = $this->getDoctrine()->getManager();
        $emrA = $em->getRepository("EShopBoutiqueBundle:article");
        $livraison = new Livraison();
        
        // Récupération des désignations des articles
        foreach ($panier as $id=>&$values){
            $article = $emrA->find($id);
            $values["designation"] = $article->getDesignation();
        }

        // Initialisation d'options standard pour les champs de formulaire
        $defaultOpt = array(
            'required'=>false,
            'label_attr'=>array('class'=>'control-label'),
            'attr'=>array(
                'class'=>'form-control',
                )
            );
        $fbuilder = $this->createFormBuilder($livraison);
        // Ajout des champs du formulaire
        // Rajout des paramètres de validation de la librairie JS tierce
        $fbuilder->add('email','email',$defaultOpt+array(
                        'label'=>'Email :',
                       ))
                ->add('nom','text',$defaultOpt+array(
                        'label'=>'Nom :',
                    ))
                ->add('prenom','text',$defaultOpt+array(
                        'label'=>'Prénom :',
                    ))
                ->add('adresse','text',$defaultOpt+array(
                        'label'=>'Adresse :',
                    ))
                ->add('cp','text',$defaultOpt+array(
                        'label'=>'Code postal :',
                    ))
                ->add('ville','text',$defaultOpt+array(
                        'label'=>'Ville :',
                    ))
                ->add('departement','entity',$defaultOpt+array(    
                        'label'=>'Département :',
                        'class' => 'EShopBoutiqueBundle:Departement',
                        'property' => 'Departement',
                        'empty_value' => "Choisissez ...",
                    ));
        $form = $fbuilder->getForm();
        $request = $this->getRequest();
        
        if ($request->getMethod()=="POST"){
            $form->handleRequest($request);
            if ($form->isValid()){
                // Protection contre le refresh navigateur : redirection accueil
                if ($esPanier->vide() or $esPanier->traite()){
                    return $this->redirect($this->generateUrl("e_shop_boutique_accueil"));
                }
                $livraison->setDateCommande(new DateTime());
                $em->persist($livraison);
                $em->flush();
                foreach($panier as $idArticle=>$ligne){
                    $article = $emrA->find($idArticle);
                    // Si le panier contient des articles inexistants
                    // On annule la commande, on vide la panier et on redirige
                    // vers l'accueil
                    if ($article==null){
                        $livraison->setLivree(null);
                        $em->persist($livraison);
                        $em->flush();
                        return $this->redirect($this->generateUrl("e_shop_boutique_accueil"));
                    }else{
                    // Sinon sauvegarde de la ligne de panier dans la base    
                        $lPanier = new LivraisonPanier();
                        $lPanier->setArticle($article);
                        $lPanier->setLivraison($livraison);
                        $lPanier->setPuht($ligne["puht"]);
                        $lPanier->setQuantite($ligne["quantite"]);
                        $em->persist($lPanier);
                        $em->flush();
                    }
                }
                // Envoi de l'email récapitulatif au client
                $mailer = $this->get("mailer");
                $message = Swift_Message::newInstance();
                $path = $this->get('kernel')->getRootDir().'/../web/bundles/eshopboutique/images/logo.jpg';
                $cid = $message->embed(Swift_Image::fromPath($path));
                        
                $mail_param = array(
                    "prenom"    => $livraison->getPrenom(),
                    "nom"       => $livraison->getNom(),
                    "reference" => $livraison->getId(),
                    "panier"    => $panier,
                    "cid"       => $cid,
                );

                $message->setSubject('Votre commande')
                        ->setFrom(array('commandes@eshop.com'=>'EShop'))
                        ->setTo(array($livraison->getEmail()=>$livraison->getPrenom().' '.$livraison->getNom()))
                        ->setBody($this->renderView('EShopBoutiqueBundle:Mail:confirmation.txt.twig',$mail_param ))
                        ->addPart($this->renderView('EShopBoutiqueBundle:Mail:confirmation.html.twig',$mail_param ), 'text/html');
                        
                $this->get('mailer')->send($message);
                // On flaggue le panier comme "traité"
                $esPanier->traiter();
                // On génère un récapitulatif
                return $this->forward('EShopBoutiqueBundle:Default:recapitulatif',array("commandeId"=>$livraison->getId()));
            }
        }
        
        // Vue
        $twigParam = array(
                'panier' => $panier,
                'panier_total' => $esPanier->total($this->container->getParameter('e_shop_boutique.tva')),
                'panier_visible' => 1,
                'form' => $form->createView(),
        );
        return $this->render("EShopBoutiqueBundle:Default:commander.html.twig",$twigParam);
    }
    
    public function recapitulatifAction($commandeId){
        if (!$commandeId)
            return $this->redirect($this->generateUrl("e_shop_boutique_accueil"));
        // Récupération du panier
        $esPanier = $this->get('e_shop_boutique.panier');
        $panier = $esPanier->lister();
        // doctrine
        $em = $this->getDoctrine()->getManager();
        $emrA = $em->getRepository("EShopBoutiqueBundle:article");
        
        // Récupération des désignations des articles
        foreach ($panier as $id=>&$values){
            $article = $emrA->find($id);
            $values["designation"] = $article->getDesignation();
        }
        // Vue
        $twigParam = array(
                'panier' => $panier,
                'panier_total' => $esPanier->total($this->container->getParameter('e_shop_boutique.tva')),
                'panier_visible' => 1,
                'commandeId' => $commandeId,
        );
        return $this->render("EShopBoutiqueBundle:Default:recapitulatif.html.twig",$twigParam);
    }

    public function retourAccueilAction(){
        // Récupération du panier
        $esPanier = $this->get('e_shop_boutique.panier');
        // Vidage du panier
        $esPanier->vider();
        // Retour à l'accueil
        return $this->redirect($this->generateUrl("e_shop_boutique_accueil"));
    }
    
}
