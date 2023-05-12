<?php

namespace CodeBaseTeam\DataStructures\Tree;

final class TreeNode
{
    public mixed $value;
    public ?TreeNode $parent;

    /**
     * @var array<TreeNode>
     */
    public array $children;

    function __construct($value = null) {
        $this->value = $value;
        $this->parent = null;
        $this->children = [];
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