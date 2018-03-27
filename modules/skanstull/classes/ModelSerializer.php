<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelSerializer
 *
 * @author nzpetter
 */
use Tobscure\JsonApi\SerializerInterface;
use Tobscure\JsonApi\Relationship;
use Tobscure\JsonApi\Resource;
use Tobscure\JsonApi\Collection;

/**
 * Class ModelSerializer
 */
class ModelSerializer implements SerializerInterface
{
    /**
     * @var \Hashids\Hashids $hashids
     */
    protected $hashids;

    /**
     * ModelSerializer constructor.
     * @param \Hashids\Hashids $hashids
     */
    public function __construct(\Hashids\Hashids $hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * @inheritdoc
     */
    public function getAttributes($model, array $fields = NULL): array
    {
        foreach ($model->meta()->fields() as $field)
        {
            if ($field instanceof Jelly_Field_Primary || $field instanceof Jelly_Field_BelongsTo || $field instanceof Jelly_Field_HasMany || $field instanceof Jelly_Field_Manytomany)
            {
                continue;
            }
            elseif ($field->private ?? false)
            {
                continue;
            }
            else
            {
                $fields[$field->name] = $model->{$field->name};
            }
        }

        return $fields;
    }

    /**
     * @inheritdoc
     */
    public function getId($model): string
    {
        return $this->hashids->encode($model->id);
    }

    /**
     * @inheritdoc
     */
    public function getLinks($model): array
    {
        return [
            'self' => Route::url('resource', [
                'model' => $this->getType($model),
                'id' => $this->getId($model),
                'directory' => strtolower(Request::$current->directory())
            ], Request::$current->secure() ? 'https' : 'http')
        ];
    }

    /**
     * @inheritdoc
     */
    public function getMeta($model): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getRelationship($model, $name): Relationship
    {
        $relation = $model->{$name};
        $relationship = new Relationship();

        if ($relation instanceof Jelly_Model)
        {
            $relationship->setData(new Resource($relation, new self($this->hashids)));
        }
        elseif ($relation instanceof Jelly_Collection)
        {
            $relationship->setData(new Collection($relation, new self($this->hashids)));
        }
        return $relationship;
    }

    /**
     * @inheritdoc
     */
    public function getType($model): string
    {
        return $model->meta()->model();
    }

}
