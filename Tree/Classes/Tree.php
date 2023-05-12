<?php

namespace Tree\Classes;

use Queue\Classes\Queue;
use Stack\Classes\Stack;
use Tree\Interfaces\TreeTraversalInterface;

class Tree extends \Tree\Classes\TreeNode implements TreeTraversalInterface
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

    /**
     * @benchmark 1000 elements works with ... Mb \
     *      10 elements works with ... Mb
     */
    public function traversalPreOrder(
        TreeNode $node,
        ?callable $callback = null,
        array $callableParameters = []
    ):void
    {
        $result = [];

        $queue = new Queue();

        $queue->enqueue($node);

        $callback(...$callableParameters);

        while (!$queue->isEmpty()) {
            $currentNode = $queue->dequeue();

            $result[] = $currentNode->getValue();

            foreach ($currentNode->getChildren() as $child) {
                $queue->enqueue($child);
            }
        }

        foreach($result as $r) {
            $callback($r, ...$callableParameters);
        }


    }

    /**
     * @benchmark 1000 elements works with ... Mb \
     *      10 elements works with ... Mb
     */
    public function traversalPostOrder(
        TreeNode $node,
        ?callable $callback = null,
        array $callableParameters = []
    ): void
    {
        $stackTraversal = new Stack();
        $stackResults = new Stack();

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

        while(!$stackResults->isEmpty()) {
            $result[] = $stackResults->pop();
        }

        foreach($result as $r) {
            $callback($r, ...$callableParameters);
        }


    }
}