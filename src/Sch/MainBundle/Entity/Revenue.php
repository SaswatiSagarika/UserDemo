<?php

namespace Sch\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Revenue
 *
 * @ORM\Table(name="revenue")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Sch\MainBundle\Repository\RevenueRepository")
 */
class Revenue
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
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="fk_products", referencedColumnName="id")
     */
    private $fkProducts;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="RetailerCountries")
     * @ORM\JoinColumn(name="fk_retailerCountry", referencedColumnName="id")
     */
    private $fkRetailerCountry;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="RetailerTypes")
     * @ORM\JoinColumn(name="fk_retailerType", referencedColumnName="id")
     */
    private $fkRetailerType;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="OrderModes")
     * @ORM\JoinColumn(name="fk_orderMode", referencedColumnName="id")
     */
    private $fkOrderMode;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="smallint", unique=true)
     */
    private $year;

    /**
     * @var int
     *
     * @ORM\Column(name="quarter", type="smallint", unique=true)
     */
    private $quarter;

    /**
     * @var float
     *
     * @ORM\Column(name="revenue", type="float", length=255, unique=true)
     */
    private $revenue;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="grossMargin", type="float", length=255)
     */
    private $grossMargin;


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
     * Set fkProducts
     *
     * @param integer $fkProducts
     *
     * @return Revenue
     */
    public function setFkProducts($fkProducts)
    {
        $this->fkProducts = $fkProducts;

        return $this;
    }

    /**
     * Get fkProducts
     *
     * @return int
     */
    public function getFkProducts()
    {
        return $this->fkProducts;
    }

    /**
     * Set fkRetailerCountry
     *
     * @param integer $fkRetailerCountry
     *
     * @return Revenue
     */
    public function setFkRetailerCountry($fkRetailerCountry)
    {
        $this->fkRetailerCountry = $fkRetailerCountry;

        return $this;
    }

    /**
     * Get fkRetailerCountry
     *
     * @return int
     */
    public function getFkRetailerCountry()
    {
        return $this->fkRetailerCountry;
    }

    /**
     * Set fkRetailerType
     *
     * @param integer $fkRetailerType
     *
     * @return Revenue
     */
    public function setFkRetailerType($fkRetailerType)
    {
        $this->fkRetailerType = $fkRetailerType;

        return $this;
    }

    /**
     * Get fkRetailerType
     *
     * @return int
     */
    public function getFkRetailerType()
    {
        return $this->fkRetailerType;
    }

    /**
     * Set fkOrderMode
     *
     * @param integer $fkOrderMode
     *
     * @return Revenue
     */
    public function setFkOrderMode($fkOrderMode)
    {
        $this->fkOrderMode = $fkOrderMode;

        return $this;
    }

    /**
     * Get fkOrderMode
     *
     * @return int
     */
    public function getFkOrderMode()
    {
        return $this->fkOrderMode;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Revenue
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set quarter
     *
     * @param integer $quarter
     *
     * @return Revenue
     */
    public function setQuarter($quarter)
    {
        $this->quarter = $quarter;

        return $this;
    }

    /**
     * Get quarter
     *
     * @return int
     */
    public function getQuarter()
    {
        return $this->quarter;
    }

    /**
     * Set revenue
     *
     * @param string $revenue
     *
     * @return Revenue
     */
    public function setRevenue($revenue)
    {
        $this->revenue = $revenue;

        return $this;
    }

    /**
     * Get revenue
     *
     * @return string
     */
    public function getRevenue()
    {
        return $this->revenue;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Revenue
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set grossMargin
     *
     * @param string $grossMargin
     *
     * @return Revenue
     */
    public function setGrossMargin($grossMargin)
    {
        $this->grossMargin = $grossMargin;

        return $this;
    }

    /**
     * Get grossMargin
     *
     * @return string
     */
    public function getGrossMargin()
    {
        return $this->grossMargin;
    }
}

