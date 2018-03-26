<?php

/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 21.03.2018
 * Time: 11:56
 */

/**
 * Class Controller_V1_Default
 * @property Dependency_Container $di
 */

use Tobscure\JsonApi\Resource;
use Tobscure\JsonApi\Document;
use Tobscure\JsonApi\ErrorHandler;
use Tobscure\JsonApi\Exception\Handler\InvalidParameterExceptionHandler;
use Tobscure\JsonApi\Exception\Handler\FallbackExceptionHandler;

/**
 * Class Controller_V1_Default
 * @property Dependency_Container $di
 * @property \Tobscure\JsonApi\Parameters $_parameters
 * @property Document $apiDocument
 * @property Hashids $hashids
 * @property Api_Validator $apiValidator
 */
class Controller_V1_Default extends Controller_Api_Resource implements Interfaces_Restapi
{
    protected $hashids;
    protected $apiDocument;
    protected $apiValidator;

    public function before()
    {
        $this->hashids = $this->di->get('_hashid');
        $this->apiDocument = $this->di->get('_apiDocument');
        $this->apiValidator = $this->di->get('_apiValidator');
        parent::before();
    }

    /**
     * API GET
     * @return mixed
     */
    public function action_get()
    {
        try
        {
            $id = $this->hashids->decodeOne($this->request->param('id'), FALSE);
            if ($id)
            {
                $this->apiValidator::modelExists($this->request->param('model'));
                $model = Jelly::query($this->request->param('model'), $id)
                    ->active()
                    ->select();
                if ($model->loaded())
                {
                    $resource = new Resource($model, $this->di->get('_modelSerializer'));
                    $resource->fields($this->_parameters->getFields());
                    $resource->with($this->_parameters->getInclude($model->getRelationships()));
                    $this->apiDocument->setData($resource);
                    $this->_output($this->apiDocument->toArray());
                }
                else
                {
                    $this->_output([], 404);
                }
            }
            else
            {
                $this->_output([], 404);
            }
        } catch (Exception $ex)
        {
            $errors = new ErrorHandler();

            $errors->registerHandler(new InvalidParameterExceptionHandler);
            $errors->registerHandler(new Api_Exception_Handler_Http);
            $errors->registerHandler(new FallbackExceptionHandler(Kohana::$environment === Kohana::DEVELOPMENT));

            $response = $errors->handle($ex);

            $this->apiDocument->setErrors($response->getErrors());
            $this->_output($this->apiDocument->toArray(), $response->getStatus());
        }
    }

    /**
     * API POST
     * @return mixed
     */
    public function action_post()
    {
        echo __FUNCTION__;
    }

    /**
     * API PATCH
     * @return mixed
     */
    public function action_patch()
    {
        echo __FUNCTION__;
    }

    /**
     * API DELETE
     * @return mixed
     */
    public function action_delete()
    {
        echo __FUNCTION__;
    }
}