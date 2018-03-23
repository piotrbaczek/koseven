<?php
/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 21.03.2018
 * Time: 19:39
 */

/**
 * Class Injectable
 * Makes DI available in class
 */
class Injectable
{
    use Traits_Injectdi;

    /**
     * Injectable constructor.
     * @throws Dependency_Exception
     */
    public function __construct()
    {
        $this->setDI();
    }
}