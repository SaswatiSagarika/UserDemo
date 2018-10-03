<?php

/**
 * Description of ImportCSVService
 *
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
     * Function to generate a random six digit otp
     *
     * @return 
     */
    public function createPhone($phone, $user)
    {   
        $em = $this->getDoctrine()->getManager();
        $userPhone = new UserPhone;
        $phone = $em->getRepository('MainBundle:UserPhone')->findOneBy(array('phone' => $phone));
        if (isset($phone)) {
            $userPhone->setPhone($phone);
            $userPhone->setUser($user);
            $userPhone->setStatus('1');
            $em->persist($user);
            $em->flush();
        }

                
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
    {   try 
        {
            $em = $this->serviceContainer->get('doctrine')->getEntityManager();
            // Path to CSV file
            global $kernel;
            $path = $kernel->getContainer()->getParameter('data_dir');
            $filePath= $path."/".$sheet;

            //extract data from a CSV document using LeagueCsv reader
            $reader=Reader::createFromPath($filePath);
            //get Iterator of all rows
            $results = $reader->fetchAssoc();

            $em = $this->getDoctrine()->getManager(); 
            
            foreach ($results as $row) 
            {
             
                //create new users
                $user = new User;
                $user->setName($row['name']);
                $user->setLast($row['last']);
                $user->setOtp(rand(100000,999999));
                $em->persist($user);

                //create new phone records
                $userPhone1 = $this->createPhone($row['phone1'] ,$user);
                $userPhone2 = $this->createPhone($row['phone2'] ,$user);
                $userPhone3 = $this->createPhone($row['phone3'] ,$user);
                $em->flush();
            }

            $returnData['success']= "csv uploaded successfully";
            return $returnData;
            
        } catch (\Exception $e)
        {
            $returnData['errorMessage'] = $e->getMessage();
            return $returnData;
        }
    }


}
