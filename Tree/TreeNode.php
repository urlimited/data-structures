<?php

namespace CodeBaseTeam\DataStructures\Tree;

final class TreeNode
{
    public mixed $value;
    public array $meta = [];
    public ?TreeNode $parent;
    public int $id;
    public ?string $key = null;
    public Tree $tree;

    /**
     * @var array<TreeNode>
     */
    public array $children;

    function __construct(Tree $tree, $value = null) {
        $this->value = $value;
        $this->parent = null;
        $this->children = [];

        $this->tree = $tree;

        $this->id = $this->tree->generateNodeId();
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(TreeNode $parent): void
    {
        $this->parent = $parent;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function addChild(TreeNode $child): void
    {
        $child->setParent($this);
        $this->children[] = $child;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function setMeta(array $meta): void
    {
        $this->meta = $meta;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        $result = [
            "value" => $this->value,
            "parent" => null,
            "children" => [],
        ];

        foreach ($this->children as $child) {
            $result["children"][] = $child->toArray();
        }

        return $result;
    }
}