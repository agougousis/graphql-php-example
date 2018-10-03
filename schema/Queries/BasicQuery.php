<?php

namespace MySchema\Queries;

class BasicQuery implements QueryDefinition
{

    protected $type;
    protected $args;

    public function getType()
    {
        return $this->type;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public function getResolveFunction(): Callable
    {
        return [$this, 'resolve'];
    }

    public function resolve($root, $args)
    {
        throw new \Exception('No resolve function defined for ' . get_class($this));
    }
}
