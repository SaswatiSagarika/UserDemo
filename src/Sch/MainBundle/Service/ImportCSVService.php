<?php

/**
 * Description of ImportCSVService
 *
 */
namespace Sch\MainBundle\Service;

use League\Csv\Reader;
use Sch\MainBundle\Entity\User;
use Sch\MainBundle\Entity\UserPhone;
use Sch\MainBundle\Entity\TwilioLog;

class ImportCSVService 
{

    protected $serviceContainer;

    public function __construct($service_container)
    {
        $this->serviceContainer = $service_container;
    }

    /**
     * Function to import Users
     *
     * @param $sheet    obejct(PHPExcel_Worksheet)
     *
     * @return array
     *
     **/
    public function uploadUsers($sheet)
    {   try {
            $em = $this->serviceContainer->get('doctrine')->getEntityManager();
            // Path to CSV file
            global $kernel;
            $path = $kernel->getContainer()->getParameter('data_dir');
           
            $filePath= $path."/".$sheet;
            $reader=Reader::createFromPath($filePath);
            $em = $this->getDoctrine()->getManager();    
            
            $results = $reader->fetchAssoc();
            //var_dump($results); exit;
            foreach ($results as $row) {
             
                //create new users
                $user = new User;
                $user->setName($row['name']);
                $user->setLast($row['last']);
                $user->setOtp(rand(100000,999999));
                $em->persist($user);

                $userPhone = new UserPhone;
                $phone = $em->getRepository('MainBundle:UserPhone')->findOneBy(array('phone' => $row['phone1']));
                if(!$phone){
                    $userPhone->setPhone($row['phone1']);
                    $userPhone->setUser($user);
                    $userPhone->setStatus('1');
                    $em->persist($userPhone);
                }
                $phone2 = $em->getRepository('MainBundle:UserPhone')->findOneBy(array('phone' => $row['phone2']));
                if($row['phone2'] && !$phone2){
                    $userPhone2 = new UserPhone;

                    $userPhone2->setPhone($row['phone2']);
                    $userPhone2->setUser($user);
                    $userPhone2->setStatus('2');
                    $em->persist($userPhone2);
                }
                $phone3 = $em->getRepository('MainBundle:UserPhone')->findOneBy(array('phone' => $row['phone3']));
                if($row['phone3'] && !$phone3){
                    $userPhone3 = new UserPhone;

                    $userPhone3->setPhone($row['phone3']);
                    $userPhone3->setUser($user);
                    $userPhone3->setStatus('3');
                    $em->persist($userPhone3);
                }
                $em->flush();
            }
            $returnData['success']= "csv uploaded successfully";
            return $returnData;
        } catch (\Exception $e) {
            $returnData['errorMessage'] = $e->getMessage();
            return $returnData;
        }
    }


}
