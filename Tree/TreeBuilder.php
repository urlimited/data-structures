<?php

namespace CodeBaseTeam\DataStructures\Tree;

use CodeBaseTeam\DataStructures\Stack\Classes\Stack;
use CodeBaseTeam\DataStructures\Tree\Exceptions\InvalidDataException;

final class TreeBuilder
{
    private static ?string $childrenFieldKey = null;
    private static array $metaFieldsKeys = ['id', 'meta'];
    private static ?string $valueContentField = null;

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

            $oldCurrentData = $currentData;

            if (self::$valueContentField) {
                $currentData = $currentData[self::$valueContentField] ?? throw new InvalidDataException();
            }

            $meta = [];

            // Identify what we call children
            if (is_null(self::$childrenFieldKey)) {
                $children = [];

                foreach ($currentData as $key => $value) {
                    if (in_array($key, self::$metaFieldsKeys)) {
                        continue;
                    }

                    if (is_array($value)) {
                        $children[$key] = $value;
                    }
                }
            } else {
                $children = $currentData[self::$childrenFieldKey] ?? [];
            }

            if (
                (is_null(self::$childrenFieldKey) && !is_array($children))
                || (!is_null(self::$childrenFieldKey) && !array_is_list($children))
            ) {
                throw new InvalidDataException();
            }

            if (array_key_exists('meta', $oldCurrentData)) {
                $meta = $oldCurrentData['meta'];
            }

            // What is value for us
            $value = array_filter(
                $currentData,
                function($item, $key) use (&$meta) {
                    if (in_array($key, self::$metaFieldsKeys)) {
                        $meta[$key] = $item;

                        return false;
                    }

                    if (is_null(self::$childrenFieldKey) && is_array($item)) {
                        return false;
                    }

                    if(is_null(self::$childrenFieldKey) || $key == self::$childrenFieldKey) {
                        return false;
                    }

                    return true;
                },
                ARRAY_FILTER_USE_BOTH
            );

            $currentNode->setValue($value);

            // What is meta for us
            $currentNode->setMeta($meta);

            // Set children
            foreach ($children as $childKey => $childData) {
                $childNode = new TreeNode(
                    tree: $tree,
                    value: null
                );

                if (is_string($childKey)) {
                    $childNode->setKey($childKey);
                }

                $currentNode->addChild($childNode);

                if (
                    (
                        is_null(self::$valueContentField)
                        && is_array($childData)
                    )
                    || (
                        !is_null(self::$valueContentField)
                        && is_array($childData[self::$valueContentField])
                    )
                ) {
                    $stack->push([$childNode, $childData]);
                } else {
                    if (!is_null(self::$valueContentField)) {
                        $childNode->setValue($childData[self::$valueContentField] ?? throw new InvalidDataException());
                    }

                    $meta = [];

                    if (is_array($childData) && array_key_exists('meta', $childData)) {
                        $meta = $childData['meta'];
                    }

                    if (!is_null(self::$metaFieldsKeys)) {
                        if (!is_null(self::$valueContentField) && is_array($childData[self::$valueContentField])) {
                            foreach($childData[self::$valueContentField] as $childDataKey => $childDataItem) {
                                if (in_array($childDataKey, self::$metaFieldsKeys)) {
                                    $meta[$childDataKey] = $childDataItem;
                                }
                            }
                        } elseif(is_array($childData) && is_null(self::$valueContentField)) {
                            foreach($childData as $childDataKey => $childDataItem) {
                                if (in_array($childDataKey, self::$metaFieldsKeys)) {
                                    $meta[$childDataKey] = $childDataItem;
                                }
                            }
                        }
                    }

                    $childNode->setMeta($meta);
                }
            }
        }

        return $tree;
    }

    public static function setChildrenFieldKey(?string $childrenField): void
    {
        self::$childrenFieldKey = $childrenField;
    }

    public static function setMetaFieldKeys(array $metaFields): void
    {
        self::$metaFieldsKeys = $metaFields;
    }

    public static function setValueContentFieldKey(?string $contentField): void
    {
        self::$valueContentField = $contentField;
    }
}


