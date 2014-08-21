<?php
/*
 * This file is part of the EShop application.
 *
 * (c) Jean-Michel VILOMET <jmvilomet@faeryscape.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */
 
namespace EShop\AdminBundle\Controller;

use EShop\BoutiqueBundle\Entity\Livraison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * 
     * Page d'accueil
     */
    public function indexAction()
    {
        return $this->render('EShopAdminBundle:Default:index.html.twig');
    }
    
    /**
     * 
     * Page de liste de commande
     */
    public function commandeAction()
    {
        $livraison = new Livraison();
        $em = $this->getDoctrine()->getManager();
        $lr = $em->getRepository("EShopBoutiqueBundle:Livraison");
        $lpr = $em->getRepository("EShopBoutiqueBundle:LivraisonPanier");
        
        $commandes = $lr->findAll();

        $paniers = array();
        foreach($commandes as &$commande){
            $paniers[$commande->getId()] = $lpr->findBy(array("livraison"=>$commande->getId())); 
        }
        
        $twigParams = array(
            "commandes" => $commandes,
            "paniers" => $paniers,
        );
        return $this->render('EShopAdminBundle:Default:commande.html.twig', $twigParams);
    }
    
    /**
     * 
     * Controlleur de gestion de la bascule de commande "En attente / Traitée" 
     */
    public function basculerAction()
    {
        $livraison = new Livraison();
        $em = $this->getDoctrine()->getManager();
        $ar = $em->getRepository("EShopBoutiqueBundle:Livraison");
        
        $toggle = $this->getRequest()->request->get("toggle");
        if (is_array($toggle)){
            list($idCmd) = array_keys($toggle);
            if (intval($idCmd)>0){
                $livraison = $ar->find($idCmd);
                if ($livraison!=null){
                    $etat = $livraison->getLivree();
                    if ($etat){
                        $livraison->setLivree(0); // En attente
                    }else{
                        $livraison->setLivree(1); // Traitée
                    }
                    $em->persist($livraison);
                    $em->flush();
                }
            }
        }
        // On regénère la page de commande via le controlleur "commande"
        return $this->forward("EShopAdminBundle:Default:commande");
    }
}
