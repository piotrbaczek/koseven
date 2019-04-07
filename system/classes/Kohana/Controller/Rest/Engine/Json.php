<?php

/**
 * @package        Kohana
 * @category       Controller/Rest/Engine
 * @author         Kohana Team
 * @copyright  (c) 2016-2019 Koseven Team
 * @license        https://koseven.ga/LICENSE.md
 */
class Kohana_Controller_Rest_Engine_Json extends Kohana_Controller_Rest_Engine {

	/**
	 * Method that produces output
	 * @param array|null $data
	 * @return null|string
	 */
	public function getOutput(?array $data): string
	{
		if ($data === NULL)
		{
			return '';
		}

		$output = json_encode($data);
		$this->checkError();
		return $output;
	}

	/**
	 * Handle request, process to data
	 * @param Request $request
	 * @return array
	 */
	public function getInput(Request $request): array
	{
		$params = [];
		switch ($request->method())
		{
			case Request::POST:
			case Request::PUT:
			case Request::DELETE:
				if (isset($_SERVER['CONTENT_TYPE']) && FALSE !== strpos($_SERVER['CONTENT_TYPE'], 'application/json'))
				{
					$parsed_body = json_decode($request->body(), TRUE);
				}
				else
				{
					parse_str($request->body(), $parsed_body);
				}
				$params = array_merge((array) $parsed_body, (array) $request->post());
			break;
			case Request::GET:
				$params = array_merge((array) $request->query(), $params);
			break;
		}
		return $params;
	}

	/**
	 * Checks if encoding succeeded
	 * @throws Kohana_Controller_Rest_Exception
	 * @return void
	 */
	private function checkError(): void
	{
		if (json_last_error() !== JSON_ERROR_NONE)
		{
			throw new Kohana_Controller_Rest_Exception('Failed encoding to JSON, got :error', [
				'error' => json_last_error(),
			]);
		}
	}

	/**
	 * Return headers specific for this type response;
	 * @return array
	 */
	public function getResponseHeaders(): array
	{
		return ['Content-Type' => 'application/json'];
	}
}