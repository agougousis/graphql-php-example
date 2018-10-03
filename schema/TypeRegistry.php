<?php
namespace MySchema;

use MySchema\Types\UserType;

class TypeRegistry
{
    private  static $userType;

    public static function userType()
    {
        return self::$userType ?: (self::$userType = new UserType());
    }
}
