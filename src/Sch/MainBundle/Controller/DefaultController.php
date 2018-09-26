<?php

namespace Sch\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\FormTypeInterface;
use Sch\MainBundle\Form\Type\ApiTestFormType;


class DefaultController extends Controller
{
    public function indexAction ($name)
    {	
       // return the index.html view
        return $this->render (
            'MainBundle:Default:index.html.twig'
        );
    }
}