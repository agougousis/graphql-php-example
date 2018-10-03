<?php
namespace MySchema;

use MySchema\Queries\UserType;

class TypeRegistry
{
    private  static $userType;

    public static function userType()
    {
        return self::$userType ?: (self::$userType = new UserType());
    }
}
