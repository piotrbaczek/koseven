<?php
/**
 * Created by PhpStorm.
 * User: nzpetter
 * Date: 21.03.2018
 * Time: 16:20
 */

abstract class Controller_Core extends Controller
{
    use Traits_Injectdi;
    /**
     * Controller_Core constructor.
     * @param Request $request
     * @param Response $response
     * @throws Dependency_Exception
     * @throws Kohana_Exception
     */
    public function __construct(Request $request, Response $response)
    {
        $this->setDI();
        parent::__construct($request, $response);
    }
}