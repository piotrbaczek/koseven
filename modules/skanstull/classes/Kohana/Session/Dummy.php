<?php

/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 25.03.2018
 * Time: 01:27
 */
class Kohana_Session_Dummy extends Session
{

    /**
     * Loads the raw session data string and returns it.
     *
     * @param   string $id session id
     * @return  string
     */
    protected function _read($id = NULL)
    {
        return $id;
    }

    /**
     * Generate a new session id and return it.
     *
     * @return  string
     */
    protected function _regenerate()
    {
        return uniqid();
    }

    /**
     * Writes the current session.
     *
     * @return  boolean
     */
    protected function _write()
    {
        return TRUE;
    }

    /**
     * Destroys the current session.
     *
     * @return  boolean
     */
    protected function _destroy()
    {
        return TRUE;
    }

    /**
     * Restarts the current session.
     *
     * @return  boolean
     */
    protected function _restart()
    {
        return TRUE;
    }
}