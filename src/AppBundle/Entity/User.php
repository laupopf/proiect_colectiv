<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="This email address is already in use")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    
    protected $email;

    /**
     * @ORM\Column(type="string", length=40)
     */    
    protected $surename;
    
    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $phoneNumber;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $salar;
    
     /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $cerere;
    
    /**
     * @var int
     *
     * @ORM\Column(name="cnp", type="integer", unique=true)
     */
    private $cnp;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nastere", type="datetime")
     */
    private $dataNastere;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_angajare", type="datetime", nullable=true)
     */
    private $dataAngajare;

    /**
     * @var \DateTime
     * @ORM\Column(name="sf_contract", type="datetime", nullable=true)
     */
    private $sfContract;

    /**
     * @var int
     *
     * @ORM\Column(name="pontaj_zi", type="integer", nullable=true)
     */
    private $pontajZi;

    /**
     * @var int
     *
     * @ORM\Column(name="pontaj_luna", type="integer", nullable=true)
     */
    private $pontajLuna;

    
    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $role;

    /**
     * @Assert\Length(max=4096)
     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $password;

    public function eraseCredentials()
    {
        return null;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role = null)
    {
        $this->role = $role;
    }

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSurename($surename)
    {
        $this->surename = $surename;
    }

    public function getSurename()
    {
        return $this->surename;
    }
    
    public function setSalar($salar)
    {
        $this->salar = $salar;
    }

    public function getSalar()
    {
        return $this->salar;
    }
    
    public function setCerere($cerere)
    {
        $this->cerere = $cerere;
    }

    public function getCerere()
    {
        return $this->cerere;
    }
    
    public function getUsername()
    {
        return $this->email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    
     public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function setDataNastere($dataNastere)
    {
        $this->dataNastere = $dataNastere;

        return $this;
    }

    public function getDataNastere()
    {
        return $this->dataNastere;
    }


    public function setDataAngajare($dataAngajare)
    {
        $this->dataAngajare = $dataAngajare;

        return $this;
    }

    public function getDataAngajare()
    {
        return $this->dataAngajare;
    }

    public function setSfContract($sfContract)
    {
        $this->sfContract = $sfContract;

        return $this;
    }

    public function getSfContract()
    {
        return $this->sfContract;
    }

    public function setPontajZi($pontajZi)
    {
        $this->pontajZi = $pontajZi;

        return $this;
    }

    public function getPontajZi()
    {
        return $this->pontajZi;
    }

    public function setPontajLuna($pontajLuna)
    {
        $this->pontajLuna = $pontajLuna;

        return $this;
    }

    public function getPontajLuna()
    {
        return $this->pontajLuna;
    }
    
    public function setCnp($cnp)
    {
        $this->cnp = $cnp;

        return $this;
    }

    public function getCnp()
    {
        return $this->cnp;
    }
    
    public function getSalt()
    {
        return null;
    }
}