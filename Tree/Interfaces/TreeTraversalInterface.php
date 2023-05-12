<?php

namespace CodeBaseTeam\DataStructures\Tree\Interfaces;

use CodeBaseTeam\DataStructures\Tree\TreeNode;

interface TreeTraversalInterface
{
    public function traversalPreOrder(
        TreeNode  $node,
        ?callable $callback = null
    ): void;

    public function traversalPostOrder(
        TreeNode  $node,
        ?callable $callback = null
    ): void;
}