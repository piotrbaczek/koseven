<?php

/**
 * @package        Kohana
 * @category       Controller/Rest
 * @author         Kohana Team
 * @copyright  (c) 2016-2019 Koseven Team
 * @license        https://koseven.ga/LICENSE.md
 */
abstract class Kohana_Controller_Rest_Engine {

	/**
	 * Method that produces output
	 * @param array|null $data
	 * @return string
	 */
	abstract public function getOutput(?array $data): string;

	/**
	 * Get array of input parameters
	 * @param Request $request
	 * @return array
	 */
	abstract public function getInput(Request $request): array;

	/**
	 * Return headers specific for this type response;
	 * @return array
	 */
	abstract public function getResponseHeaders(): array;
}