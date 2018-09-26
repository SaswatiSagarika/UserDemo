<?php
/**
 * Controller for Phone Section.
 *
 * @author saswati
 *
 * @category Controller
 */
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
     * Initializing service after container is set
     *
     */
    public function addServices()
    {
        // Getting the required service
        $this->phoneService = $this->get('sch_main.phone');
    }

	/*
	** REST action which returns sends the data to phone number.
	* @Method: POST, url: /api/sendotp
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
	*  }
	* @return mixed
	*/
    public function sendAction(Request $request)
    {	
    	if (json_decode($request->getContent(),1))
    	{
    		$data = json_decode($request->getContent(),1);
    	} else 
    	{
    		$requestData = $request->query->get('data');
        	$data = json_decode ($requestData, true);
    	}
        
        $param = [];
        $error = [];
        $resultArray = [];
        $em = $this->getDoctrine()->getManager();
        
        if ($data)
        {    		
    		$param['user'] = ($data['name']) ? $data['name'] : "";
    		$param['phone'] = ($data['phone']) ? $data['phone'] : "";

    		if ($param['user'])
    		{

                $user = $em->getRepository('MainBundle:User')->findOneBy(array('name' => $param['user']));

                if (!$user)
                {
                	$resultArray['userError'] = "Please give a valid user to search";
                } else if ($param['phone'])
	    	    {
	                $phone = $em->getRepository('MainBundle:UserPhone')->check($param);

	                if (!$phone)
	                {
	                	$resultArray['phoneError'] = "Please give a valid phone to search";
	                } else
	                {
	                	//incase the otp is used, generate new
	                	$otpStatus = $user->getStatus();
	    	    		if('Used' === $otpStatus)
	    	    		{
			    	    	$otpNew = $this->phoneService->generateOtp();
			    	    } else 
			    	    {
			    	    	$otpNew = $user->getOtp();
			    	    }
	      				//getting the twilio parameters
						$twilioSid = $this->container->getParameter('twilio_sid');
	            		$twilioToken = $this->container->getParameter('twilio_token');
	            		$twilioNumber = $this->container->getParameter('twilio_number');
	                	$twilioClient = new Client($twilioSid, $twilioToken);

			            $optService = $this->phoneService->sendOtpToMobile($twilioClient, $twilioNumber, $param['phone'], $otpNew);

			            if (!$optService['status']) 
			            {
			      			$resultArray['Error'] = $optService['error'];
		            	}

		            	$user->setOtp($otpNew);
		            	$user->setStatus("Sent");
		            	$em->persist($user);
		            	$em->flush();

		            	$resultArray['success'] = "otp send successfully";
	                }
	    	    } else 
	    	    {
    	    		$resultArray['errorMessage'] = "Please provide the phone parameter";
    	    	}
	    	} else 
	    	{
    	    	$resultArray['errorMessage'] = "Please provide the name parameter";
    	    }
    	}
    	return new JsonResponse($resultArray);
    }

    /*
	** REST action which returns success if the otp is verified.
	* Method: POST, url: /api/verifyotp
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
    	if( json_decode($request->getContent(),1))
    	{
    		$data = json_decode($request->getContent(),1);
    	} else 
    	{
    		$requestData = $request->query->get('data');
        	$data = json_decode($requestData, true);
    	}
        $param = [];
        $em = $this->getDoctrine()->getManager();
        if ($data)
        {    		
    		$param['user'] = ($data['name']) ? $data['name'] : "";
    		$param['phone'] = ($data['phone']) ? $data['phone'] : "";
    		$param['otp'] = ($data['otp']) ? $data['otp'] : "";

    		if ( isset($param['otp']) ) 
    		{
    			$resultArray['errorMessage'] = "Please provide the some parameter are missing";
    		} else if ($param['user']) 
    		{
                $user = $em->getRepository('MainBundle:User')->findOneBy(array('name' => $param['user']));

                if (!$user) 
                {
                	$resultArray['userError'] = "Please give a valid user to search";
                }

	    	    if ($param['phone']) 
	    	    {
	    	    	//verify the user and phone number are linked.
	                $phone = $em->getRepository('MainBundle:UserPhone')->check($param);

	                if (!$phone) 
	                {
	                	$resultArray['phoneError'] = "Please give a valid user to search";
	                } else 
	                {
	                	//verify the otp send.
	                	$otpVerification = $em->getRepository('MainBundle:User')->verifyOtp($param);

				        if (!$otpVerification) 
				        {
				            $resultArray['errorMessage'] = "Error Occured";
				        } else 
				        {
				        	//updating the
				        	 $user->setStatus("Used");
				        	 $em->persist($user);

					        //creating records in Twilio table
					        $twilolog = new TwilioLog;
		                    $twilolog->setPhone($param['phone'])
	                    			 ->setOtp($param['otp'])
	                                 ->setUser($user);
	                        $em->persist($twilolog);
		                   
		                    $em->flush();

		                    $resultArray['success'] = "otp matched";
				        }
					} 
    	    	} else 
    	    	{
    	    		$resultArray['errorMessage'] = "Please provide the some parameter are missing";
    	    	}
	    	} else 
	    	{
    	    	$resultArray['errorMessage'] = "Please provide the some parameter are missing";
    	    }
    		
    	}
    
    	return new JsonResponse($resultArray);
    }

}
