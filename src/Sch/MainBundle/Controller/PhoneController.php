<?php
/**
 * Controller for Phone Section functions.
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
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sch\MainBundle\Entity\User;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Sch\MainBundle\Constants\ValueConstants;

class PhoneController extends FOSRestController
{
	/**
	** REST action which returns sends the data to phone number.
	* @Post("/sendotp")
	* @View(statusCode=200)
	*
	* @ApiDoc(
	*   resource =false,
	*   description = "API to send otp to phone number",
	* requirements={
    *      {
    *          "name"="send",
    *          "dataType"="string",
    *          "description"="Response format"
    *      },
    *      {
    *          "name"="send",
    *          "requirement"="en|my"
    *      }
    *  },
	*  parameters={{
	*		"name"="send",
	*		"dataType"="Json",
    *       "required"="true",
    *		"description"="Json with username and phone number",
    *		"format"="{""name"":""John"",""phone"":""+919178859008""}"
	*		
	*	}},
    *  statusCodes={
    *         200="Returned when successful",
    *         401="Returned when not authorized",
    *  }
	* )
	* @return array
	*/
    public function sendAction(Request $request)
    {	
    	try {
    		$data = json_decode($request->getContent(), true);
	        if (!$data) {

	        	$message = $this->get('translator')->trans('api.missing_parameters');
	    	   	throw new NotFoundHttpException($message);
	    	}
	    	//validating the data in the form contain
			$userData = $this->container
                ->get('sch_main.phone')
                ->checkDetails($data, ValueConstants::SENDAPI);
			if (false === $userData['status'] ) {				
				$message = $this->get('translator')->trans($userData['message']);
				throw new NotFoundHttpException($message);
			}
			//sending the otp message
	        $optMessage = $this->container
                ->get('sch_main.phone')
                ->sendOtpToMobile($userData);

	        if (!$optMessage['status']) {
				$message = $this->get('translator')->trans('api.error');
				throw new BadRequestHttpException($message);
	    	}

	    	//setting the user data
	    	$userUpdates = $this->container
                ->get('sch_main.phone')
                ->addNewUpdates($userData, ValueConstants::SENDAPI);
	    	if (false === $userUpdates['status'] ) {
				throw new BadRequestHttpException($userUpdates['errorMessage']);
			}
	    	$resultArray['success'] = $this->get('translator')->trans('api.otp_success');

    	} catch (NotFoundHttpException $e) {
    		$resultArray['error'] = $e->getMessage();
    	} catch (BadRequestHttpException $e) {
    		$resultArray['error'] = $e->getMessage();
    	} catch (Exception $e) {
    		$resultArray['error'] = $e->getMessage();
    	}

    	return new JsonResponse($resultArray);
    }

    /**
	**REST action which returns success if the otp is verified.
	* @Post("/verifyotp")
	*
	* @View(statusCode=200)
	*
	* @ApiDoc(
	*   resource =false,
	*   description = "API to send otp to phone number",
	* requirements={
    *      {
    *          "name"="_format",
    *          "dataType"="string",
    *          "description"="Response format"
    *      },
    *      {
    *          "name"="_locale",
    *          "requirement"="en|my"
    *      }
    *  },
	*  parameters={{
	*		"name"="verify",
	*		"dataType"="Json",
    *       "required"="true",
    *		"description"="Json with username and phone number",
    *		"format"="{""name"":""John"",""phone"":""+919178859008"",""otp"":""123456""}"
	*		
	*	}},
    *  statusCodes={
    *         200="Returned when successful",
    *         401="Returned when not authorized",
    *  }
    *)
	* @return array
	*/
    public function verifyAction(Request $request)
    {
    	try {
	    	$data = json_decode($request->getContent(), true);;

	        if (!$data) {
	        	$message = $this->get('translator')->trans('api.missing_parameters');
	    	   	throw new BadRequestHttpException("Error Processing Request");
	    	}

	    	//validating the data in the form contain
			$userData = $this->container
                ->get('sch_main.phone')
                ->checkDetails($data, ValueConstants::VERIFYAPI);

			if (false === $userData['status'] ) {
				$message = $this->get('translator')->trans($userData['message']);
				throw new NotFoundHttpException($message);
			}
			$em = $this->getDoctrine()->getManager();
			
		    //verify the otp send.
	    	$otpVerification = $em->getRepository('MainBundle:User')->verifyOtp($userData);

	        if (!$otpVerification) {
	        	throw new BadRequestHttpException($otpVerification);
	        }
	        //setting the user data
	    	$userUpdates = $this->container
                ->get('sch_main.phone')
                ->addNewUpdates($userData, ValueConstants::VERIFYAPI);
	    	if (false === $userUpdates['status'] ) {
				throw new BadRequestHttpException($userUpdates['errorMessage']);
			}
		    $resultArray['success'] = $this->get('translator')->trans('api.otp_verified');

	    } catch (NotFoundHttpException $e) {
    		$resultArray['error'] = $e->getMessage();
    	} catch (BadRequestHttpException $e) {
    		$resultArray['error'] = $e->getMessage();	
	    } catch (Exception $e) {
    		$resultArray['error'] = $e->getMessage();
    	}
    	return new JsonResponse($resultArray);
    }
}