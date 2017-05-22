<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cereri
 *
 * @ORM\Table(name="cereri")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CereriRepository")
 */
class Cereri
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nume", type="string", length=200)
     */
    private $nume;

    /**
     * @var int
     *
     * @ORM\Column(name="cnp", type="bigint")
     */
    private $cnp;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="tip", type="string", length=200, nullable=true)
     */
    private $tip;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nume
     *
     * @param string $nume
     *
     * @return Cereri
     */
    public function setNume($nume)
    {
        $this->nume = $nume;

        return $this;
    }

    /**
     * Get nume
     *
     * @return string
     */
    public function getNume()
    {
        return $this->nume;
    }

    /**
     * Set cnp
     *
     * @param integer $cnp
     *
     * @return Cereri
     */
    public function setCnp($cnp)
    {
        $this->cnp = $cnp;

        return $this;
    }

    /**
     * Get cnp
     *
     * @return int
     */
    public function getCnp()
    {
        return $this->cnp;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Cereri
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set tip
     *
     * @param string $tip
     *
     * @return Cereri
     */
    public function setTip($tip)
    {
        $this->tip = $tip;

        return $this;
    }

    /**
     * Get tip
     *
     * @return string
     */
    public function getTip()
    {
        return $this->tip;
    }
}

