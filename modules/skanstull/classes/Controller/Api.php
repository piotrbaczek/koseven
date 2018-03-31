<?php

/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 25.03.2018
 * Time: 14:15
 */

use Tobscure\JsonApi\ErrorHandler;
use Tobscure\JsonApi\Parameters;

/**
 * Class Controller_Api
 */
abstract class Controller_Api extends Controller_Core
{
    const AUTH_NONE = 0;
    const AUTH_JWT = 10;
    const AUTH_FORBIDDEN = 20;

    CONST CONTENT_TYPE = 'application/vnd.api+json';

    protected $auth = self::AUTH_FORBIDDEN;
    //protected $_user;
    //protected $_original_resource;
    protected $_parameters;
    public static $messages = array(
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',
        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found', // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',
        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => 'Bandwidth Limit Exceeded'
    );

    public function before()
    {
        $this->initParams();
        $this->runAuth();
        parent::before();
    }

    public function runAuth(): void
    {

    }

    public function setAuth(int $auth = self::AUTH_FORBIDDEN): void
    {
        $this->auth = $auth;
    }

    protected function initParams()
    {
        try
        {
            switch ($this->request->method())
            {
                case Request::POST:
                case Request::PATCH:
                case Request::DELETE:
                    if (isset($_SERVER['CONTENT_TYPE']) && false !== strpos($_SERVER['CONTENT_TYPE'], self::CONTENT_TYPE))
                    {
                        $parsed_body = json_decode($this->request->body(), true);
                    }
                    else
                    {
                        throw new HTTP_Exception_415("Unsupported media type.");
                    }
                    $this->_parameters = new Parameters(array_merge((array)$parsed_body, (array)$this->request->post()));
                    break;
                case Request::GET:
                    $this->_parameters = new Parameters($this->request->query());
                    break;
                default:
                    break;
            }
        } catch (Exception $ex)
        {
            $errors = new ErrorHandler();

            $errors->registerHandler(new Api_Exception_Handler_Http);

            $response = $errors->handle($ex);

            $this->_output($this->di->get('_apiDocument')->setErrors($response->getErrors())->toArray(), $response->getStatus());
        }
    }

    protected function _output(array $data = [], int $code = 200): void
    {
        $this->response
            ->headers('content-type', self::CONTENT_TYPE)
            ->status($code)
            ->body(json_encode($data));
    }

    public function action_error()
    {
        try
        {
            throw new HTTP_Exception_405(self::$messages[405]);
        } catch (Exception $ex)
        {
            $errors = new ErrorHandler();

            $errors->registerHandler(new Api_Exception_Handler_Http);

            $response = $errors->handle($ex);

            $this->_output($this->di->get('_apiDocument')->setErrors($response->getErrors())->toArray(), $response->getStatus());
        }
    }
}