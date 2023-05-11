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
        $root = new TreeNode('A');
        $nodeB = new TreeNode('B');
        $nodeC = new TreeNode('C');
        $nodeD = new TreeNode('D');
        $nodeE = new TreeNode('E');
        $nodeF = new TreeNode('F');

        $root->addChild($nodeB);
        $root->addChild($nodeC);
        $nodeB->addChild($nodeD);
        $nodeB->addChild($nodeE);
        $nodeC->addChild($nodeF);

        $tree = new Tree($root);

        // Perform the traversal
        $result = $tree->traversePreOrder($root);

        // Assert the expected result
        $expectedResult = ['A','B', 'C','D', 'E', 'F'];
        $this->assertEquals($expectedResult, $result);
    }

    public function testTraversePostOrder()
    {
        // Create the tree structure
        $root = new TreeNode('A');
        $nodeB = new TreeNode('B');
        $nodeC = new TreeNode('C');
        $nodeD = new TreeNode('D');
        $nodeE = new TreeNode('E');
        $nodeF = new TreeNode('F');

        $root->addChild($nodeB);
        $root->addChild($nodeC);
        $nodeB->addChild($nodeD);
        $nodeB->addChild($nodeE);
        $nodeC->addChild($nodeF);

        $tree = new Tree($root);

        // Perform the traversal
        $result = $tree->traversePostOrder($root);

        // Assert the expected result
        $expectedResult = [ 'A','B','D','E','C','F'];
        $this->assertEquals($expectedResult, $result);
    }
}