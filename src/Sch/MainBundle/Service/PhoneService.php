<?php

/**
 * Service for UsersPhone Section.
 *
 * @author
 * 
 * @category Service
 */
namespace Sch\MainBundle\Service;

use Symfony\Component\Translation\TranslatorInterface;
use Twilio\Rest\Client;
use Sch\MainBundle\Entity\User;
use Sch\MainBundle\Entity\UserPhone;
use Sch\MainBundle\Entity\TwilioLog;
/**
 * Class for phone services
 */
class PhoneService 
{
    protected $serviceContainer;

    public function __construct($service_container)
    {
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
     * Private function to validate the data
     *
     * @return array
     */
    public function checkDetails($param, $type ='send')
    {
        try {

            $data['user'] = (trim(array_key_exists('name', $param))) ? $param['name'] : "";
            $data['phone'] = (trim(array_key_exists('phone', $param))) ? $param['phone'] : "";
            
            if (!$data['user']) {
                $returnData['status'] = 'False';
                $returnData['message'] = 'missing.missing_username';
                return $returnData;

            }

            if (!$data['phone']) {
                $returnData['status'] = 'False';
                $returnData['message'] = 'missing.missing_phone';
                return $returnData;
            }
            
            $em = $this->getDoctrine()->getManager();
            $returnData['status'] = "true";
            $user = $em->getRepository('MainBundle:User')->findOneBy(array('name' => $data['user']));
            
                if (!$user) {
                    $returnData['status'] = 'False';
                    $returnData['message'] = 'missing.valid_user';
                    return $returnData;
                }
        
            $phone = $em->getRepository('MainBundle:UserPhone')->check($data);

                if (!$phone) {
                    $returnData['status'] = 'False';
                    $returnData['message'] = 'missing.valid_phone';
                    return $returnData;
                }

            if('verify' == $type){
                $data['otp'] = (trim(array_key_exists('otp', $param))) ? $param['otp'] : ""; 

                if ( !$data['otp'] ) {
                    $returnData['status'] = 'False';
                    $returnData['message'] = 'missing.missing_otp';
                    return $returnData;
                }
            }    

            return $returnData;
                
        } catch (\Exception $e) {
            $returnData['errorMessage'] = $e->getMessage();
            return $returnData;
        }
    }

    
    /**
     * Private function to generate and sms the otp
     *
     * @return array
     */
    public function sendOtpToMobile($phone, $otpNew)
    {
        try {
            $twilioSid = $this->container->getParameter('twilio_sid');
            $twilioToken = $this->container->getParameter('twilio_token');
            $twilioNumber = $this->container->getParameter('twilio_number');
            $twilioClient = new Client($twilioSid, $twilioToken);


            if($twilioClient) 
            {
                $textMessage = "Your one-time password to verify your account is " . $otpNew;

                $message = $twilioClient->messages
                    ->create($phone, 
                        array(
                           "body" => $textMessage,
                           "from" => $twillio_number
                        )
                    );
            }
            //var_dump($message);exit;
            return array('status' => true);
        } catch (\Exception $e) {
            $returnData['errorMessage'] = $e->getMessage();
            return $returnData;
        }
    }
}