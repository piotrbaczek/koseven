<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Field
 *
 * @author nzpetter
 */
abstract class Jelly_Field extends Jelly_Core_Field
{

	public $private = FALSE;

	public function __construct($options = array())
	{
		parent::__construct($options);
		if (!array_key_exists('private', (array) $options))
		{
			$this->private = FALSE;
		}
	}

}
