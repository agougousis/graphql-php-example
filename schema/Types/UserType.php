<?php

namespace MySchema\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class UserType extends ObjectTypeExtension
{
    public function __construct()
    {
        $this->fields = [
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
            ]
        ];

        parent::__construct();
    }

    protected function username($userObj)
    {
        return $userObj->username;
    }

    protected function password($userObj)
    {
        return 'hashed: ' . hash('sha256', $userObj->password);
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
