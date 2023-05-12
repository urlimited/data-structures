<?php

namespace Tree\Tests;

use PHPUnit\Framework\TestCase;
use Tree\Classes\Tree;
use Tree\Classes\TreeBuilder;
use Tree\Classes\TreeNode;
use function PHPUnit\Framework\assertEquals;

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
                [
                    "name" => "dust",
                    "width" => 1500,
                    "height" => 1400,
                    "children" => [
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
                ],
                [
                    "name" => "mirage",
                    "width" => 1080,
                    "height" => 1920
                ]
            ]
        ];
        $expectedTree = new Tree(new TreeNode(null));
        $expectedTree->getRoot()->setValue([
            "players" => [
                [
                    "name" => "Adam",
                    "rank" => "global"
                ],
                [
                    "name" => "Bob",
                    "rank" => "global"
                ]
            ]
        ]);
        $expectedTree->getRoot()->addChild(new TreeNode([
            "name" => "dust",
            "width" => 1500,
            "height" => 1400,
            "children" => new TreeNode([
                [
                    "name" => "inferno",
                    "width" => 800,
                    "height" => 1000
                ],
                [
                    "name" => "nuke",
                    "width" => 1280,
                    "height" => 1520
                ]
            ])
        ]));
        $expectedTree->getRoot()->addChild(new TreeNode([
            "name" => "mirage",
            "width" => 1080,
            "height" => 1920
        ]));


        $treeBuilder = new TreeBuilder();
        $treeBuilder->setChildrenField('children');
        $tree = $treeBuilder->convertArrayToTree($elements);
//        var_dump($expectedTree->getRoot()->toArray());

//        var_dump($tree->getRoot()->toArray());
        $this->assertEquals( $expectedTree,$tree);
    }
}
