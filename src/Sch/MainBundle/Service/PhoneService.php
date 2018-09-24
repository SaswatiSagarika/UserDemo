<?php

/**
 * 
 * @category Service
 */
namespace Sch\MainBundle\Service;

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
    public function sendOtpToMobile($twilioClient, $twillio_number, $phone, $otpNew)
    {
        try {

            if($twilioClient) {
                $textMessage = "Your one-time password to verify your account is " . $otpNew;

                $message = $twilioClient->messages
                  ->create($phone, 
                           array(
                               "body" => $textMessage,
                               "from" => $twillio_number
                           )
                  );
            }
            return array('status' => true,);
        } catch (\Exception $e) {
            $returnData['errorMessage'] = $e->getMessage();
            return $returnData;
        }
    }
}