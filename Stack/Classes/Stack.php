<?php

namespace Stack\Classes;

use Stack\Interfaces\StackInterface;

class Stack implements StackInterface
{
    private array $stack;

    public function __construct()
    {
        $this->stack = [];
    }

    public function push($item): void
    {
        $this->stack[] = $item;
    }

    public function pop()
    {
        return array_pop($this->stack);
    }

    public function peek()
    {
        return end($this->stack);
    }

    public function isEmpty(): bool
    {
        return empty($this->stack);
    }

    public function size(): int
    {
        return count($this->stack);
    }

    public function clear(): void
    {
        $this->stack = [];
    }
}