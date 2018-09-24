<?php

/**
 * Controller for Products Section.
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

/**
*@Route("/Users")
*/

class UserController extends FOSRestController{

    /**
    *@Route("/")
    */
	public function getUserDetailAction(Request $request) {
        $demo =[];
        $requestData = $request->query->get('data');
        $demo = json_decode($requestData, true);
        $param = [];
        $error = [];
        $em = $this->getDoctrine()->getManager();
        if($demo)
        {
            
            $param['name'] = (array_key_exists('name', $demo)) ? $demo['name'] : "";
            $param['phone'] = (array_key_exists('phone', $demo)) ? $demo['phone'] : "";
             $users = $em->getRepository('MainBundle:User')->getUsers($param);
             
            // $userPhones = $retailerType = $em->getRepository('MainBundle:UserPhone')->findBy(array('user' => $users));
           
        $resultArray = [];
        $i = 0;
        foreach ($users as $user) {
             $userDetails['name']=(null !== $user['name']) ? $user['name'] : '';
              $userDetails['last']=(null !== $user['last']) ? $user['last'] : '';
             // $userDetails['phone']=(null !== $user['phone']) ? $user['phone'] : '';
            //  foreach ($userPhones as $userPhone) {
            //     $userDetails['Quantity']=(null !== $userPhone['phone']) ? $userPhone['phone'] : '';
            // }

             
             $resultArray['User'][$i]=$userDetails;
             $i++;
        } 
        }
        // if($param['name'] && $param['phone']){
            //$users = $em->getRepository('MainBundle:User')->getUsers($param);
        // }
        
        if(!$error && !$resultArray){
            $error['resultError'] = "No records found for this filter";
        }
        $resultArray['Error'] = $error;
             
        return new JsonResponse($resultArray);
            
	}

}
