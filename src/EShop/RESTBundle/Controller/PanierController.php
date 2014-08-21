<?php
/*
 * This file is part of the EShop application.
 *
 * (c) Jean-Michel VILOMET <jmvilomet@faeryscape.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace EShop\RESTBundle\Controller;

use EShop\BoutiqueBundle\Entity\article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PanierController extends Controller
{
    /**
     * Renvoie le montant TTC du panier et le cas échéant la nouvelle quantité
     * lorsque le controlleur appelant est "changerAction"
     * @param Panier $esPanier    service Panier
     * @param int $quantite    nouvelle quantité
     * @return JsonResponse     retour appel Ajax
     */
    public function retourJSON($esPanier,$quantite=0){
        $total = $esPanier->total($this->container->getParameter('e_shop_boutique.tva'));
        return new JsonResponse(array(number_format($total, 2,',',' '),$quantite));
    }

    /**
     * Renvoie une erreur à l'appel Ajax
     */
    public function retourErreur(){
        new JsonResponse("",500);
    }

    /**
     * Ajout de l'article dont l'id est dans la requête
     * @return JSON
     */
    public function creerAction()
    {
        if (!$this->getRequest()->isXmlHttpRequest())
            return retourErreur();
        // SERVICES
        $esPanier = $this->get("e_shop_boutique.panier");
        $er = $this->getDoctrine()->getManager()->getRepository("EShopBoutiqueBundle:article");
        // RECUPERATION DONNEES
        $id = (int) $this->getRequest()->get('id');
        if ($id==null)
            return retourErreur();
        $article = $er->find($id);
        if ($article==null)
            return retourErreur();
        // ajout dans le panier en cours
        $esPanier->ajouter($id,$article->getPuht(),1);
        return $this->retourJSON($esPanier);
    }

    /**
     * Modification des quantités de l'article dont l'id est dans la requête
     * @return JSON
     */
    public function changerAction()
    {
        if (!$this->getRequest()->isXmlHttpRequest())
            return retourErreur();
        // SERVICES
        $esPanier = $this->get("e_shop_boutique.panier");
        $er = $this->getDoctrine()->getManager()->getRepository("EShopBoutiqueBundle:article");
        // RECUPERATION DONNEES
        $id = (int) $this->getRequest()->get('id');
        $quantite = (int) $this->getRequest()->get('quantite');
        if ($id==null or $quantite<=0)
            return retourErreur();
        $article = $er->find($id);
        if ($article==null)
            return retourErreur();
        // Modification dans le panier en cours
        $esPanier->changer($id,$quantite);
        return $this->retourJSON($esPanier,$quantite);
    }
    
    /**
     * Suppression de l'article dont l'id est dans la requête
     * @return JSON
     */
    public function supprimerAction()
    {
        if (!$this->getRequest()->isXmlHttpRequest())
            return retourErreur();
        // SERVICES
        $esPanier = $this->get("e_shop_boutique.panier");
        $er = $this->getDoctrine()->getManager()->getRepository("EShopBoutiqueBundle:article");
        // RECUPERATION DONNEES
        $id = (int) $this->getRequest()->get('id');
        if ($id==null)
            return retourErreur();
        $article = $er->find($id);
        if ($article==null)
            return retourErreur();
        // Suppression dans le panier en cours
        $esPanier->supprimer($id);
        return $this->retourJSON($esPanier);
    }
}
