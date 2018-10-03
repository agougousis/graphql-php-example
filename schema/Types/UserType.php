<?php

namespace App\MySchema\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use App\MySchema\TypeRegistry;

class UserType extends ObjectTypeExtension
{
    public function __construct()
    {
        $this->fields = [
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

    public function resolveField($value, $args, $context, ResolveInfo $info) {
        $method = 'resolve' . ucfirst($info->fieldName);
        if (method_exists($this, $method)) {
            return $this->{$method}($value, $args, $context, $info);
        } else {
            return $value->{$info->fieldName};
        }
    }
}
