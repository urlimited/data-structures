<?php

namespace CodeBaseTeam\DataStructures\Stack\Interfaces;

interface StackInterface
{
    public function push($item);

    public function pop();

    public function peek();

    public function isEmpty();

    public function size();

    public function clear();
}