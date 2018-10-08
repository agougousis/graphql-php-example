<?php

namespace App\MySchema\Types;

use GraphQL\Type\Definition\Type;
use App\MySchema\TypeRegistry;

class PostType extends ObjectTypeExtension
{
    public function __construct()
    {
        $this->fields = function() {
            return [
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
            ];
            };

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
}
