<?php namespace Model\Role;

use \Gas\Core;
use \Gas\ORM;

class Privilege extends ORM {

        function _init()
        {
                // Define relationships
                self::$relationships = array(
                        'privilege' => ORM::belongs_to('\\Model\\Privilege'),
                        'role'  => ORM::belongs_to('\\Model\\Role'),
                );

                // Define fields definition
                self::$fields = array(
                        //'id'         => ORM::field('auto[11]'),
                        'privilege_id'    => ORM::field('int[11]'),
                        'role_id'     => ORM::field('int[11]'),
                );
        }
}