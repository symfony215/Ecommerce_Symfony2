<?php

namespace Users\UsersBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="utilisateurs")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Users\UsersBundle\Entity\Commandes",mappedBy="user",cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     * */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="Users\UsersBundle\Entity\UsersAdresses",mappedBy="user",cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     * */
    private $adresses;

    public function __construct()
    {
        parent::__construct();
        $this->commandes = new  ArrayCollection();
        $this->adresses = new  ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Add commande
     *
     * @param \Users\UsersBundle\Entity\Commandes $commande
     *
     * @return User
     */
    public function addCommande(Commandes $commande)
    {
        $this->commandes[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \Users\UsersBundle\Entity\Commandes $commande
     */
    public function removeCommande(Commandes $commande)
    {
        $this->commandes->removeElement($commande);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * Add adress
     *
     * @param \Users\UsersBundle\Entity\UsersAdresses $adress
     *
     * @return User
     */
    public function addAdress(UsersAdresses $adress)
    {
        $this->adresses[] = $adress;

        return $this;
    }

    /**
     * Remove adress
     *
     * @param \Users\UsersBundle\Entity\UsersAdresses $adress
     */
    public function removeAdress(UsersAdresses $adress)
    {
        $this->adresses->removeElement($adress);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdresses()
    {
        return $this->adresses;
    }
}
