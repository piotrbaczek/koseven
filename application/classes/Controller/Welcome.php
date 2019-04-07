<?php

class Controller_Welcome extends Kohana_Controller_Rest {

	public function before()
	{
		/** @var Kohana_Controller_Rest_Engine_Json handleEngine */
		$this->handleEngine = new Kohana_Controller_Rest_Engine_Json();
		parent::before();
	}

	protected function authenticate(): bool
	{
		return TRUE;
	}

	public function action_index(): void
	{
		$this->respond(array_merge(['action' => $this->request->action()], $this->params));
	}

	public function action_update(): void
	{
		$this->respond(array_merge(['action' => $this->request->action()], $this->params));
	}

	public function action_create(): void
	{
		$this->respond(array_merge(['action' => $this->request->action()], $this->params));
	}

	public function action_delete(): void
	{
		$this->respond(array_merge(['action' => $this->request->action()], $this->params));
	}
} // End Welcome
