<?php

namespace Tree;

class TreeNode
{
    public mixed $value;
    public ?TreeNode $parent;

    /**
     * @var array<TreeNode>
     */
    public array $children;

    function __construct($value) {
        $this->value = $value;
        $this->parent = null;
        $this->children = [];
    }

    public function getValue()
    {
        return $this->value;
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
}