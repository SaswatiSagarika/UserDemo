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
use Symfony\Component\Translation\TranslatorInterface;

class ImportCSVService
{

     /**
     * @var serviceContainer
     */
    protected $serviceContainer;
    /**
     * @var translator
     */
    protected $translator;

    /**
     * @param $translator
     * @param $service_container
     *
     * @return void
     */

    public function __construct($service_container, $translator) {
        $this->translator = $translator;
        $this->serviceContainer = $service_container;
    }


    /** 
     * Function to generate a random six digit otp
     *
     * @param $phone
     * @param $user
     * @return array
     */
    public function createPhone($phone, $user)
    {   
        try {
            $em = $this->container->get('doctrine.orm.entity_manager');
            $phone = $em->getRepository('MainBundle:UserPhone')->findOneBy(array('phone' => $phone));
            if (empty($phone)) {
                $userPhone = new UserPhone;
                $userPhone->setPhone($phone);
                $userPhone->setUser($user);
                $userPhone->setStatus('1');
                $em->persist($user);
            }

            return $userPhone;

            } catch (\Exception $e) {
                
            $returnData['errorMessage'] = $e->getMessage();
            return $returnData;
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
    {   
        try {

            $em = $this->serviceContainer->get('doctrine.orm.entity_manager');

            // Path to CSV file
            global $kernel;
            $path = $kernel->getContainer()->getParameter('data_dir');
            $filePath= $path."/".$sheet;

            //extract data from a CSV document using LeagueCsv reader
            $reader=Reader::createFromPath($filePath);
            //get Iterator of all rows
            $results = $reader->fetchAssoc();
            foreach ($results as $row) {
             
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
            }
            $em->getConnection()->beginTransaction();
            // Do flush here
            $em->flush();
            
            $em->getConnection()->commit();

            $returnData['success']= $this->translator->trans('api.csv_uploaded');
        } catch (\Exception $e) {
            if ($em->getConnection() && $em->getConnection()->isOpen()) {
                $em->getConnection()->rollback();
            }

            $returnData['errorMessage'] = $e->getMessage();
        }

        return $returnData;
    }
}
