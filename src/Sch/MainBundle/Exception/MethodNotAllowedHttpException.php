<?php

namespace Sch\MainBundle\Exception;

/**
 * Class MethodNotAllowedHttpException has purpose to pass the error message through FOSRest bundle to the client.
 * It should be used for error caused by client's bad input.
 *
 * @package SGalinski\TypoScriptBackendBundle\Exception
 */
class MethodNotAllowedHttpException extends \Exception {

}