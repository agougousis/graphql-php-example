<?php

namespace MySchema\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class UserType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'username' => [
                        'type' => Type::string(),
                        'defaultValue' => 'defaultUsername',
                        'resolve' => function ($userObj) {
                            return $userObj->username;
                        }
                    ],
                    'password' => [
                        'type' => Type::string(),
                        'defaultValue' => 'defaultPassword',
                        'resolve' => function ($userObj) {
                            return 'hashed: ' . hash('sha256', $userObj->password);
                        }
                    ],
                    'email' => [
                        'type' => Type::string(),
                    ]
                ];
            },
            'resolveField' => function($value, $args, $context, ResolveInfo $info) {
                $method = 'resolve' . ucfirst($info->fieldName);
                if (method_exists($this, $method)) {
                    return $this->{$method}($value, $args, $context, $info);
                } else {
                    return $value->{$info->fieldName};
                }
            }
        ];
        parent::__construct($config);
    }
}
