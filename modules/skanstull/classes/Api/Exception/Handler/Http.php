<?php
use Tobscure\JsonApi\Exception\Handler\ExceptionHandlerInterface;
use Tobscure\JsonApi\Exception\Handler\ResponseBag;

/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 26.03.2018
 * Time: 23:48
 */
class Api_Exception_Handler_Http implements ExceptionHandlerInterface
{
    /**
     * If the exception handler is able to format a response for the provided exception,
     * then the implementation should return true.
     *
     * @param \Exception $e
     *
     * @return bool
     */
    public function manages(Exception $e)
    {
        return $e instanceof HTTP_Exception;
    }

    /**
     * Handle the provided exception.
     *
     * @param \Exception $e
     *
     * @return \Tobscure\JsonApi\Exception\Handler\ResponseBag
     */
    public function handle(Exception $e)
    {
        $status = $e->getCode();
        $error = [];
        $error['status'] = $status;
        $error['title'] = $e->getMessage();

        return new ResponseBag($status, [$error]);
    }
}