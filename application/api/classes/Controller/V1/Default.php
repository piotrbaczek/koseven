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
 */
class Controller_V1_Default extends Controller_Api_Resource implements Interfaces_Restapi
{
    /**
     * API GET
     * @return mixed
     */
    public function action_get()
    {
        $id = $this->di->get('_hashid')->decode($this->request->param('id'))[0];
        if ($id)
        {
            try
            {
                $model = Jelly::query($this->request->param('model'), $id)->select();
                if ($model->loaded())
                {
                    $resource = new Resource($model, $this->di->get('_modelSerializer'));
                    $resource->fields($this->_parameters->getFields());
                    $resource->with($this->_parameters->getInclude($model->getRelationships()));
                    $document = new Document($resource);
                    $document->addMeta('jsonapi', ['version' => '1.0']);
                    $this->_output($document->toArray());
                }
                else
                {
                    $this->_output([], 404);
                }
            } catch (Exception $ex)
            {
                $errors = new ErrorHandler();

                $errors->registerHandler(new InvalidParameterExceptionHandler);
                $errors->registerHandler(new FallbackExceptionHandler(Kohana::$environment === Kohana::DEVELOPMENT));

                $response = $errors->handle($ex);

                $document = new Document();
                $document->setErrors($response->getErrors());
                $this->_output($document->toArray(), $response->getStatus());
            }
        }
        else
        {
            $this->_output([], 404);
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