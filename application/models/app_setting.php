<?php namespace Model;

/* This basic model has been auto-generated by the Gas ORM */

use \Gas\Core;
use \Gas\ORM;

class App_setting extends ORM {
	public $table = 'app_setting';
	public $primary_key = 'id';

	function _init()
	{
		self::$fields = array(
			'id' => ORM::field('auto[11]'),
			'name' => ORM::field('char[45]'),
			'version' => ORM::field('char[45]'),
			'download_no' => ORM::field('int[11]'),
			'package_name' => ORM::field('char[45]'),
			'about' => ORM::field('string'),
			'updated' => ORM::field('datetime'),
			'force' => ORM::field('numeric[4]'),
		);

	}
}