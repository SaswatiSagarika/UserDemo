<?php

namespace Sch\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Sch\MainBundle\Repository\ProductRepository")
 */
class Product
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="ProductLineTypes")
     * @ORM\JoinColumn(name="fk_productLineType", referencedColumnName="id")
     */
    private $fkProductLineType;


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
     * @return Product
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
     * Set fkProductLineType
     *
     * @param string $fkProductLineType
     *
     * @return Product
     */
    public function setFkProductLineType($fkProductLineType)
    {
        $this->fkProductLineType = $fkProductLineType;

        return $this;
    }

    /**
     * Get fkProductLineType
     *
     * @return string
     */
    public function getFkProductLineType()
    {
        return $this->fkProductLineType;
    }
}

