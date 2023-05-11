<?php

class TreeNode
{
    public $data;
    public $left;
    public $right;

    function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}