<?php

// src/AppBundle/EventListener/RequestListener.php
namespace Sch\MainBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Sch\MainBundle\Service\AuthenticateApiService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class RequestListener
{   
    private $authservice;

    private $translator;

    public function __construct($authservice, TranslatorInterface $translator) {
        $this->authservice = $authservice;
        $this->translator = $translator;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {    
        $request = $event->getRequest();
        if ('/api/test' === $request->getPathInfo()) {
            return false;
        }
        $response = $this->authservice->authenticateRequest($request);
        
        if(true !== $response['status']){

            $responseData['error'] = $this->translator->trans($response['errorMessage']['message']);
            
        	$event->setResponse(new JsonResponse($responseData));
        }
        return; 
    }
}