<?php

/**
 * Class Controller_Welcome
 * Basic API Controller
 * @property Dependency_Container $di
 */
class Controller_Welcome extends Controller_Api_Action
{
    /**
     * @inheritdoc
     */
    public function action_index()
    {
        $this->_output($this->di->get('_apiDocument')->setErrors([
            'title' => self::$messages[401]
        ])->toArray());
    }

} // End Welcome
