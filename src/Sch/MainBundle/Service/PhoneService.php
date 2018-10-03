<?php

/**
 * Service for UsersPhone Section.
 *
 * @author
 * 
 * @category Service
 */
namespace Sch\MainBundle\Service;

use Twilio\Rest\Client;

/**
 * Class for phone services
 */
class PhoneService 
{
    

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
     * Private function to generate and sms the otp
     *
     * @return array
     */
    public function sendOtpToMobile($phone, $otpNew)
    {
        try 
        {
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
            // var_dump($message);exit;
            return array('status' => true);
        } catch (\Exception $e) 
        {
            $returnData['errorMessage'] = $e->getMessage();
            return $returnData;
        }
    }
}