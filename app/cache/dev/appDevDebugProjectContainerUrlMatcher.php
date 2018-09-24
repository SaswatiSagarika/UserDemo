<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === rtrim($pathinfo, '/')) {
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif (!in_array($this->context->getMethod(), array('HEAD', 'GET'))) {
                        goto not__profiler_home;
                    } else {
                        return $this->redirect($rawPathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }
                not__profiler_home:

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ('/_profiler/purge' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

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

            // sch_main_user_getuserdetail
            if ('/api/Users' === rtrim($pathinfo, '/')) {
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif (!in_array($this->context->getMethod(), array('HEAD', 'GET'))) {
                    goto not_sch_main_user_getuserdetail;
                } else {
                    return $this->redirect($rawPathinfo.'/', 'sch_main_user_getuserdetail');
                }

                return array (  '_controller' => 'Sch\\MainBundle\\Controller\\UserController::getUserDetailAction',  '_format' => 'json',  '_route' => 'sch_main_user_getuserdetail',);
            }
            not_sch_main_user_getuserdetail:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
