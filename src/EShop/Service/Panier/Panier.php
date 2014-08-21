<?php
/*
 * This file is part of the EShop application.
 *
 * (c) Jean-Michel VILOMET <jmvilomet@faeryscape.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */
namespace Eshop\Service\Panier;
    
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Service de gestion de panier
 * Permet la manipulation du contenu du panier et assure sa persistence en
 * session
 */
class Panier {
    
    private $session;
    private $panier;
    private $traite;
    
    /**
     * Initialise le panier en cours à partir du contenu de la session
     * @param $session  session en cours
     */
    public function __construct(Session $session) {
        $this->session = $session;
        $this->session->start();
        $this->charger();
    }

    /**
     * Ajoute un article dans la panier
     * @param string $id        identifiant de l'article (code article, reférence)
     * @param float $puht       prix unitaire hors taxe de l'article
     * @param int $quantite     quantité à rajouter dans le panier
     */
    public function ajouter($id,$puht,$quantite=1){
        // si existe deja, alors oldQuantite+quantite
        $this->charger();
        $this->traite = false;
        if (isset($this->panier["$id"])){
            $this->panier["$id"]["quantite"] = $this->panier["$id"]["quantite"]+$quantite; 
        }else{
            $this->panier["$id"] = array ("quantite"=>$quantite, "puht" => $puht);
        }
        $this->sauver();
    }
    
    /**
     * Enlever une quantité à un article dans la panier
     * @param string $id        identifiant de l'article (code article, reférence)
     * @param int $quantite     quantité à enlever dans le panier (si quantité finale=0, supprimé)
     */
    public function enlever($id,$quantite=1){
        // si existe deja, alors oldQuantite+quantite
        $this->charger();
        $this->traite = false;
        if (isset($this->panier["$id"])){
            $this->panier["$id"]["quantite"] = $this->panier["$id"]["quantite"]-$quantite; 
            $this->sauver();
            if ($this->panier["$id"]["quantite"]<=0)
                $this->supprimer($id);
        }
    }

    /**
     * Modifie la quantité d'un article stocké dans le panier
     * @param string $id        identifiant de l'article (code article, reférence)
     * @param int $quantite     nouvelle quantité
     */
    public function changer($id,$quantite){
        $this->charger();
        $this->traite = false;
        if (isset($this->panier["$id"])){
            $this->panier["$id"]["quantite"] = $quantite; 
        }
        $this->sauver();
    }
    
    /**
     * Supprime un article du panier
     * @param string $id        identifiant de l'article (code article, reférence)
     */
    public function supprimer($id){
        $this->charger();
        $this->traite = false;
        if (isset($this->panier["$id"])){
            unset($this->panier["$id"]); 
        }
        $this->sauver();
    }

    /**
     * Renvoie le contenu du panier
     * @return array        tableau associatif du contenu
     */
    public function lister(){
        $this->charger();
        return $this->panier;
    }

    /**
     * Renvoie la quantité d'un article dans la panier
     * @param string $id        identifiant de l'article (code article, reférence)
     * @return int              la quantité ou null si l'article n'existe pas
     */
    public function quantite($id){
        $this->charger();
        if (isset($this->panier["$id"])){
            return $this->panier["$id"];
        }
        else
        {
            return null;
        }
    }
    
    /**
     * Renvoie le prix total du panier
     * @param float $tva        le taux de tva à appliquer (20%=1.2)
     * @return float            le prix total TTC (HT si $tva=1)
     */
    public function total($tva=1){
        $this->charger();
        $total = 0;
        foreach($this->panier as $id=>$donnees){
            $total += $donnees["quantite"]*$donnees["puht"]*$tva;
        }
        return $total;
    }
    
    /**
     * Vide le contenu du panier
     */
    public function vider(){
        $this->panier = array();
        $this->traite = false;
        $this->sauver();
    }
    
    /**
     * Renvoie vrai si le panier est vide
     */
    public function vide(){
        return (count($this->panier)==0);
    }

    /**
     * Marque le panier comme ayant été traité
     */
    public function traiter(){
        $this->traite = true;
        $this->sauver();
    }

    /**
     * Renvoie vrai si le panier est marqué comme traité
     */
    public function traite(){
        return $this->traite;
    }

    /**
     * Sauve le contenu du panier en session
     */
    private function sauver(){
        $this->session->set("panier", serialize($this->panier));
        $this->session->set("panierTraite", serialize($this->traite));
    }
    
    /**
     * Restore le contenu du panier depuis la session
     */
    private function charger(){
        $panier = $this->session->get("panier");
        $panierTraite =  $this->session->get("panierTraite");
        if ($panier){
            $this->panier = unserialize($panier);
            $this->traite = unserialize($panierTraite);
        }
        else
        {    
            $this->traite = false;
            $this->vider();
        }
    }
    
}