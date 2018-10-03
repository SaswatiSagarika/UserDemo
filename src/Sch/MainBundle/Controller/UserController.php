<?php

/**
 * Controller for Users Section.
 *
 * @author
 *
 * @category Controller
 */
namespace Sch\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sch\MainBundle\Entity\User;
use Sch\MainBundle\Entity\UserPhone;
use Sch\MainBundle\Entity\TwilioLog;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class UserController extends FOSRestController
{

    /*
    ** REST action which returns sends the data to phone number.
    * @Method: GET, url: /api/users
    *
    * @ApiDoc(
    *   resource =false,
    *   description = "post",
    *  parameters={
    *       "name":"test",
    *       "phone":"+919178859008"
    *   }
    *   statusCodes = {
    *     200 = "Returned when successful",
    *     404 = "Returned when the page is not found"
    *   }
    * )
    *
    *
    *  }
    * @return array
    */
	public function getUserDetailAction(Request $request) 
    {
        
        $demo = [];
        $requestData = $request->query->get('data');
        $demo = json_decode($requestData, true);
        
        $param = [];

        if ($demo) {
            
            $param['name'] = (array_key_exists('name', $demo)) ? $demo['name'] : "";
            $param['phone'] = (array_key_exists('phone', $demo)) ? $demo['phone'] : "";

            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('MainBundle:User')->getUsers($param);
            
            $resultArray = [];
            $i = 0;
            foreach ($users as $user) {
                $userDetails['name'] = (null !== $user['name']) ? $user['name'] : '';
                $userDetails['last'] = (null !== $user['last']) ? $user['last'] : '';
                
                $userPhones = $em->getRepository('MainBundle:UserPhone')->getPhones($user);
                  
                $j = 0;
                foreach ($userPhones as $userPhone) {
                    
                    $userDetailsPhone['phone'] = (null !== $userPhone['phone']) ? $userPhone['phone'] : '';
                    $userDetails['userPhone'][$j]=$userDetailsPhone;
                    $j++;
                }
                $resultArray['user'][$i]=$userDetails;
                 $i++;
            } 
        }
        
        if (!$error && !$resultArray) {
            $error['resultError'] = "No records found for this filter";
        }
        $resultArray['Error'] = $error;
             
        return new JsonResponse($resultArray);
            
	}

}
