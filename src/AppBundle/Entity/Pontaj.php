<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pontaj
 *
 * @ORM\Table(name="pontaj")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PontajRepository")
 */
class Pontaj
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
     * @ORM\Column(name="luna", type="string", length=250, nullable=true)
     */
    private $luna;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=200)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="nr_ore", type="bigint", nullable=true)
     */
    private $nrOre;


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
     * Set luna
     *
     * @param string $luna
     *
     * @return Pontaj
     */
    public function setLuna($luna)
    {
        $this->luna = $luna;

        return $this;
    }

    /**
     * Get luna
     *
     * @return string
     */
    public function getLuna()
    {
        return $this->luna;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Pontaj
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
     * Set nrOre
     *
     * @param integer $nrOre
     *
     * @return Pontaj
     */
    public function setNrOre($nrOre)
    {
        $this->nrOre = $nrOre;

        return $this;
    }

    /**
     * Get nrOre
     *
     * @return int
     */
    public function getNrOre()
    {
        return $this->nrOre;
    }
}

