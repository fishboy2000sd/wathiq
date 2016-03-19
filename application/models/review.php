<?php namespace Model;

/* This basic model has been auto-generated by the Gas ORM */

use \Gas\Core;
use \Gas\ORM;

class Review extends ORM {
	
	public $primary_key = 'id';

	function _init()
	{
		self::$relationships = array(        
            'review'  => ORM::belongs_to('\\Model\\app'),
        );
		self::$fields = array(
			'id' => ORM::field('auto[11]'),
			'rating' => ORM::field('numeric'),
			'app_id' => ORM::field('int[11]'),
		);

	}
}