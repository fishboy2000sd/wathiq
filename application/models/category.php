<?php namespace Model;

/* This basic model has been auto-generated by the Gas ORM */

use \Gas\Core;
use \Gas\ORM;

class Category extends ORM {
	
	public $primary_key = 'id';

	function _init()
	{
		self::$fields = array(
			'id' => ORM::field('auto[11]'),
			'name' => ORM::field('char[45]'),
			'icon' => ORM::field('char[45]'),
		);

	}
}