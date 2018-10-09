<?php

abstract class Controller_Core_Template extends Controller_Template
{
    public $template = 'core/main';
    protected $title = 'Welcome';
    protected $content = '';
    protected $assets;

    /**
     * @inheritdoc
     */
    public function before()
    {
        parent::before();
        $this->template->bind('title', $this->title);
        $this->template->bind('content', $this->content);
        $this->template->bind('assets',$this->assets);

        $this->assets = Assets::factory('app')
            ->js('app.js');
    }
}