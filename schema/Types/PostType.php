<?php

namespace App\MySchema\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

class PostType extends ObjectTypeExtension
{
    public function __construct()
    {
        $this->fields = [
            'id' => [
                'type' => Type::int(),
            ],
            'title' => [
                'type' => Type::string(),
            ],
            'authorId' => [
                'type' => Type::int(),
            ],
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
