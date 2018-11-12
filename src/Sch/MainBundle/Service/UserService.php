<?php

/**
 * Service for Users Section. This service used for verifying the user details and process and provide user response for the searched data provided.
 *
 * @author Saswati
 * 
 * @category Service
 */
namespace Sch\MainBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;
use DOMDocument;
use Symfony\Component\Translation\TranslatorInterface;
use Twilio\Rest\Client;
use Sch\MainBundle\Entity\User;
use Sch\MainBundle\Entity\UserPhone;
use Sch\MainBundle\Entity\TwilioLog;
/**
 * Class for user services
 */
class UserService
{   
    /**
     * @var serviceContainer
     */
    protected $serviceContainer;

    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     * @param $doctrine
     * @param $service_container
     *
     * @return void
     */

    public function __construct($doctrine, $service_container) {
        $this->doctrine = $doctrine;
        $this->serviceContainer = $service_container;
    }
    /**
     * function to sanitize the data
     *
     * @param $arr
     * @return array
     */
    public function sanitarize ($arr) 
    {
        foreach( $arr as $key => $value ) {
          $returnArr[$key] = trim(htmlspecialchars($value));
        }
      return $returnArr;
    }
    /**
     * function to validate the data
     *
     * @param $param
     * @return array
     */
    public function checkDetails($param)
    {
        try {
            
            $param['name'] = (isset($param['name'])) ? $param['name'] : "";
            $param['phone'] = (isset($param['phone'])) ? $param['phone'] : "";

            //santizing the data
            $returnData = $this->sanitarize($param);
            $returnData['status'] = false;
            if (!isset($param['name']) || !isset($param['phone']) ) {
                $returnData['message'] = 'api.missing_parameters';
                return $returnData;
            }

            $returnData['status'] = true;

        } catch (\Exception $e) {
            $returnData['errorMessage'] = $e->getMessage();
        }
        return $returnData;
    }

    
    /**
     * Private function to generate and sms the otp
     *
     * @param $param
     * @return array
     */
    public function getUserResponse($param)
    {
        try {
            $returnData['status'] = False;
            // if parameters are empty
            if (!isset($param) ) {
                $returnData['message'] = 'api.missing_parameters';
                return $returnData;
            }
            //searching the user and phone based on the details provided
            $users = $this->doctrine->getRepository('MainBundle:User')->getUsers($param);
            $resultArray = array();
            $userDetails = array();
            $i = 0;

            foreach ($users as $user) {

                $state = $user['status'];
                //if the userid is already present in the userDetails
                if(in_array($user["userid"], $userDetails)) {
                    
                    $xPhone['phone'.+$state] = $user['phone'];
                    $resultArray['User'.+$i] = $userDetails + $xPhone;
                } else {
                    //add new user
                    $userDetails['userid'] = $user['userid'];
                    $userDetails['name'] = $user['name'];
                    $userDetails['last'] = $user['last'];
                    $userDetails['phone'.+$state] = $user['phone'];
                    
                    $i++;
                    $resultArray['User'.+$i]=$userDetails;
                    
                }
            } 

            if(!$resultArray){
               $returnData['message'] = 'api.empty';
                return $returnData; 
            }
            $returnData['status'] = true;
            $returnData['response'] = $resultArray;

        } catch (\Exception $e) {
            $returnData['errorMessage'] = $e->getMessage();
        }
        return $returnData;
    }
}