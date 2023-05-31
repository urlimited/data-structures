<?php

namespace CodeBaseTeam\DataStructures\Tree;

use CodeBaseTeam\DataStructures\Stack\Classes\Stack;
use CodeBaseTeam\DataStructures\Tree\Exceptions\InvalidDataException;

final class TreeBuilder
{
    private static string $childrenFieldKey = 'children';

    /**
     * @throws InvalidDataException
     */
    public static function fromArray(array $data): Tree
    {
        $tree = new Tree();
        $root = $tree->getRoot();

        $stack = new Stack();
        $stack->push([$root, $data]);

        while (!$stack->isEmpty()) {
            [$currentNode, $currentData] = $stack->pop();

            $children = $currentData[self::$childrenFieldKey] ?? [];

            if (!array_is_list($children)) {
                throw new InvalidDataException();
            }

            $value = array_filter($currentData, fn($item, $key) => $key !== self::$childrenFieldKey, ARRAY_FILTER_USE_BOTH);

            $currentNode->setValue($value);

            foreach ($children as $childData) {
                $childNode = new TreeNode(
                    tree: $tree,
                    value: null
                );
                $currentNode->addChild($childNode);
                $stack->push([$childNode, $childData]);
            }
        }

        return $tree;
    }

    public static function setChildrenFieldKey(string $childrenField): void
    {
        self::$childrenFieldKey = $childrenField;
    }
}


