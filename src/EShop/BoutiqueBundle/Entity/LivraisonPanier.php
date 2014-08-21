<?php

namespace EShop\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LivraisonPanier
 *
 * @ORM\Table(name="livraison_panier", indexes={@ORM\Index(name="FK_LIVRAISON_PANIER", columns={"livraison_id"}), @ORM\Index(name="FK_LIVRAISON_ARTICLE", columns={"article_id"})})
 * @ORM\Entity
 */
class LivraisonPanier
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="puht", type="float", precision=10, scale=0, nullable=false)
     */
    private $puht;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \Livraison
     *
     * @ORM\ManyToOne(targetEntity="Livraison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="livraison_id", referencedColumnName="id")
     * })
     */
    private $livraison;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="cascade")
     * })
     */
    private $article;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set puht
     *
     * @param float $puht
     * @return LivraisonPanier
     */
    public function setPuht($puht)
    {
        $this->puht = $puht;

        return $this;
    }

    /**
     * Get puht
     *
     * @return float 
     */
    public function getPuht()
    {
        return $this->puht;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return LivraisonPanier
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set livraison
     *
     * @param \EShop\BoutiqueBundle\Entity\Livraison $livraison
     * @return LivraisonPanier
     */
    public function setLivraison(\EShop\BoutiqueBundle\Entity\Livraison $livraison = null)
    {
        $this->livraison = $livraison;

        return $this;
    }

    /**
     * Get livraison
     *
     * @return \EShop\BoutiqueBundle\Entity\Livraison 
     */
    public function getLivraison()
    {
        return $this->livraison;
    }

    /**
     * Set article
     *
     * @param \EShop\BoutiqueBundle\Entity\Article $article
     * @return LivraisonPanier
     */
    public function setArticle(\EShop\BoutiqueBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \EShop\BoutiqueBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
