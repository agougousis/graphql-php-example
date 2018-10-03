<?php
namespace MySchema;

use App\MySchema\Types\UserType;

class TypeRegistry
{
    private  static $userType;

    public static function userType()
    {
        return self::$userType ?: (self::$userType = new UserType());
    }
}
