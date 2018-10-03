<?php
/**
 * Controller for Phone Section.
 *
 * @author Saswati
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
    	$data = ($request->getContent()) ? json_decode($request->getContent(),1) : son_decode ($request->query->get('data'), true);
        
        $param = [];
        $resultArray = [];
        
        if (!$data) {
    	   	$resultArray['errorMessage'] = "Please provide the name parameter";
    	   	throw new Exception("Error Processing Request", 1);
    	}

            		
		$param['user'] = (trim($data['name'])) ? $data['name'] : "";
		$param['phone'] = (trim($data['phone']) ? $data['phone'] : "";

		if (!$param['user']) {
	    	throw new Exception("Please provide the name parameter", 1);
	    }

	    if (!$param['phone']) {
	    	throw new Exception("Please provide the phone parameter", 1);
	    }

	    $em = $this->getDoctrine()->getManager();
       	$user = $em->getRepository('MainBundle:User')->findOneBy(array('name' => $param['user']));

       	if (!$user) {
        	throw new Exception("Please provide the valid user parameter", 1);
        }
	    
	    $phone = $em->getRepository('MainBundle:UserPhone')->check($param);

        if (!$phone) {
        	throw new Exception("Please give a valid phone to search", 1);
        } 
	                
	    //incase the otp is used, generate new
    	$otpStatus = ('Used' === $user->getStatus())? $this->phoneService->generateOtp() : 
    						$user->getOtp();
		
		//getting the twilio parameters
        $optService = $this->phoneService->sendOtpToMobile( $param['phone'], $otpNew);

        if (!$optService['status']) {
  			throw new Exception($optService['error'], 1);
    	}

    	$user->setOtp($otpNew);
    	$user->setStatus("Sent");
    	$em->persist($user);
    	$em->flush();

    	$resultArray['success'] = "otp send successfully";

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
    	$data = ($request->getContent()) ? json_decode($request->getContent(),1) : son_decode ($request->query->get('data'), true);
        
        $param = [];
        $resultArray = [];
        
        if (!$data) {
    	   	throw new Exception("Please provide the required parameters", 1);
    	}

            		
		$param['user'] = (trim($data['name'])) ? $data['name'] : "";
		$param['phone'] = (trim($data['phone']) ? $data['phone'] : "";
		$param['otp'] = (trim($data['otp'])) ? $data['otp'] : "";

		if (!$param['user']) {
	    	throw new Exception("Please provide the name parameter", 1);
	    }

	    if (!$param['phone']) {
	    	throw new Exception("Please provide the phone parameter", 1);
	    }

	    $em = $this->getDoctrine()->getManager();
       	$user = $em->getRepository('MainBundle:User')->findOneBy(array('name' => $param['user']));

       	if (!$user) {
        	throw new Exception("Please give a valid user to search", 1);
        }
	    
	    $phone = $em->getRepository('MainBundle:UserPhone')->check($param);

        if (!$phone) {
        	throw new Exception("Error Processing Request", 1);
        } 
	    
		if ( isset($param['otp']) ) {
			throw new Exception("Please provide the some parameter are missing", 1);
		} 
	    
	    //verify the otp send.
    	$otpVerification = $em->getRepository('MainBundle:User')->verifyOtp($param);

        if (!$otpVerification) {
        	throw new Exception("Error Occured", 1);
        } 
        
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
    
    	return new JsonResponse($resultArray);
    }

}
