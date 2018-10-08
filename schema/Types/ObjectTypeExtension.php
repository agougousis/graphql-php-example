<?php

namespace App\MySchema\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class ObjectTypeExtension extends ObjectType {

    protected $fields;

    public function __construct()
    {
        $config['fields'] = $this->fields;

        if (method_exists($this, 'resolveField')) {
            $config['resolveField'] = [$this, 'resolveField'];
        }

        parent::__construct($config);
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
