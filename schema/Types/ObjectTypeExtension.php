<?php

namespace MySchema\Types;

use GraphQL\Type\Definition\ObjectType;

class ObjectTypeExtension extends ObjectType {

    protected $fields = [];

    public function __construct()
    {
        $config['fields'] = $this->fields;

        if (method_exists($this, 'resolveField')) {
            $config['resolveField'] = [$this, 'resolveField'];
        }

        parent::__construct($config);
    }
}
