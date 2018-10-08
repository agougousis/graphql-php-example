<?php
namespace App\MySchema;

use App\MySchema\Types\UserType;
use App\MySchema\Types\PostType;

class TypeRegistry
{
    private static $userType;
    private static $postType;

    public static function userType()
    {
        return self::$userType ?: (self::$userType = new UserType());
    }

    public static function postType()
    {
        return self::$postType ?: (self::$postType = new PostType());
    }
}
