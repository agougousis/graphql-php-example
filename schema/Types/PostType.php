<?php

namespace App\MySchema\Types;

use GraphQL\Type\Definition\Type;
use App\MySchema\TypeRegistry;
use GraphQL\Type\Definition\ResolveInfo;

class PostType extends ObjectTypeExtension
{
    public function __construct()
    {
        $this->setFields([
            'id' => [
                'type' => Type::int(),
            ],
            'title' => [
                'type' => Type::string(),
            ],
            'authorId' => [
                'type' => Type::int(),
            ],
            'author' => [
                'type' => TypeRegistry::userType(),
            ],
        ]);

        parent::__construct();
    }

    protected function resolveAuthor($postObj)
    {
        $user = (object) [
          'id' => $postObj->authorId,
          'username' => 'Alexandros',
          'password' => 'wr3v43Rg3',
          'email' => 'alex@gmail.com'
        ];

        return $user;
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
