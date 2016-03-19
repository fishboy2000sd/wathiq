<?php namespace Model;

/* This basic model has been auto-generated by the Gas ORM */

use \Gas\Core;
use \Gas\ORM;

class App extends ORM {
	
	public $primary_key = 'id';
	//public $foreign_key = array('\\Model\\app' => 'id', '\\Model\\user' => 'user_id');

	function _init()
	{
		self::$relationships = array(        
            'screen'  => ORM::has_many('\\Model\\screen'),
            'review'  => ORM::has_many('\\Model\\review'),
            'comment'  => ORM::has_many('\\Model\\comment'),
        );

		self::$fields = array(
			'id' => ORM::field('auto[11]'),
			'name' => ORM::field('char[45]'),
			'description' => ORM::field('string'),
			'developer' => ORM::field('char[255]'),
			'company' => ORM::field('char[255]'),
			'url' => ORM::field('char[255]'),
			'icon' => ORM::field('char[45]'),
			'current_version' => ORM::field('char[45]'),
			'required_sdk' => ORM::field('char[45]'),
			//'screen' => ORM::field('char[255]'),
			'package_name' => ORM::field('char[255]'),
			'uses_permission' => ORM::field('string'),
			'size' => ORM::field('numeric'),
			'price' => ORM::field('numeric'),
			'download_no' => ORM::field('int[11]'),
			'status' => ORM::field('numeric[4]'),
			'created' => ORM::field('datetime'),
			'updated' => ORM::field('datetime'),
			'category_id' => ORM::field('int[11]'),
			'user_id' => ORM::field('int[11]'),
		);

	}
}