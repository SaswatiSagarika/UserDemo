<?php

/**
 * Controller for Users Section.
 *
 * @author Saswati
 *
 * @category Controller
 */
namespace Sch\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Sch\MainBundle\Entity\User;
use Sch\MainBundle\Entity\UserPhone;
use Sch\MainBundle\Entity\TwilioLog;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;

class UserController extends FOSRestController
{
    /**
    ** REST action which returns sends the data to user number.
    *
    * @Get("/users")
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
    *       "name"="csndk",
    *       "dataType"="Json",
    *       "required"="true",
    *       "description"="Json with username and phone number",
    *       "format"="{""name"":""John"",""phone"":""+919178859008""}"
    *       
    *   }},
    *  statusCodes={
    *         200="Returned when successful",
    *         401="Returned when not authorized",
    *  }
    *)
    * @return array
    */
	public function getUserDetailAction(Request $request) 
    {
        try {
            $demo = json_decode($request->getContent(), true);
            // if content is not provided.
            if (!$demo) {
                $message = $this->get('translator')->trans('api.missing_parameters');
                throw new NotFoundHttpException($message);
            }
            //sanitizing and checking the params
            $userData =  $this->container
                ->get('sch_main.user')
                ->checkDetails($demo);
            if (!$userData) {
                $message = $this->get('translator')->trans('api.missing_parameters');
                throw new NotFoundHttpException($message);
            }
            //getting the result array
            $resultArr =  $this->container
                ->get('sch_main.user')
                ->getUserResponse($userData);

            if (false === $resultArr['status']) {
                    $message = $this->get('translator')->trans($resultArr['message']);
                    throw new NotFoundHttpException($message);
            }

            $resultArray['success'] = $resultArr['response'];

        } catch (NotFoundHttpException $e) {
            $resultArray['error'] = $e->getMessage();
        } catch (Exception $e) {
            $resultArray['error'] = $e->getMessage();
        }
        return $resultArray;
	}

}