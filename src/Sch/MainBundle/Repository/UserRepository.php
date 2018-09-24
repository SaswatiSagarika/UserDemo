<?php

namespace Sch\MainBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{   
    /**
    * 
    * get Users
    * It is used to fetch data from database on given filters.
    *
    * @param array $data array of coloum name and its values
    * @return array $result containing required data.
    */
    public function getUsers($value = null)
    {
        $query = $this->createQueryBuilder('u')
                            ->select('u.id')
                            ->addSelect('u.name')
                            ->addSelect('u.last');
                            //var_dump($value);exit;
                                if($value['name']){
                                    $query->Where('u.name = :name')
                                    ->setParameter('name', $value['name']);
                                }
                                if($value['phone']){
                                    $query->innerJoin('MainBundle:UserPhone', 'up', 'WITH', 'u.id = up.user')
                                    ->andWhere('up.phone = :phone')
                                    ->setParameter('phone', $value['phone']);
                                }
        
                                
        $result = $query->getQuery()->getResult();
        return $result;
    }
    
	/**
    * 
    * verifyOtp
    * It is used to fetch data from database on given filters.
    *
    * @param array $data array of coloum name and its values
    * @return array $result containing required data.
    */
	public function verifyOtp($value = null)
	{
		$query = $this->createQueryBuilder('u')
                            ->select('u.id as User')
                            ->innerJoin('MainBundle:UserPhone', 'up', 'WITH', 'u.id = up.user')
                            ->andWhere('u.name = :uname')
        							->setParameter('uname', $value['user'])
                            ->andWhere('up.phone = :uphone')
                            		->setParameter('uphone', $value['phone'])
                            ->andWhere('u.otp = :uotp')
                            		->setParameter('uotp', $value['otp']);
        						
    	$result = $query->getQuery()->getResult();
    	return $result;
	}

}
