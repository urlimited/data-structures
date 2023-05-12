<?php

namespace CodeBaseTeam\DataStructures\Queue\Classes;


use CodeBaseTeam\DataStructures\Queue\Interfaces\QueueInterfaces;

class Queue implements QueueInterfaces
{
    private array $queue;

    public function __construct()
    {
        $this->queue = [];
    }

    public function enqueue($item): void
    {
        $this->queue[] = $item;
    }

    public function dequeue()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return array_shift($this->queue);
    }

    public function peek()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->queue[0];
    }

    public function isEmpty(): bool
    {
        return empty($this->queue);
    }

    public function size(): int
    {
        return count($this->queue);
    }

    public function clear(): void
    {
        $this->queue = [];
    }
}