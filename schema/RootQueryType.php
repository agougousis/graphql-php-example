<?php

namespace MySchema;

use GraphQL\Type\Definition\ObjectType;
use MySchema\Queries\QueryDefinition;

class RootQueryType extends ObjectType
{
    private $queriesToExpose = [
        'echo2',
        'user'
    ];

    public function __construct()
    {
        $config = [
            'fields' => []
        ];

        foreach ($this->queriesToExpose as $queryName) {
            $queryDefinition = $this->getQueryDefinition($queryName);

            $config['fields'][$queryName] = [
                'type' => $queryDefinition->getType(),
                'args' => $queryDefinition->getArgs(),
                'resolve' => $queryDefinition->getResolveFunction()
            ];
        }

        parent::__construct($config);
    }

    private function getQueryDefinition($queryName): QueryDefinition
    {
        $queryClassName = 'MySchema\Queries\\' . $queryName;

        return new $queryClassName;
    }
}
