<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);

        // main_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#sD', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'main_homepage')), array (  '_controller' => 'Sch\\MainBundle\\Controller\\DefaultController::indexAction',));
        }

        if (0 === strpos($pathinfo, '/api')) {
            // sch_main_api_test
            if ('/api/test' === $pathinfo) {
                return array (  '_controller' => 'Sch\\MainBundle\\Controller\\ApiTestController::apiTestAction',  '_route' => 'sch_main_api_test',);
            }

            // sch_main_search_details
            if ('/api/getRevenue' === $pathinfo) {
                return array (  '_controller' => 'Sch\\MainBundle\\Controller\\RevenueController::getRevenueDetailAction',  '_route' => 'sch_main_search_details',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
