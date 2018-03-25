<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Country
 *
 * @author nzpetter
 */
class Model_Country extends Jelly_Model
{

	/**
	 * @inheritdoc
	 */
	public static function initialize(Jelly_Meta $meta)
	{
		$meta->sorting(array(
			'id' => 'ASC'
		))->fields(array(
			'id' => Jelly::field('primary'),
			'code' => Jelly::field('string'),
			'name' => Jelly::field('string')
		));
	}

}
