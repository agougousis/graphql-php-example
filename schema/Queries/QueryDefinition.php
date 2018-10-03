<?php

namespace App\MySchema\Queries;

interface QueryDefinition {
    public function getType();
    public function getArgs() : array;
    public function getResolveFunction() : Callable;
}
