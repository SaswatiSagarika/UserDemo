<?php

namespace Sch\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserPhone
 *
 * @ORM\Table(name="UserPhone")
 * @ORM\Entity(repositoryClass="Sch\MainBundle\Repository\UserPhoneRepository")
 */
class UserPhone
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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string" , length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=true)
     */
    private $status;

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
     * Set user.
     *
     * @param \Sch\MainBundle\Entity\User $user
     *
     * @return UserPhone
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Sch\MainBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return UserPhone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return UserPhone
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set lastUpdateDateTime
     *
     * @param \DateTime $lastUpdateDateTime
     * @return UserPhone
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
     * @return UserPhone
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

