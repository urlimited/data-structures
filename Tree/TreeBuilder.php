<?php

namespace CodeBaseTeam\DataStructures\Tree;

use CodeBaseTeam\DataStructures\Stack\Classes\Stack;
use CodeBaseTeam\DataStructures\Tree\Exceptions\InvalidDataException;

final class TreeBuilder
{
    private static string $childrenField = 'children';

    /**
     * @throws InvalidDataException
     */
    public static function fromArray(array $data): Tree
    {
        $root = new TreeNode(null);
        $stack = new Stack();
        $stack->push([$root, $data]);

        while (!$stack->isEmpty()) {
            [$currentNode, $currentData] = $stack->pop();

            $children = $currentData[self::$childrenField] ?? [];

            if (!array_is_list($children)) {
                throw new InvalidDataException();
            }

            $value = array_filter($currentData, fn($item, $key) => $key !== self::$childrenField, ARRAY_FILTER_USE_BOTH);

            $currentNode->setValue($value);

            foreach ($children as $childData) {
                $childNode = new TreeNode(null);
                $currentNode->addChild($childNode);
                $stack->push([$childNode, $childData]);
            }
        }

        return new Tree($root);
    }

    public static function setChildrenField(string $childrenField): void
    {
        self::$childrenField = $childrenField;
    }
}


