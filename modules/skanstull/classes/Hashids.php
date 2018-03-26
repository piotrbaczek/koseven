<?php

/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 26.03.2018
 * Time: 22:47
 */
class Hashids extends \Hashids\Hashids
{
    /**
     * Decodes encoded string
     * @param string $hash Hash to decode
     * @param mixed $default Default value if decoding failed
     * @return mixed
     */
    public function decodeOne($hash, $default = FALSE)
    {
        $decode = parent::decode($hash);
        if (isset($decode[0]))
        {
            return $decode[0];
        }
        return $default;
    }
}