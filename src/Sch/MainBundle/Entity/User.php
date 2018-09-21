<?php

namespace Sch\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="User")
 * @ORM\Entity(repositoryClass="Sch\MainBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="last", type="string", length=255)
     */
    private $last;

    /**
     * @var string
     *
     * @ORM\Column(name="otp", type="string", length=20, nullable=true)
     */
    private $otp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update_date_time", type="datetime", nullable=true)
     */
    private $lastUpdateDateTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date_time", type="datetime", nullable=true)
     */
    private $createdDateTime;

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
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set last
     *
     * @param string $last
     *
     * @return User
     */
    public function setLast($last)
    {
        $this->last = $last;

        return $this;
    }

    /**
     * Get last
     *
     * @return string
     */
    public function getLast()
    {
        return $this->last;
    }

    /**
     * Set otp
     *
     * @param string $otp
     *
     * @return User
     */
    public function setOtp($otp)
    {
        $this->otp = $otp;

        return $this;
    }

    /**
     * Get otp
     *
     * @return string
     */
    public function getOtp()
    {
        return $this->otp;
    }

    /**
     * Set lastUpdateDateTime
     *
     * @param \DateTime $lastUpdateDateTime
     * @return User
     */
    public function setLastUpdateDateTime($lastUpdateDateTime)
    {
        $this->lastUpdateDateTime = $lastUpdateDateTime;

        return $this;
    }

    /**
     * Get lastUpdateDateTime
     *
     * @return \DateTime 
     */
    public function getLastUpdateDateTime()
    {
        return $this->lastUpdateDateTime;
    }

    /**
     * Set createdDateTime
     *
     * @param \DateTime $createdDateTime
     * @return User
     */
    public function setCreatedDateTime($createdDateTime)
    {
        $this->createdDateTime = $createdDateTime;

        return $this;
    }

    /**
     * Get createdDateTime
     *
     * @return \DateTime 
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

     /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created_date_time = new \DateTime();
    }
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->last_update_date_time = new \DateTime();
    }
}

