<?php
// src/AppBundle/EventListener/ExceptionListener.php
namespace Sch\MainBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use TP\Bundle\RouteToMarketBundle\Service\ApiRequestService;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $message['errorCode'] = method_exists($event->getException(), 'getStatusCode') ? $event->getException()->getStatusCode() : 500;

        switch ($message['errorCode']) {
            case 400:
                $message['errorMessage'] = $event->getException()->getMessage();
                break;
            case 404:
                $message['errorMessage'] = $event->getException()->getMessage();
                break;
            case 500:
                $message['errorMessage'] = "Error occured in the server";
                break;
            default:
                    $message['errorMessage'] = 'Method Not Allowed';
                    $message['errorCode'] = 405;
                break;
        }
        // Customize your response object to display the exception details
        $response = new JsonResponse($message);
        // sends the modified response object to the event
        $event->setResponse($response);
    }
}