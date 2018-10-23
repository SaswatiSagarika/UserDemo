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
        $exception = $event->getException();
        $message['code'] = $exception->getCode();
        $message['errorMessage'] = $exception->getMessage();
        $status = method_exists($event->getException(), 'getStatusCode') ? $event->getException()->getStatusCode() : 500;
        // Customize your response object to display the exception details
        $response = new JsonResponse($message, $status);
        $response->setContent($response);

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // sends the modified response object to the event
        $event->setResponse($response);
    }
}