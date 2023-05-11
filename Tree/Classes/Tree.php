<?php

namespace Tree\Classes;

use Queue\Classes\Queue;
use Stack\Classes\Stack;
use Tree\Interfaces\TreeTraversalInterface;

class Tree implements TreeTraversalInterface
{
    private TreeNode $root;

    public function __construct(TreeNode $root = null)
    {
        $this->root = $root;
    }

    public function getRoot(): ?TreeNode
    {
        return $this->root;
    }

    public function setRoot(TreeNode $root): void
    {
        $this->root = $root;
    }

    public function traversePreOrder(TreeNode $node): array
    {
        $result = [];

        $queue = new Queue();

        $queue->enqueue($node);

        while (!$queue->isEmpty()) {
            $currentNode = $queue->dequeue();

            $result[] = $currentNode->getValue();

            foreach ($currentNode->getChildren() as $child) {
                $queue->enqueue($child);
            }
        }

        return $result;
    }

    public function traversePostOrder(TreeNode $node): array
    {
        $stack = new Stack();
        $stack->push([$node, false]); // Push the root node with its initial flag value

        $result = [];

        while (!$stack->isEmpty()) {
            [$currentNode, $processed] = $stack->pop();

            if ($currentNode === null) {
                continue;
            }

            if ($processed) {
                $result[] = $currentNode->getValue();
            } else {
                // Push children in reverse order to simulate post-order traversal
                $children = array_reverse($currentNode->getChildren());
                foreach ($children as $child) {
                    $stack->push([$child, false]); // Push children with flag value as false
                }
                $stack->push([$currentNode, true]); // Push the current node with flag value as true
            }
        }

        return $result;
    }

//    public function traversePostOrder(TreeNode $node): array
//    {
//        $stackTraversal = new Stack();
//        $stackResults = new Stack();
//
//        $stackTraversal->push($node);
//
//        while (!$stackTraversal->isEmpty()) {
//            $currentNode = $stackTraversal->pop();
//            $stackResults->push($currentNode->getValue());
//
//            $children = $currentNode->getChildren();
//
//            foreach ($children as $child) {
//                $stackTraversal->push($child);
//            }
//        }
//
//        $result = [];
//
//        foreach ($stackResults as $item) {
//            $result[] = $item;
//        }
//
//        return $result;
//    }
}

/*

$a = [
    'maps' => [
        [
            'name' => 'qweqwe',
        ],
        [
            'name' => 'qweqwe',
        ]
    ],
    ...
]

[
    'name' => '123123',
    'maps' => [...],
    'insertedChildren' => [...]
]

[
    value => [
        'maps' => [],
        'name' => ''
    ],
    children => [...'insertedChildren']
]

childrenField = 'maps'


 */