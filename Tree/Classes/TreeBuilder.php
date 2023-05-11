<?php

namespace Tree\Classes;

use Stack\Classes\Stack;

class TreeBuilder
{

    private ?string $childrenField = null;
    public function convertArrayToTree(array $array): TreeNode
    {
        $root = new TreeNode(null);
        $stack = new Stack();
        $stack->push([$root, $array]);

        while (!$stack->isEmpty()) {
            [$parentNode, $currentArray] = $stack->pop();

            foreach ($currentArray as $key => $value) {
                if ($key === $this->childrenField) {
                    foreach ($value as $childArray) {
                        $childNode = new TreeNode(null);
                        $parentNode->addChild($childNode);
                        $stack->push([$childNode, $childArray]);
                    }
                } else {
                    $childNode = new TreeNode($key);
                    $childNode->setValue($value);
                    $parentNode->addChild($childNode);
                }
            }
        }

        return $root;
    }

    public function setChildrenField(string $childrenField): void
    {
        $this->childrenField = $childrenField;
    }
}


