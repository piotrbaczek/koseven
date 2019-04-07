<?php

/**
 * @package        Kohana
 * @category       Controller
 * @author         Kohana Team
 * @copyright  (c) 2016-2019 Koseven Team
 * @license        https://koseven.ga/LICENSE.md
 */
abstract class Kohana_Controller_Rest extends Controller {

	/**
	 *  Mapping from HTTP Method to action name
	 */
	protected const ACTION_MAP = [
		Request::GET    => 'index',
		Request::PUT    => 'update',
		Request::POST   => 'create',
		Request::DELETE => 'delete',
	];

	/**
	 * Engine of controller that controls Controller's
	 * data processing of Input/Output
	 * @var Kohana_Controller_Rest_Engine $handleEngine
	 */
	protected $handleEngine;

	/** @var array $params Request params */
	protected $params = [];

	/**
	 * @inheritdoc
	 */
	public function before()
	{
		parent::before();

		if ($this->handleEngine === NULL || ! $this->handleEngine instanceof Kohana_Controller_Rest_Engine)
		{
			throw new Kohana_Controller_Rest_Exception('handleEngine is not configured correctly.');
		}

		if ($this->authenticate() === FALSE)
		{
			$this->respond(['status' => 401], 401);
			$this->request->action('error');
			return;
		}

		$this->params = $this->handleEngine->getInput($this->request);

		$this->handleAction($this->request->method());
	}

	/**
	 * @inheritdoc
	 */
	public function after()
	{
		parent::after();
	}

	/**
	 * Get Output
	 * @param array|null $data
	 * @param int        $status
	 * @param array      $headers
	 */
	public function respond(?array $data, int $status = 200, array $headers = []): void
	{
		$headers = array_merge($headers, $this->handleEngine->getResponseHeaders());
		foreach ($headers as $key => $value)
		{
			$this->response->headers((string) $key, (string) $value);
		}

		$this->response->status($status)->body($this->handleEngine->getOutput($data));
	}

	/**
	 * Matches HTTP method to action
	 * @param string $method
	 */
	private function handleAction(string $method)
	{
		if ( ! isset(static::ACTION_MAP[$method]))
		{
			$this->request->action('invalid');
		}
		else
		{
			$this->request->action(self::ACTION_MAP[$method]);
		}
	}

	abstract protected function authenticate(): bool;

	abstract public function action_index(): void;

	abstract public function action_update(): void;

	abstract public function action_create(): void;

	abstract public function action_delete(): void;

	/**
	 * Invalid action
	 * When HTTP method not defined in self::ACTION_MAP
	 * @return void
	 */
	protected function action_invalid(): void
	{
		$this->respond(null, 405, ['Allow' => implode(',', array_keys(static::ACTION_MAP))]);
	}

	/**
	 * Action when user is not authenticated
	 */
	protected function action_error(): void
	{

	}
}