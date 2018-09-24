<?php

namespace Sch\MainBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Twilio\Rest\Client;
use Sch\MainBundle\Entity\User;
use Sch\MainBundle\Entity\UserPhone;
use Sch\MainBundle\Entity\TwilioLog;


class PhoneController extends FOSRestController
{
	/**
     * Overriding the default container
     *
     */
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->addServices();
    }
	/**
     * Initializing services after container is set
     *
     */
    public function addServices()
    {
        // Getting all the required services
        $this->phoneService = $this->get('sch_main.phone');
        $this->doctrine = $this->getDoctrine();
    }

	/*
	** REST action which returns details based on the search data.
	* Method: POST, url: /api/sendotp/{_format}
	*
	* @ApiDoc(
	*   resource =false,
	*   description = "post",
	*  parameters={
	*		"name":"test",
	*		"phone":"+919178859008"
	*	}
	*   statusCodes = {
	*     200 = "Returned when successful",
	*     404 = "Returned when the page is not found"
	*   }
	* )
	*
	*
	*  }
	* @return mixed
	*/
    public function sendAction(Request $request)
    {
        $data=json_decode($request->getContent(),1);
		
        $param = [];
        $error = [];
        $resultArray = [];
        $em = $this->getDoctrine()->getManager();
        
        if($data)
        {    		
    		$param['user'] = ($data['name']) ? $data['name'] : "";
    		$param['phone'] = ($data['phone']) ? $data['phone'] : "";

    		if($param['user']){

                $user = $em->getRepository('MainBundle:User')->findOneBy(array('name' => $param['user']));

                if(!$user){
                	$error['userError'] = "Please give a valid user to search";
                }

    	    }

    	    if($param['phone']){
                $phone = $em->getRepository('MainBundle:UserPhone')->check($param);

                if(!$phone){
                	$error['phoneError'] = "Please give a valid phone to search";
                } else{
                	//incase the otp is used, generate new
                	$otpStatus = $user->getStatus();
    	    		if('Used' == $otpStatus){
		    	    	$otpNew = $this->phoneService->generateOtp();
		    	    } else {
		    	    	$otpNew = $user->getOtp();
		    	    }
                	
				$twilio_sid = $this->container->getParameter('twilio_sid');
            	$twilio_token = $this->container->getParameter('twilio_token');
            	$twilio_number = $this->container->getParameter('twilio_number');
                	$twilioClient = new Client($twilio_sid, $twilio_token);

		            $optService = $this->phoneService->sendOtpToMobile($twilioClient, $twilio_number, $param['phone'], $otpNew);
		            if (!$optService['status']) {
		      			$resultArray['Error'] = $optService['error'];
        
	            	}
	            	$user->setOtp($otpNew);
	            	$user->setStatus("Sent");
	            	$em->persist($user);
	            	$em->flush();

	            	$resultArray['success'] = "otp send successfully";
                }
    	    }
    	}
    	return new JsonResponse($resultArray);
    }

    /*
	** REST action which returns details based on the search data.
	* Method: POST, url: /api/verifyotp/{_format}
	*
	* @ApiDoc(
	*   resource =false,
	*   description = "post",
	*  parameters={
	*		"name":"test",
	*		"phone":"+919178859008",
	*		"otp":"989898"
	*	}
	*   statusCodes = {
	*     200 = "Returned when successful",
	*     404 = "Returned when the page is not found"
	*   }
	* )
	*
	*
	*  }
	* @return mixed
	*/
    public function verifyAction(Request $request)
    {
        $data=json_decode($request->getContent(),1);
        $param = [];
        $error = [];
        $em = $this->getDoctrine()->getManager();
        if($data)
        {    		
    		$param['user'] = ($data['name']) ? $data['name'] : "";
    		$param['phone'] = ($data['phone']) ? $data['phone'] : "";
    		$param['otp'] = ($data['otp']) ? $data['otp'] : "";

    		if($param['user']){
                $user = $em->getRepository('MainBundle:User')->findOneBy(array('name' => $param['user']));

                if(!$user){
                	$error['userError'] = "Please give a valid user to search";
                }
    	    }

    	    if($param['phone']){
    	    	//verify the user and phone number are linked.
                $phone = $em->getRepository('MainBundle:UserPhone')->check($param);

                if(!$phone){
                	$error['phoneError'] = "Please give a valid user to search";
                } else{
                	//verify the otp send.
                	$otpVerification = $em->getRepository('MainBundle:User')->verifyOtp($param);

			        if (!$otpVerification) {
			            $errorDetail = "Error Occured";
			        } else{
			        	 $user->setStatus("Used");
				        //creating records in Twilio table
				        $twilolog= new TwilioLog;
	                    $twilolog   ->setPhone($param['phone'])
	                    			->setOtp($param['otp'])
	                                ->setUser($user);

	                    $em->persist($user);
	                    $em->persist($twilolog);
	                    $em->flush();

			        }

	            }
	            	$resultArray['success'] = "otp amtched";
            }
    	}
    
    	return new JsonResponse($resultArray);
    }

}
