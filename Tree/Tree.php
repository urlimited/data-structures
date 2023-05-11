<?php

namespace Tree;

use SplQueue;
use SplStack;
use Tree\TreeTraversalInterface;
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

        $queue = new SplQueue();

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
        $stackTraversal = new SplStack();
        $stackResults = new SplStack();

        $stackTraversal->push($node);

        while (!$stackTraversal->isEmpty()) {
            $currentNode = $stackTraversal->pop();
            $stackResults->push($currentNode->getValue());

            $children = $currentNode->getChildren();

            foreach ($children as $child) {
                $stackTraversal->push($child);
            }
        }

        $result = [];

        foreach ($stackResults as $item) {
            $result[] = $item;
        }

        return $result;
    }
}