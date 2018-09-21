<?php

namespace Sch\MainBundle\Repository;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * RevenueRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RevenueRepository extends \Doctrine\ORM\EntityRepository
{
	 /**
    * 
    * revenueDetails
    * It is used to fetch data from database on given filters.
    *
    * @param array $data array of coloum name and its values
    * @return array $result containing required data.
    */
	public function revenueDetails($value)
	{
		$query = $this->createQueryBuilder('r')
                            ->select('rc.name as RetailerCountry')
                            ->addSelect('rt.name as RetailerType')
                            ->addSelect('om.name as OrderMode')
                            ->addSelect('pl.name as ProductLine')
                            ->addSelect('pt.name as ProductType')
                            ->addSelect('p.name as Product')
                            ->addSelect('r.year as Year')
                            ->addSelect('r.quarter as Quarter')
                            ->addSelect('r.revenue as Revenue')
                            ->addSelect('r.quantity as Quantity')
                            ->addSelect('r.grossMargin as GrossMargin')
                            ->innerJoin('MainBundle:RetailerCountries', 'rc', 'WITH', 'rc.id = r.fkRetailerCountry')
                            ->innerJoin('MainBundle:RetailerTypes', 'rt', 'WITH', 'rt.id = r.fkRetailerType')
                            ->innerJoin('MainBundle:Product', 'p', 'WITH', 'p.id = r.fkProducts')
                            ->innerJoin('MainBundle:OrderModes', 'om', 'WITH', 'om.id = r.fkOrderMode')
                            ->innerJoin('MainBundle:ProductLineTypes', 'plt', 'WITH', 'plt.id = p.fkProductLineType')
                            ->innerJoin('MainBundle:ProductLines', 'pl', 'WITH', 'pl.id = plt.fkProductLine')
                            ->innerJoin('MainBundle:ProductTypes', 'pt', 'WITH', 'pt.id = plt.fkProductType');
                            if($value['prodType']){
                            	$query->andWhere('pt.name = :ptname')
    							->setParameter('ptname', $value['prodType']);
                            }
                            if($value['prodLine']){
                            	$query->andWhere('pl.name = :plname')
    							->setParameter('plname', $value['prodLine']);
                            }
                            if($value['product']){
                            	$query->andWhere('p.name = :pname')
    							->setParameter('pname', $value['product']);
                            }
                            if($value['retailerType']){
                            	$query->andWhere('rt.name = :rtname')
    							->setParameter('rtname', $value['retailerType']);
                            }
                            if($value['retailCountry']){
                            	$query->andWhere('rc.name = :rcname')
    							->setParameter('rcname', $value['retailCountry']);
                            }
                            if($value['orderMode']){
                            	$query->andWhere('om.name = :omname')
    							->setParameter('omname', $value['orderMode']);
                            }
                            if($value['quarter']){
                            	$query->andWhere('r.quarter = :quarter')
    							->setParameter('quarter', $value['quarter']);
                            }
                            if($value['year']){
                            	$query->andWhere('r.year = :year')
    							->setParameter('year', $value['year']);
                            }


    	$result = $query->getQuery()->getResult();
    	return $result;
	}
}