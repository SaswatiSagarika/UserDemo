<?php

/**
 * Description of AuthenticateApiService. This service is used for authenticating the api request
 *
 *
 */
namespace Sch\MainBundle\Service;

use Sch\MainBundle\Constants\ErrorConstants;

class AuthenticateApiService
{
    /**
     *  @var ContainerInterface
     */
    private $container;

    /**
     *  @var Doctrine
     */
    private $doctrine;

    /**
     *  Constructor Function for iniatialize dependencies.
     *  
     *  @param $doctrine
     *  @param $container
     *   
     *  @return void
     */
    public function __construct($doctrine, $container)
    {
        $this->container = $container;
        $this->doctrine  = $doctrine;
    }

    /**
     * Function to check content and Api header
     *
     * @param $request
     * @return true
     *
     **/
    public function authenticateRequest($request)
    {   
        try {
            $returnData['status'] = false;

            if (!json_decode($content = $request->getContent(), true)) {
                $returnData['errorMessage'] = ErrorConstants::$apiErrors['INVALIDJSON'];
                return $returnData;

            }

            // get the request headers
            $headers = $request->headers;
            $auth = $headers->get('Authorization');
            $hash = hash_hmac('sha1', $content, $this->container
                ->getParameter('hash_signature_key'))
            ;
            // Comparing Request Hash with Server auth Hash.
            if ($hash !== $auth) {

                $returnData['errorMessage'] = ErrorConstants::$apiErrors['INVALIDAUTHORIZATION'];
                return $returnData;
            }
            
            $returnData['status'] = true;
        } catch (\Exception $e) {
            
            $returnData['errorMessage'] = $e->getMessage();
            
        }

        return $returnData;
    }
}
