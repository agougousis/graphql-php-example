<?php

namespace MySchema\Queries;

use GraphQL\Type\Definition\Type;

class echo2 extends BasicQuery
{

    public function __construct()
    {
        $this->type = Type::string();

        $this->args = [
            'message' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        return $root['prefix'] . $args['message'];
    }
}

