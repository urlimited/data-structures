<?php

namespace CodeBaseTeam\DataStructures\Tree\Tests\TreeBuilder;

use CodeBaseTeam\DataStructures\Tree\Exceptions\InvalidDataException;
use CodeBaseTeam\DataStructures\Tree\TreeBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @description Covers the following scenarios: \
 *      1. When input array is a list of items
 *      2. When input is malformed array, when children is not a list
 *      3. When input array is an object (not a list)
 *      4. Convert huge array (2 MB) (todo)
 */
class FromArrayTest extends TestCase
{
    public function testValidObjectInput()
    {
        // 1. Initiation step
        $data = file_get_contents(__DIR__ . '/../stubs/smallInput.json');

        $jsonData = json_decode($data, true);

        // 2. Scenario run step
        TreeBuilder::setChildrenField('children');

        $tree = TreeBuilder::fromArray($jsonData);

        // 3. Assertion step
        $expectedResult = '{"value":{"qwe_1":"some value 1","qwe_2":"some value 2"},"parent":null,"children":[{"value":{"players":{"name":"Bentlee","rank":"global"}},"parent":null,"children":[{"value":{"name":"Synergistic analyzing support","width":1658,"height":164},"parent":null,"children":[{"value":{"name":"Re-engineered multi-state help-desk","width":663,"height":1317},"parent":null,"children":[]}]}]}]}';

        $this->assertEquals($expectedResult, $tree->toJson());
    }

    public function testInvalidFormattedChildren()
    {
        $this->expectException(InvalidDataException::class);

        // 1. Initiation step
        $data = file_get_contents(__DIR__ . '/../stubs/incorrectObjectInput.json');

        $jsonData = json_decode($data, true);

        // 2. Scenario run step
        TreeBuilder::setChildrenField('children');

        TreeBuilder::fromArray($jsonData);
    }

    public function testValidListInput()
    {
        // 1. Initiation step
        $data = file_get_contents(__DIR__ . '/../stubs/listInput.json');

        $jsonData = json_decode($data, true);

        // 2. Scenario run step
        TreeBuilder::setChildrenField('children');

        $tree = TreeBuilder::fromArray($jsonData);

        // 3. Assertion step
        $expectedResult = '{"value":[[{"children":[{"players":{"name":"Bentlee","rank":"global"},"children":{"name":"Synergistic analyzing support","width":1658,"height":164,"children":{"name":"Re-engineered multi-state help-desk","width":663,"height":1317}}},{"players":{"name":"Abdel","rank":"global"},"children":{"name":"Seamless homogeneous encryption","width":1617,"height":1357,"children":{"name":"Total empowering circuit","width":104,"height":1171}}}]}]],"parent":null,"children":[]}';

        $this->assertEquals($expectedResult, $tree->toJson());
    }
}
