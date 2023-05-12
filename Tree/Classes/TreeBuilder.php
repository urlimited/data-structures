<?php

namespace Tree\Classes;

use Stack\Classes\Stack;

final class TreeBuilder
{
    private static string $childrenField = 'children';

    public static function convertArrayToTree(array $array): Tree
    {
        $root = new TreeNode(null);
        $stack = new Stack();
        $stack->push([$root, $array]);

        while (!$stack->isEmpty()) {
            [$currentNode, $currentArray] = $stack->pop();

            $children = $currentArray[self::$childrenField] ?? [];

            $value = [
                ...array_filter($currentArray, fn($item, $key) => $key !== self::$childrenField, ARRAY_FILTER_USE_BOTH)
            ];

            $currentNode->setValue($value);

            foreach ($children as $childArray) {
                $childNode = new TreeNode(null);
                $currentNode->addChild($childNode);
                $stack->push([$childNode, $childArray]);
            }
        }

        return new Tree($root);
    }

    public static function setChildrenField(string $childrenField): void
    {
        self::$childrenField = $childrenField;
    }
}


