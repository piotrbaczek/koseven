<?php
/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 21.03.2018
 * Time: 19:36
 */

trait Traits_Injectdi
{
    protected $di;

    /**
     * Initializes Dependency Injection
     * @throws Dependency_Exception
     */
    public function setDI(): void
    {
        //set DI
        $this->di = new Dependency_Container(Dependency_Definition_List::factory()
            ->from_array(Kohana::$config->load('di')->as_array()));
    }
}