<?php

namespace EShop\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departement
 *
 * @ORM\Table(name="departement")
 * @ORM\Entity
 */
class Departement
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
     * @ORM\Column(name="numero", type="string", length=3, nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="Departement", type="string", length=255, nullable=true)
     */
    private $departement;

    /**
     * @var string
     *
     * @ORM\Column(name="Prefecture", type="string", length=255, nullable=true)
     */
    private $prefecture;

    /**
     * @var string
     *
     * @ORM\Column(name="Region", type="string", length=255, nullable=true)
     */
    private $region;



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
     * Set numero
     *
     * @param string $numero
     * @return Departement
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set departement
     *
     * @param string $departement
     * @return Departement
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return string 
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set prefecture
     *
     * @param string $prefecture
     * @return Departement
     */
    public function setPrefecture($prefecture)
    {
        $this->prefecture = $prefecture;

        return $this;
    }

    /**
     * Get prefecture
     *
     * @return string 
     */
    public function getPrefecture()
    {
        return $this->prefecture;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Departement
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }
}
