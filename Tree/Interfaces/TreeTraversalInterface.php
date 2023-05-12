<?php
namespace Tree\Interfaces;
use Tree\Classes\TreeNode;

interface TreeTraversalInterface
{
    public function traversalPreOrder(TreeNode $node): array;
    public function traversalPostOrder(TreeNode $node): array;

}