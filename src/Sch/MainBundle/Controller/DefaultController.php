<?php
/**
 * Controller for Default Section functions.
 *
 * @author Saswati
 *
 * @category Controller
 */
namespace Sch\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormTypeInterface;
use Sch\MainBundle\Form\TestFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;
use Sch\MainBundle\Service\TestApiService;

class DefaultController extends Controller
{   
    /**
     * function to call the api from symfony form
     *
     * @param $request
     * @return array
     */
    public function indexAction (Request $request)
    {	
        $form = $this->createForm(TestFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //getting thr form data
            
            $verb = $form["verb"]->getData();
            $url = $form["url"]->getData();
            $content = $form["content"]->getData();
            $token = hash_hmac('sha1', $content, 
                $this->container->getParameter('hash_signature_key'))
            ;
            $header = array(
                'Authorization: '.$token
            );
            //calling the api
            $response = $this->container
                ->get('sch_main.caller')
                ->callingApi($url, $header, $verb, $content)
            ;
            // print_r($response);exit;
            return new Response($response);
        }
        return $this->render('MainBundle::Default/test.html.twig', ['form' => $form->createView()]);
        
    }

    /**
    * function to call the api from manual form
    *
    *
    * @param $request
    * @return index.twig
    */
    public function testAction (Request $request)
    {
        // return the index.html view
        return $this->render (
            'MainBundle:Default:index.html.twig'
        );
    }
}