<?php

namespace CodeBaseTeam\DataStructures\Tree\Tests\Tree;

use CodeBaseTeam\DataStructures\Tree\Tree;
use CodeBaseTeam\DataStructures\Tree\TreeNode;
use PHPUnit\Framework\TestCase;


class TreeTest extends TestCase
{
    public function testTraversePreOrder()
    {
        // Create the tree structure
        $tree = $this->generateTree();
        $root = $tree->getRoot();

        $result = [];

        // Perform the traversal
        $tree->traversalPreOrder(
            $root,
            function(TreeNode $node) use (&$result) {
                $result[] = $node->value;
            }
        );

        $expectedResult = [1,2,3 ,4,5 ,6,7,8,9,10];
        $this->assertEquals($expectedResult, $result);
    }

    public function testTraversePostOrder()
    {
        // Create the tree structure
        $tree = $this->generateTree();
        $root = $tree->getRoot();

        $result = [];

        // Perform the traversal
        $tree->traversalPostOrder(
            $root,
            function(TreeNode $node) use (&$result) {
                $result[] = $node->value;
            }
        );

        // first shows the latest additions on the right side and then on the left side starting from the right
        $expectedResult = [8,4,9,5,2,10,6,7,3,1];

        $this->assertEquals($expectedResult, $result);
    }

    private function generateTree(): Tree
    {
        $tree = new Tree();

        $root = $tree->getRoot();

        $root->setValue(1);

        $node2 = new TreeNode($tree, 2);
        $node3 = new TreeNode($tree, 3);
        $node4 = new TreeNode($tree, 4);
        $node5 = new TreeNode($tree, 5);
        $node6 = new TreeNode($tree, 6);
        $node7 = new TreeNode($tree, 7);
        $node8 = new TreeNode($tree, 8);
        $node9 = new TreeNode($tree, 9);
        $node10 = new TreeNode($tree, 10);

        $root->addChild($node2);
        $root->addChild($node3);
        $node2->addChild($node4);
        $node2->addChild($node5);
        $node3->addChild($node6);
        $node3->addChild($node7);
        $node4->addChild($node8);
        $node5->addChild($node9);
        $node6->addChild($node10);

        return $tree;
    }
}