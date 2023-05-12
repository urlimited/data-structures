<?php

namespace CodeBaseTeam\DataStructures\Tree;


use CodeBaseTeam\DataStructures\Queue\Classes\Queue;
use CodeBaseTeam\DataStructures\Stack\Classes\Stack;
use CodeBaseTeam\DataStructures\Tree\Interfaces\TreeTraversalInterface;

class Tree implements TreeTraversalInterface
{
    private TreeNode $root;

    public function __construct(TreeNode $root = null)
    {
        $this->root = $root;
    }

    public function toJson(): bool|string
    {
        $clonedRoot = clone $this->root;

        $this->traversalPostOrder(
            $clonedRoot,
            fn(TreeNode $item) => $item->parent = null
        );

        return json_encode($clonedRoot);
    }

    public function getRoot(): ?TreeNode
    {
        return $this->root;
    }

    /**
     * @benchmark 1000 elements works with ... Mb \
     *      10 elements works with ... Mb
     */
    public function traversalPreOrder(
        TreeNode  $node,
        ?callable $callback = null
    ): void
    {
        $result = [];

        $queue = new Queue();

        $queue->enqueue($node);

        while (!$queue->isEmpty()) {
            $currentNode = $queue->dequeue();

            $result[] = $currentNode;

            foreach ($currentNode->getChildren() as $child) {
                $queue->enqueue($child);
            }
        }

        if (!is_null($callback)) {
            foreach ($result as $r) {
                $callback($r);
            }
        }
    }

    /**
     * @benchmark 1000 elements works with ... Mb \
     *      10 elements works with ... Mb
     */
    public function traversalPostOrder(
        TreeNode  $node,
        ?callable $callback = null
    ): void
    {
        $stackTraversal = new Stack();
        $stackResults = new Stack();

        $stackTraversal->push($node);

        while (!$stackTraversal->isEmpty()) {
            $currentNode = $stackTraversal->pop();
            $stackResults->push($currentNode);

            $children = $currentNode->getChildren();

            foreach ($children as $child) {
                $stackTraversal->push($child);
            }
        }

        $result = [];

        while (!$stackResults->isEmpty()) {
            $result[] = $stackResults->pop();
        }

        if (!is_null($callback)) {
            foreach ($result as $r) {
                $callback($r);
            }
        }
    }
}