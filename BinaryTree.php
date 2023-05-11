<?php



require_once 'TreeNode.php';
class BinaryTree
{
    public $root;

    function __construct() {
        $this->root = null;
    }

    private function addNodeRecursive(&$current, $data) {
        if ($current == null) {
            $current = new TreeNode($data);
        } elseif ($data < $current->data) {
            $this->addNodeRecursive($current->left, $data);
        } elseif ($data > $current->data) {
            $this->addNodeRecursive($current->right, $data);
        } else {
            return "Already exist";
        }
    }

    public function addNode($data) {
        $this->addNodeRecursive($this->root, $data);
    }


    private function traversePreOrderRecursive($node, &$result) {
        if ($node != null) {
            $result[] = $node->data;
            $this->traversePreOrderRecursive($node->left, $result);
            $this->traversePreOrderRecursive($node->right, $result);
        }
    }

    public function traversePreOrder() {
        $result = [];
        $this->traversePreOrderRecursive($this->root, $result);
        return $result;
    }

    private function traversePostOrderRecursive($node, &$result) {
        if ($node != null) {
            $this->traversePostOrderRecursive($node->left, $result);
            $this->traversePostOrderRecursive($node->right, $result);
            $result[] = $node->data;
        }
    }

    public function traversePostOrder() {
        $result = [];
        $this->traversePostOrderRecursive($this->root, $result);
        return $result;
    }
}

$tree= new BinaryTree();
$tree->addNode(5);
$tree->addNode(4);
$tree->addNode(7);
$tree->addNode(9);
$tree->addNode(3);
$tree->addNode(2);
$tree->addNode(6);
print_r($tree);

print_r($tree->traversePreOrder());
//5 4 3 2 7 6 9
print_r($tree->traversePostOrder());
//2 3 4 5 6 9 7 5