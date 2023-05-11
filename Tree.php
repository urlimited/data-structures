<?php

require_once 'TreeTraversalInterface.php';
require_once 'TreeNode.php';
class Tree implements TreeTraversalInterface
{
    private $root;

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
        if ($node !== null) {
            $result[] = $node->getValue();
            foreach ($node->getChildren() as $child) {
                $result = array_merge($result, $this->traversePreOrder($child));
            }
        }
        return $result;
    }

    public function traversePostOrder(TreeNode $node): array
    {
        $result = [];
        if ($node !== null) {
            foreach ($node->getChildren() as $child) {
                $result = array_merge($result, $this->traversePostOrder($child));
            }
            $result[] = $node->getValue();
        }
        return $result;
    }
}

// Usage example:
$root = new TreeNode(1);
$node2 = new TreeNode(2);
$node3 = new TreeNode(3);
$node4 = new TreeNode(4);
$node5 = new TreeNode(5);

$root->addChild($node2);
$root->addChild($node3);
$node2->addChild($node4);
$node3->addChild($node5);

$tree = new Tree($root);
print_r($tree);
echo "Pre-order traversal: " . implode(", ", $tree->traversePreOrder($tree->getRoot())) . PHP_EOL;
echo "Post-order traversal: " . implode(", ", $tree->traversePostOrder($tree->getRoot())) . PHP_EOL;