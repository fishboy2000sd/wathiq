<?php namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Role extends ORM {

        function _init()
        {
                // Relationship definition
                self::$relationships = array(                        
                        'privilege'  => ORM::has_many('\\Model\\Role\\Privilege => \\Model\\Privilege'),
                );

                // Field definition
                self::$fields = array(
                        'id'       => ORM::field('auto[11]'),
                        'name'     => ORM::field('char[100]'),
                );
        }
}