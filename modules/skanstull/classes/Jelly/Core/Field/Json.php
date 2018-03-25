<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Json
 *
 * @author nzpetter
 */
abstract class Jelly_Core_Field_Json extends Jelly_Field
{
    /**
     * @param mixed $value
     * @return array|object
     */
    public function set($value)
    {
        list($value, $return) = $this->_default($value);

        if (!$return)
        {
            $value = json_decode($value, TRUE);
        }

        return $value;
    }

    /**
     * @param Jelly_Model $model
     * @param mixed $value
     * @param bool $loaded
     * @return string
     */
    public function save($model, $value, $loaded): string
    {
        return json_encode($model->{$this->name});
    }

}
