<?php
namespace Tree\Interfaces;
use Tree\Classes\TreeNode;

interface TreeTraversalInterface
{
    public function traversePreOrder(TreeNode $node): array;
    public function traversePostOrder(TreeNode $node): array;

}