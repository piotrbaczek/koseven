<?php
/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 21.03.2018
 * Time: 12:16
 */

/**
 * Interface Restapi
 * Basic methods for REST Actions
 */
interface Interfaces_Restapi
{
    /**
     * API GET
     * @return mixed
     */
    public function action_get();

    /**
     * API POST
     * @return mixed
     */
    public function action_post();

    /**
     * API PATCH
     * @return mixed
     */
    public function action_patch();

    /**
     * API DELETE
     * @return mixed
     */
    public function action_delete();
}