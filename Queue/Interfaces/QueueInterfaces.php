<?php

namespace CodeBaseTeam\DataStructures\Queue\Interfaces;

interface QueueInterfaces
{
    public function enqueue($item);

    public function dequeue();

    public function peek();

    public function isEmpty();

    public function size();

    public function clear();
}