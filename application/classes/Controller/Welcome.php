<?php

/**
 * Class Controller_Welcome
 */
class Controller_Welcome extends Controller_Template
{
    /** @var string $template */
    public $template = 'welcome/index';

    /**
     * Index action
     */
    public function action_index()
    {
        $asdf = 'Hello world!';
        $this->template->bind('asdf', $asdf);
    }

} // End Welcome
