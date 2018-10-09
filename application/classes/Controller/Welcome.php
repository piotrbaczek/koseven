<?php

/**
 * Class Controller_Welcome
 */
class Controller_Welcome extends Controller_Core_Template
{
    /**
     * Index action
     */
    public function action_index()
    {
        $this->title = 'Witaj';
        $this->content = View::factory('welcome/index');
    }

} // End Welcome
