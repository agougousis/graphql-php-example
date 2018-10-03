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
        $posts[] = (object) [
            'id'       => 3264,
            'title'    => 'Demo title 1',
            'authorId' => 13242
        ];

        $posts[] = (object) [
            'id'       => 883,
            'title'    => 'Demo title 2',
            'authorId' => 13242
        ];

        $user = new \stdClass();
        $user->id = 13242;
        $user->username = 'Alexandros';
        $user->password = 'wr3v43Rg3';
        $user->email = 'alex@gmail.com';
        $user->posts = $posts;

        return $user;
    }
}

