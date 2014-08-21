<?php

namespace EShop\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="EShop\BoutiqueBundle\Entity\articleRepository")
 */
class article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $designation;

    /**
     * @var decimal
     *
     * @ORM\Column(name="puht", type="decimal", precision=9, scale=2)
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $puht;

    /**
     * @var integer
     *
     * @ORM\Column(name="lot", type="integer")
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $lot;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer")
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $stock;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="categorie", inversedBy="produits")
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     * @Assert\Url(message="Cette URL n'est pas valide")
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="cab", type="string", length=255)
     */
    private $cab;

    /**
     * @var string
     *
     * @ORM\Column(name="enligne", type="boolean")
     */
    private $enligne;

    /**
     *
     * @ORM\Column(name="date_ajout", type="datetime")
     */
    private $date_ajout;
    
    
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
     * Set designation
     *
     * @param string $designation
     * @return article
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string 
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set puht
     *
     * @param string $puht
     * @return article
     */
    public function setPuht($puht)
    {
        $this->puht = $puht;

        return $this;
    }

    /**
     * Get puht
     *
     * @return string 
     */
    public function getPuht()
    {
        return $this->puht;
    }

    /**
     * Set lot
     *
     * @param integer $lot
     * @return article
     */
    public function setLot($lot)
    {
        $this->lot = $lot;

        return $this;
    }

    /**
     * Get lot
     *
     * @return integer 
     */
    public function getLot()
    {
        return $this->lot;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return article
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set categorie
     *
     * @param integer $categorie
     * @return article
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return integer 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return article
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set cab
     *
     * @param string $cab
     * @return article
     */
    public function setCab($cab)
    {
        $this->cab = $cab;

        return $this;
    }

    /**
     * Get cab
     *
     * @return string 
     */
    public function getCab()
    {
        return $this->cab;
    }

    /**
     * Set enligne
     *
     * @param boolean $enligne
     * @return article
     */
    public function setEnligne($enligne)
    {
        $this->enligne = $enligne;

        return $this;
    }

    /**
     * Get enligne
     *
     * @return boolean 
     */
    public function getEnligne()
    {
        return $this->enligne;
    }

    /**
     * Set date_ajout
     *
     * @param \DateTime $dateAjout
     * @return article
     */
    public function setDateAjout($dateAjout)
    {
        $this->date_ajout = $dateAjout;

        return $this;
    }

    /**
     * Get date_ajout
     *
     * @return \DateTime 
     */
    public function getDateAjout()
    {
        return $this->date_ajout;
    }
}
