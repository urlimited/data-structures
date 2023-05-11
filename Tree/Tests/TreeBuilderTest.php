<?php

namespace Tree\Tests;

use PHPUnit\Framework\TestCase;
use Tree\Classes\Tree;
use Tree\Classes\TreeBuilder;

class TreeBuilderTest extends TestCase
{
    public function testTreeBuilder()
    {
        $elements = [
            "players" => [
                [
                    "name" => "Adam",
                    "rank" => "global"
                ],
                [
                    "name" => "Bob",
                    "rank" => "global"
                ]
            ],
            "children" => [
//                [
                [
                    "name" => "dust",
                    "width" => 1500,
                    "height" => 1400
                ],
                [
                    "name" => "mirage",
                    "width" => 1080,
                    "height" => 1920
                ]
                ]
//            ]
        ];


        $treeBuilder = new TreeBuilder();
        $treeBuilder->setChildrenField('children');
        $tree = new Tree($treeBuilder->convertArrayToTree($elements));

        var_dump($tree);

    }
}
