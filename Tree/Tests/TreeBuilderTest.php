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

        $file = __DIR__ . '/stubs/data.json';
        $data = file_get_contents($file);
        $jsonData = json_decode($data, true);

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

        ]));
        $expectedTree->getRoot()->getChildren()[0]->addChild(
            new TreeNode([
                "name" => "inferno",
                "width" => 800,
                "height" => 1000
            ]),
        );
        $expectedTree->getRoot()->getChildren()[0]->addChild(
            new TreeNode([
                "name" => "nuke",
                "width" => 1280,
                "height" => 1520
            ])
        );
        $expectedTree->getRoot()->addChild(new TreeNode([
            "name" => "mirage",
            "width" => 1080,
            "height" => 1920
        ]));

        $treeBuilder = new TreeBuilder();
        $treeBuilder->setChildrenField('children');
        $tree = $treeBuilder->convertArrayToTree($jsonData);
//        $this->assertEquals( $expectedTree,$tree);
        var_dump($tree->getRoot());
        function convert($size): string
        {
            $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
            return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
        }
        echo "\n";
        echo convert(memory_get_usage());

    }
}
