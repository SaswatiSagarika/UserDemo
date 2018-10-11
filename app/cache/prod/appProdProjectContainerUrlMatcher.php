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

        if (0 === strpos($pathinfo, '/a')) {
            if (0 === strpos($pathinfo, '/api')) {
                // sch_main_api_test
                if ('/api/test' === $pathinfo) {
                    return array (  '_controller' => 'Sch\\MainBundle\\Controller\\ApiTestController::apiTestAction',  '_route' => 'sch_main_api_test',);
                }

                // sch_main_search_details
                if ('/api/getRevenue' === $pathinfo) {
                    return array (  '_controller' => 'Sch\\MainBundle\\Controller\\RevenueController::getRevenueDetailAction',  '_route' => 'sch_main_search_details',);
                }

                // sch_main_search_users
                if ('/api/users' === $pathinfo) {
                    return array (  '_controller' => 'Sch\\MainBundle\\Controller\\UserController::getUserDetailAction',  '_route' => 'sch_main_search_users',);
                }

                // sch_main_send_otp
                if ('/api/sendotp' === $pathinfo) {
                    return array (  '_controller' => 'Sch\\MainBundle\\Controller\\PhoneController::sendAction',  '_route' => 'sch_main_send_otp',);
                }

                // sch_main_verifyotp
                if ('/api/verifyotp' === $pathinfo) {
                    return array (  '_controller' => 'Sch\\MainBundle\\Controller\\PhoneController::verifyAction',  '_route' => 'sch_main_verifyotp',);
                }

            }

            if (0 === strpos($pathinfo, '/admin')) {
                // sonata_admin_redirect
                if ('/admin' === rtrim($pathinfo, '/')) {
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif (!in_array($this->context->getMethod(), array('HEAD', 'GET'))) {
                        goto not_sonata_admin_redirect;
                    } else {
                        return $this->redirect($rawPathinfo.'/', 'sonata_admin_redirect');
                    }

                    return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'sonata_admin_dashboard',  'permanent' => 'true',  '_route' => 'sonata_admin_redirect',);
                }
                not_sonata_admin_redirect:

                // sonata_admin_dashboard
                if ('/admin/dashboard' === $pathinfo) {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Action\\DashboardAction',  '_route' => 'sonata_admin_dashboard',);
                }

                if (0 === strpos($pathinfo, '/admin/core')) {
                    // sonata_admin_retrieve_form_element
                    if ('/admin/core/get-form-field-element' === $pathinfo) {
                        return array (  '_controller' => 'sonata.admin.action.retrieve_form_field_element',  '_route' => 'sonata_admin_retrieve_form_element',);
                    }

                    // sonata_admin_append_form_element
                    if ('/admin/core/append-form-field-element' === $pathinfo) {
                        return array (  '_controller' => 'sonata.admin.action.append_form_field_element',  '_route' => 'sonata_admin_append_form_element',);
                    }

                    // sonata_admin_short_object_information
                    if (0 === strpos($pathinfo, '/admin/core/get-short-object-description') && preg_match('#^/admin/core/get\\-short\\-object\\-description(?:\\.(?P<_format>html|json))?$#sD', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_admin_short_object_information')), array (  '_controller' => 'sonata.admin.action.get_short_object_description',  '_format' => 'html',));
                    }

                    // sonata_admin_set_object_field_value
                    if ('/admin/core/set-object-field-value' === $pathinfo) {
                        return array (  '_controller' => 'sonata.admin.action.set_object_field_value',  '_route' => 'sonata_admin_set_object_field_value',);
                    }

                }

                // sonata_admin_search
                if ('/admin/search' === $pathinfo) {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Action\\SearchAction',  '_route' => 'sonata_admin_search',);
                }

                // sonata_admin_retrieve_autocomplete_items
                if ('/admin/core/get-autocomplete-items' === $pathinfo) {
                    return array (  '_controller' => 'sonata.admin.action.retrieve_autocomplete_items',  '_route' => 'sonata_admin_retrieve_autocomplete_items',);
                }

                if (0 === strpos($pathinfo, '/admin/sch/main')) {
                    if (0 === strpos($pathinfo, '/admin/sch/main/test')) {
                        // admin_sch_main_test_list
                        if ('/admin/sch/main/test/list' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'main.admin.test',  '_sonata_name' => 'admin_sch_main_test_list',  '_route' => 'admin_sch_main_test_list',);
                        }

                        // admin_sch_main_test_create
                        if ('/admin/sch/main/test/create' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'main.admin.test',  '_sonata_name' => 'admin_sch_main_test_create',  '_route' => 'admin_sch_main_test_create',);
                        }

                        // admin_sch_main_test_batch
                        if ('/admin/sch/main/test/batch' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'main.admin.test',  '_sonata_name' => 'admin_sch_main_test_batch',  '_route' => 'admin_sch_main_test_batch',);
                        }

                        // admin_sch_main_test_edit
                        if (preg_match('#^/admin/sch/main/test/(?P<id>[^/]++)/edit$#sD', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sch_main_test_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'main.admin.test',  '_sonata_name' => 'admin_sch_main_test_edit',));
                        }

                        // admin_sch_main_test_delete
                        if (preg_match('#^/admin/sch/main/test/(?P<id>[^/]++)/delete$#sD', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sch_main_test_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'main.admin.test',  '_sonata_name' => 'admin_sch_main_test_delete',));
                        }

                        // admin_sch_main_test_show
                        if (preg_match('#^/admin/sch/main/test/(?P<id>[^/]++)/show$#sD', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sch_main_test_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'main.admin.test',  '_sonata_name' => 'admin_sch_main_test_show',));
                        }

                        // admin_sch_main_test_export
                        if ('/admin/sch/main/test/export' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'main.admin.test',  '_sonata_name' => 'admin_sch_main_test_export',  '_route' => 'admin_sch_main_test_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sch/main/category')) {
                        // admin_sch_main_category_list
                        if ('/admin/sch/main/category/list' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'main.admin.category',  '_sonata_name' => 'admin_sch_main_category_list',  '_route' => 'admin_sch_main_category_list',);
                        }

                        // admin_sch_main_category_create
                        if ('/admin/sch/main/category/create' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'main.admin.category',  '_sonata_name' => 'admin_sch_main_category_create',  '_route' => 'admin_sch_main_category_create',);
                        }

                        // admin_sch_main_category_batch
                        if ('/admin/sch/main/category/batch' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'main.admin.category',  '_sonata_name' => 'admin_sch_main_category_batch',  '_route' => 'admin_sch_main_category_batch',);
                        }

                        // admin_sch_main_category_edit
                        if (preg_match('#^/admin/sch/main/category/(?P<id>[^/]++)/edit$#sD', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sch_main_category_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'main.admin.category',  '_sonata_name' => 'admin_sch_main_category_edit',));
                        }

                        // admin_sch_main_category_delete
                        if (preg_match('#^/admin/sch/main/category/(?P<id>[^/]++)/delete$#sD', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sch_main_category_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'main.admin.category',  '_sonata_name' => 'admin_sch_main_category_delete',));
                        }

                        // admin_sch_main_category_show
                        if (preg_match('#^/admin/sch/main/category/(?P<id>[^/]++)/show$#sD', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sch_main_category_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'main.admin.category',  '_sonata_name' => 'admin_sch_main_category_show',));
                        }

                        // admin_sch_main_category_export
                        if ('/admin/sch/main/category/export' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'main.admin.category',  '_sonata_name' => 'admin_sch_main_category_export',  '_route' => 'admin_sch_main_category_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sch/main/blogpost')) {
                        // admin_sch_main_blogpost_list
                        if ('/admin/sch/main/blogpost/list' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'main.admin.blog_post',  '_sonata_name' => 'admin_sch_main_blogpost_list',  '_route' => 'admin_sch_main_blogpost_list',);
                        }

                        // admin_sch_main_blogpost_create
                        if ('/admin/sch/main/blogpost/create' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'main.admin.blog_post',  '_sonata_name' => 'admin_sch_main_blogpost_create',  '_route' => 'admin_sch_main_blogpost_create',);
                        }

                        // admin_sch_main_blogpost_batch
                        if ('/admin/sch/main/blogpost/batch' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'main.admin.blog_post',  '_sonata_name' => 'admin_sch_main_blogpost_batch',  '_route' => 'admin_sch_main_blogpost_batch',);
                        }

                        // admin_sch_main_blogpost_edit
                        if (preg_match('#^/admin/sch/main/blogpost/(?P<id>[^/]++)/edit$#sD', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sch_main_blogpost_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'main.admin.blog_post',  '_sonata_name' => 'admin_sch_main_blogpost_edit',));
                        }

                        // admin_sch_main_blogpost_delete
                        if (preg_match('#^/admin/sch/main/blogpost/(?P<id>[^/]++)/delete$#sD', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sch_main_blogpost_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'main.admin.blog_post',  '_sonata_name' => 'admin_sch_main_blogpost_delete',));
                        }

                        // admin_sch_main_blogpost_show
                        if (preg_match('#^/admin/sch/main/blogpost/(?P<id>[^/]++)/show$#sD', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sch_main_blogpost_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'main.admin.blog_post',  '_sonata_name' => 'admin_sch_main_blogpost_show',));
                        }

                        // admin_sch_main_blogpost_export
                        if ('/admin/sch/main/blogpost/export' === $pathinfo) {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'main.admin.blog_post',  '_sonata_name' => 'admin_sch_main_blogpost_export',  '_route' => 'admin_sch_main_blogpost_export',);
                        }

                    }

                }

            }

            if (0 === strpos($pathinfo, '/api/doc')) {
                // app.swagger_ui
                if ('/api/doc' === $pathinfo) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_appswagger_ui;
                    }

                    return array (  '_controller' => 'nelmio_api_doc.controller.swagger_ui',  '_route' => 'app.swagger_ui',);
                }
                not_appswagger_ui:

                // app.swagger
                if ('/api/doc.json' === $pathinfo) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_appswagger;
                    }

                    return array (  '_controller' => 'nelmio_api_doc.controller.swagger',  '_route' => 'app.swagger',);
                }
                not_appswagger:

            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
