<?php

namespace Sch\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductLineTypes
 *
 * @ORM\Table(name="product_line_types")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Sch\MainBundle\Repository\ProductLineTypesRepository")
 */
class ProductLineTypes
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="ProductLines")
     * @ORM\JoinColumn(name="fk_productLine", referencedColumnName="id")
     */
    private $fkProductLine;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="ProductTypes")
     * @ORM\JoinColumn(name="fk_productType", referencedColumnName="id")
     */
    private $fkProductType;


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
     * Set fkProductLine
     *
     * @param integer $fkProductLine
     *
     * @return ProductLineTypes
     */
    public function setFkProductLine($fkProductLine)
    {
        $this->fkProductLine = $fkProductLine;

        return $this;
    }

    /**
     * Get fkProductLine
     *
     * @return int
     */
    public function getFkProductLine()
    {
        return $this->fkProductLine;
    }

    /**
     * Set fkProductType
     *
     * @param integer $fkProductType
     *
     * @return ProductLineTypes
     */
    public function setFkProductType($fkProductType)
    {
        $this->fkProductType = $fkProductType;

        return $this;
    }

    /**
     * Get fkProductType
     *
     * @return int
     */
    public function getFkProductType()
    {
        return $this->fkProductType;
    }
}

