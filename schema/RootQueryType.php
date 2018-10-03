<?php

namespace MySchema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class RootQueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'echo2' => [
                    'type' => Type::string(),
                    'args' => [
                        'message' => ['type' => Type::string()],
                    ],
                    'resolve' => function ($root, $args) {
                        return $root['prefix'] . $args['message'];
                    }
                ],
                'user' => [
                    'type' => TypeRegistry::userType(),
                    'args' => [
                        'message' => ['type' => Type::string()],
                    ],
                ]
            ],
        ];
        parent::__construct($config);
    }
}
