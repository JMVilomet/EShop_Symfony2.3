<?php

namespace EShop\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison", indexes={@ORM\Index(name="FK_LIVRAISON_DPT", columns={"departement"})})
 * @ORM\Entity
 */
class Livraison
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Assert\Email(message="Cette adresse email n'est pas valide.")
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=5, nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     * @Assert\Regex(pattern="/\d{5}/",match=true,message="Ce code postal doit comporter 5 chiffres.")
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $ville;

    /**
     * @var boolean
     *
     * @ORM\Column(name="livree", type="boolean", nullable=true)
     */
    private $livree = '0';

    /**
     * @var \Departement
     *
     * @ORM\ManyToOne(targetEntity="Departement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="departement", referencedColumnName="id")
     * })
     * @Assert\NotBlank(message="Ce champs est obligatoire.")
     */
    private $departement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dateCommande", type="datetime", nullable=false)
     */
    private $dateCommande = '0';

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
     * Set nom
     *
     * @param string $nom
     * @return Livraison
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Livraison
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Livraison
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Livraison
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Livraison
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Livraison
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set livree
     *
     * @param boolean $livree
     * @return Livraison
     */
    public function setLivree($livree)
    {
        $this->livree = $livree;

        return $this;
    }

    /**
     * Get livree
     *
     * @return boolean 
     */
    public function getLivree()
    {
        return $this->livree;
    }

    /**
     * Set departement
     *
     * @param \EShop\BoutiqueBundle\Entity\Departement $departement
     * @return Livraison
     */
    public function setDepartement(\EShop\BoutiqueBundle\Entity\Departement $departement = null)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \EShop\BoutiqueBundle\Entity\Departement 
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     * @return Livraison
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime 
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }
}
