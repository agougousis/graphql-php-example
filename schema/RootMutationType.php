<?php

namespace MySchema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class RootMutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Calc',
            'fields' => [
                'sum' => [
                    'type' => Type::int(),
                    'args' => [
                        'x' => ['type' => Type::int()],
                        'y' => ['type' => Type::int()],
                    ],
                    'resolve' => function ($root, $args) {
                        return $args['x'] + $args['y'];
                    },
                ],
            ],
        ];
        parent::__construct($config);
    }
}
