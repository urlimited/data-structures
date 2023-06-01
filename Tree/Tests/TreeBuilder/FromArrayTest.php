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
        TreeBuilder::setValueContentFieldKey(null);
        TreeBuilder::setMetaFieldKeys([]);
        TreeBuilder::setChildrenFieldKey(null);

        $tree = TreeBuilder::fromArray($jsonData);

        // 3. Assertion step
        $expectedResult = '{"value":[],"meta":[],"key":null,"children":[{"value":[],"meta":[],"key":"qwe_3","children":[{"value":[],"meta":[],"key":"players","children":[]},{"value":[],"meta":[],"key":"prop_1","children":[{"value":[],"meta":[],"key":"prop_2","children":[]}]}]}]}';

        $this->assertEquals($expectedResult, $tree->toJson());
    }

    public function testValidObjectWithContentAndMetaFieldsInput()
    {
        // 1. Initiation step
        $data = file_get_contents(__DIR__ . '/../stubs/smallInputWithMetaAndContent.json');

        $jsonData = json_decode($data, true);

        // 2. Scenario run step
        TreeBuilder::setValueContentFieldKey('content');
        TreeBuilder::setMetaFieldKeys(['meta_field', 'meta']);
        TreeBuilder::setChildrenFieldKey(null);

        $tree = TreeBuilder::fromArray($jsonData);

        // 3. Assertion step
        $expectedResult = '{"value":[],"meta":{"order":1,"id":1,"meta_field":{"content":"some-meta-field","meta":{"order":3,"id":4}}},"key":null,"children":[{"value":"some value 1","meta":{"order":1,"id":2},"key":"qwe_1","children":[]},{"value":"some value 2","meta":{"order":2,"id":3},"key":"qwe_2","children":[]},{"value":[],"meta":{"order":4,"id":5},"key":"qwe_3","children":[{"value":[],"meta":{"order":1,"id":6},"key":"players","children":[{"value":"Bentlee","meta":{"order":1},"key":"name","children":[]},{"value":"global","meta":{"order":1,"id":24},"key":"rank","children":[]}]}]}]}';

        $this->assertEquals($expectedResult, $tree->toJson());
    }

    public function testValidObjectWithChildrenFieldInput()
    {
        // 1. Initiation step
        $data = file_get_contents(__DIR__ . '/../stubs/smallInputWithChildren.json');

        $jsonData = json_decode($data, true);

        // 2. Scenario run step
        TreeBuilder::setValueContentFieldKey(null);
        TreeBuilder::setMetaFieldKeys([]);
        TreeBuilder::setChildrenFieldKey('children');

        $tree = TreeBuilder::fromArray($jsonData);

        // 3. Assertion step
        $expectedResult = '{"value":{"qwe_1":"some value 1","qwe_2":"some value 2"},"meta":[],"key":null,"children":[{"value":{"players":{"name":"Bentlee","rank":"global"}},"meta":[],"key":null,"children":[{"value":{"name":"Synergistic analyzing support","width":1658,"height":164},"meta":[],"key":null,"children":[{"value":{"name":"Re-engineered multi-state help-desk","width":663,"height":1317},"meta":[],"key":null,"children":[]}]}]}]}';

        $this->assertEquals($expectedResult, $tree->toJson());
    }

    public function testInvalidFormattedChildren()
    {
        $this->expectException(InvalidDataException::class);

        // 1. Initiation step
        $data = file_get_contents(__DIR__ . '/../stubs/incorrectObjectInput.json');

        $jsonData = json_decode($data, true);

        // 2. Scenario run step
        TreeBuilder::setValueContentFieldKey(null);
        TreeBuilder::setMetaFieldKeys([]);
        TreeBuilder::setChildrenFieldKey('children');

        TreeBuilder::fromArray($jsonData);
    }

    public function testValidListInput()
    {
        // 1. Initiation step
        $data = file_get_contents(__DIR__ . '/../stubs/listInput.json');

        $jsonData = json_decode($data, true);

        // 2. Scenario run step
        TreeBuilder::setValueContentFieldKey(null);
        TreeBuilder::setMetaFieldKeys([]);
        TreeBuilder::setChildrenFieldKey('children');

        $tree = TreeBuilder::fromArray($jsonData);

        // 3. Assertion step
        $expectedResult = '{"value":[[{"children":[{"players":{"name":"Bentlee","rank":"global"},"children":{"name":"Synergistic analyzing support","width":1658,"height":164,"children":{"name":"Re-engineered multi-state help-desk","width":663,"height":1317}}},{"players":{"name":"Abdel","rank":"global"},"children":{"name":"Seamless homogeneous encryption","width":1617,"height":1357,"children":{"name":"Total empowering circuit","width":104,"height":1171}}}]}]],"meta":[],"key":null,"children":[]}';

        $this->assertEquals($expectedResult, $tree->toJson());
    }
}
