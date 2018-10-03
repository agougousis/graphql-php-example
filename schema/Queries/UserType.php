<?php

namespace MySchema\Queries;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UserType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'user',
            'fields' => [
                'username' => [
                    'type' => Type::string(),
                    'defaultValue' => 'efefefe',
                    'resolve' => function() {
                        return 'ehgrhe';
                    }
                ],
                'password' => [
                    'type' => Type::string(),
                    'defaultValue' => 'efefefe',
                    'resolve' => function() {
                        return 'egrqhrra';
                    }
                ]
            ],
            'resolve' => function ($root, $args) {
                $user = new \stdClass();
                $user->username = 'rgrhgre';
                $user->password = 'egegherg';

                return $user;
            }
        ];
        parent::__construct($config);
    }
}
