<?php

namespace App\MySchema\Queries;

use GraphQL\Type\Definition\Type;
use App\MySchema\TypeRegistry;

class user extends BasicQuery
{

    public function __construct()
    {
        $this->type = TypeRegistry::userType();

        $this->args = [
            'message' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, $args)
    {
        $user = new \stdClass();
        $user->username = 'Alexandros';
        $user->password = 'wr3v43Rg3';
        $user->email = 'alex@gmail.com';

        return $user;
    }
}

