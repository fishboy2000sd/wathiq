<?php namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Privilege extends ORM {

        function _init()
        {
                // Relationship definition
                self::$relationships = array(                        
                        'role'  => ORM::has_many('\\Model\\Role\\Privilege => \\Model\\Role'),
                );

                // Field definition
                self::$fields = array(
                        'id'       => ORM::field('auto[11]'),
                        'name'     => ORM::field('char[100]'),
                        'code'     => ORM::field('char[100]'),
                );
        }
}