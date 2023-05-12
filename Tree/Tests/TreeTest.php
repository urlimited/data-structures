<?php

namespace Tree\Tests;

use PHPUnit\Framework\TestCase;
use Tree\Classes\Tree;
use Tree\Classes\TreeNode;


class TreeTest extends TestCase
{
    public function testTraversePreOrder()
    {
        // Create the tree structure
        $root = new TreeNode(1);
        $node2 = new TreeNode(2);
        $node3 = new TreeNode(3);
        $node4 = new TreeNode(4);
        $node5 = new TreeNode(5);
        $node6 = new TreeNode(6);
        $node7 = new TreeNode(7);
        $node8 = new TreeNode(8);
        $node9 = new TreeNode(9);
        $node10 = new TreeNode(10);

        $root->addChild($node2);
        $root->addChild($node3);
        $node2->addChild($node4);
        $node2->addChild($node5);
        $node3->addChild($node6);
        $node3->addChild($node7);
        $node4->addChild($node8);
        $node5->addChild($node9);
        $node6->addChild($node10);

        $tree = new Tree($root);

        // Perform the traversal
        $result = $tree->traversalPreOrder($root);

        // Assert the expected result
        $expectedResult = [1,2,3 ,4,5 ,6,7,8,9,10];
        $this->assertEquals($expectedResult, $result);
    }

    public function testTraversePostOrder()
    {
        // Create the tree structure
        $root = new TreeNode(1);
        $node2 = new TreeNode(2);
        $node3 = new TreeNode(3);
        $node4 = new TreeNode(4);
        $node5 = new TreeNode(5);
        $node6 = new TreeNode(6);
        $node7 = new TreeNode(7);
        $node8 = new TreeNode(8);
        $node9 = new TreeNode(9);
        $node10 = new TreeNode(10);


        $root->addChild($node2);
        $root->addChild($node3);
        $node2->addChild($node4);
        $node2->addChild($node5);
        $node3->addChild($node6);
        $node3->addChild($node7);
        $node4->addChild($node8);
        $node5->addChild($node9);
        $node6->addChild($node10);

        $tree = new Tree($root);
        // Perform the traversal
        $result = $tree->traversalPostOrder($root);

        // first shows the latest additions on the right side and then on the left side starting from the right
        $expectedResult = [8,4,9,5,2,10,6,7,3,1];
        $this->assertEquals($expectedResult, $result);
    }
}