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
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sch\MainBundle\Entity\User;
use Sch\MainBundle\Entity\UserPhone;
use Sch\MainBundle\Entity\TwilioLog;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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

    	$data = ($request->getContent()) ? json_decode($request->getContent(),1) : json_decode($request->query->get('data'), true);

        $submittedToken = $request->headers->get('Cookie');
        //print_r($request->getStatusCode());exit();
        $resultArray = [];
        
        if (!$data) {
        	$message = $this->get('translator')->trans('api.missing_parameters');
    	   	throw new \BadRequestHttpException($message);
    	}

		$userData = $this->phoneService->checkDetails($param, 'send');
		
		if ('false' == $userData['status'] ) {
			$message = $this->get('translator')->trans($userData['message']);
			throw new \NotFoundHttpException($message);
		}
		
		$userData = $this->phoneService->checkDetails($param, 'send');
		
		if ('false' == $userData['status'] ) {
			$message = $this->get('translator')->trans($userData['message']);
			throw new \NotFoundHttpException($message);
		}
	                
	    //incase the otp is used, generate new
    	$otpNew = ('Used' === $user->getStatus())? $this->phoneService->generateOtp() : 
    						$user->getOtp();
		
		//getting the twilio parameters
        $optService = $this->phoneService->sendOtpToMobile( $param['phone'], $otpNew);

        if (!$optService['status']) {
			throw new \BadRequestHttpException('Error Occured');
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
    	if('POST' !== $request->getMethod()){
    		$message = $this->get('translator')->trans('invalid_Method');
			 throw new \MethodNotAllowedHttpException($message);
    	}

    	$data = ($request->getContent()) ? json_decode($request->getContent(),1) : json_decode ($request->query->get('data'), true);
        
        if (!$data) {
        	$message = $this->get('translator')->trans('api.missing_parameters');
    	   	throw new \BadRequestHttpException("Error Processing Request");
    	}

		$userData = $this->phoneService->checkDetails($param, 'verfiy');
		
		if ('false' == $userData['status'] ) {
			$message = $this->get('translator')->trans($userData['message']);
			throw new \NotFoundHttpException($message);
		}

	    //verify the otp send.
    	$otpVerification = $em->getRepository('MainBundle:User')->verifyOtp($param);

        if (!$otpVerification) {
        	throw new \BadRequestHttpException("Error Occured", 1);
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
