<?php

namespace App\MySchema\Types;

use GraphQL\Type\Definition\Type;
use App\MySchema\TypeRegistry;

class UserType extends ObjectTypeExtension
{
    public function __construct()
    {
        $this->fields = function() {
            return [
                'id' => [
                    'type' => Type::int(),
                ],
                'username' => [
                    'type' => Type::string(),
                    'defaultValue' => 'defaultUsername',
                ],
                'password' => [
                    'type' => Type::string(),
                    'defaultValue' => 'defaultPassword',
                ],
                'email' => [
                    'type' => Type::string(),
                ],
                'posts' => [
                    'type' => Type::listOf(TypeRegistry::postType()),
                ]
            ];
        };

        parent::__construct();
    }

    protected function resolveUsername($userObj)
    {
        return $userObj->username;
    }

    protected function resolvePassword($userObj)
    {
        return 'hashed: ' . hash('sha256', $userObj->password);
    }

    protected function resolvePosts()
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

        return $posts;
    }
}
