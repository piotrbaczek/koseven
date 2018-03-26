<?php

/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 26.03.2018
 * Time: 23:28
 */
class Api_Validator
{
    /**
     * Checks if given Jelly Model Exists by name
     * @param string $modelName Model Name
     * @throws HTTP_Exception_400
     * @return bool
     */
    public static function modelExists(string $modelName): bool
    {
        if (Jelly::meta($modelName) instanceof Jelly_Meta)
        {
            return TRUE;
        }

        throw new HTTP_Exception_400('Invalid model `:model`', [':model' => $modelName]);
    }
}