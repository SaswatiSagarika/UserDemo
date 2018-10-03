<?php
/**
 * Command used for Users Section.
 *
 * @author Saswati
 *
 * @category Custom Command
 */
namespace Sch\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormTypeInterface;
use Sch\MainBundle\Form\Type\ApiTestFormType;

class ApiTestController extends Controller
{
	public function apiTestAction() {
		$form = $this->createForm(new ApiTestFormType());
        $form->handleRequest($this->getRequest());
        if ($form->isValid()) {
            $verb = $form->get('verb')->getData();
            $content = $form->get('content')->getData();
            $url = $form->get('url')->getData();
        	$result = $this->run($verb, $content, $url);
               
            return new Response($r['response']);
        }
        // Render form to capture values needed for Merchant API testing
        return $this->render('MainBundle:ApiTest:testApi.html.twig', array('form' => $form->createView()));
	}
	        

}
