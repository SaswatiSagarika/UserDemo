<?php

/**
 * Service for UsersPhone Section. This service used for verifying the user details and process and provide user response for the searched data provided.
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
use Sch\MainBundle\Constants\ValueConstants;

/**
 * Class for phone services
 */
class PhoneService
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
     * Function to generate a random six digit otp
     *
     * @return integer
     */
    public function generateOtp() 
    {
        return rand(100000,999999);
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
     * Private function to validate the data
     *
     * @param $param
     * @param $type
     * @return array
     */
    public function checkDetails($param, $type ='send') 
    {
        try {
            
            $param['name'] = (isset($param['name'])) ? $param['name'] : "";
            $param['phone'] = (isset($param['phone'])) ? $param['phone'] : "";

            $returnData = $this->sanitarize($param);
            $returnData['status'] = false;
            
            if (!$returnData['name']) {
                $returnData['message'] = 'api.missing_username';
                return $returnData;
                // throw new BadRequesrHttpException('api.missing_username');

            }

            if (!$returnData['phone']) {
                $returnData['message'] = 'api.missing_phone';
                return $returnData;
            }

            $user = $this->doctrine->getRepository('MainBundle:User')->findOneBy(array('name' => $returnData['name']));

                if (!$user) {
                    $returnData['message'] = 'api.valid_user';
                    return $returnData;
                }

            $phone = $this->doctrine->getRepository('MainBundle:UserPhone')->checkUserPhone($returnData);

                if (!$phone) {
                    $returnData['message'] = 'api.valid_phone';
                    return $returnData;
                }
            //setting otp value
            if(ValueConstants::VERIFYAPI === $type) {
                $returnData['otp'] = (trim(array_key_exists('otp', $param))) ? $param['otp'] : "";

                if ( !$returnData['otp'] ) {
                    $returnData['message'] = 'api.missing_otp';
                    return $returnData;
                } else if (6 !== strlen($returnData['otp'])){
                    
                    $returnData['message'] = 'api.invalid_otp';
                    return $returnData;
                }
            } else {
                $returnData['otp'] = (ValueConstants::USEDSTATUS === $user->getStatus())? $this->generateOtp() : $user->getOtp();
                
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
     * @return array
     */
    public function sendOtpToMobile($params)
    {
        try {
            $returnData['status'] = false;
            $twilioSid = $this->serviceContainer->getParameter('twilio_sid');
            $twilioToken = $this->serviceContainer->getParameter('twilio_token');
            $twilioNumber = $this->serviceContainer->getParameter('twilio_number');
            $twilioClient = new Client($twilioSid, $twilioToken);

            if($twilioClient)
            {
                $textMessage = "Your one-time password to verify your account is " . $params['otp'];

                $message = $twilioClient->messages
                    ->create($params['phone'],
                        array(
                           "body" => $textMessage,
                           "from" => $twilioNumber
                        )
                    );
                $returnData['status'] = True;
            }
        } catch (\Exception $e) {
            $returnData['errorMessage'] = $e->getMessage();
        }
        return $returnData;
    }
    /**
     * Private function to create new records in database
     *
     * @return array
     */
    public function addNewUpdates($params, $type = 'send')
    {
        try {
            $returnData['status'] = False;
            $em = $this->doctrine->getEntityManager();
            $user = $this->doctrine->getRepository('MainBundle:User')->findOneBy(array('name' => $params['name']));

            if(ValueConstants::VERIFYAPI === $type) {
                $user->setOtp($params['otp']);
                $user->setStatus(ValueConstants::USEDSTATUS);
        
            } else {

                $user->setStatus(ValueConstants::SENTSTATUS);

                //creating records in Twilio table
                $twilolog = new TwilioLog;
                $twilolog->setPhone($params['phone'])
                         ->setOtp($params['otp'])
                         ->setUser($user);
                $em->persist($twilolog);
            }

            $em->persist($user);
            $em->flush();
            $returnData['status'] = True;
        } catch (\Exception $e) {
            $returnData['errorMessage'] = $e->getMessage();
        }
        return $returnData;
    }
}