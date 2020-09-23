<?php

namespace Tests\Unit;

use App\Services\NestedService;
use PHPUnit\Framework\TestCase;

class NestedServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testEmpty()
    {
        $nested = [];
        $expected = [];

        $flat = NestedService::flatten($nested);

        $this->assertEquals($expected, $flat);
    }

    public function testOneItem()
    {
        $nested = [['id' => 100, 'name' => 'i1']];
        $expected = [self::makeItem(100, 'i1', 0)];
        $flat = NestedService::flatten($nested);

        $this->assertEquals($expected, $flat);
    }

    public function testTwoItems()
    {
        $nested = [['id' => 100, 'name' => 'i1'], ['id' => 101, 'name' => 'i2']];
        $expected = [
            self::makeItem(100, 'i1', 0),
            self::makeItem(101, 'i2', 1),
        ];
        $flat = NestedService::flatten($nested);

        $this->assertEquals($expected, $flat);
    }

    public function testManyItems()
    {
        $nested = [
            ['id' => 100, 'name' => 'i1'],
            ['id' => 101, 'name' => 'i2'],
            ['id' => 102, 'name' => 'i3'],
            ['id' => 103, 'name' => 'i4'],
        ];
        $expected = [
            self::makeItem(100, 'i1', 0),
            self::makeItem(101, 'i2', 1),
            self::makeItem(102, 'i3', 2),
            self::makeItem(103, 'i4', 3),
        ];
        $flat = NestedService::flatten($nested);

        $this->assertEquals($expected, $flat);
    }

    public function testOneNestedItemOneLevel()
    {
        $nested = [
            ['id' => 100, 'name' => 'i1', 'children' => [
                ['id' => 101, 'name' => 'i1_1']
            ]],
        ];
        $expected = [
            self::makeItem(100, 'i1', 0),
            self::makeItem(101, 'i1_1', 0, 100),
        ];
        $flat = NestedService::flatten($nested);
        
        $this->assertEquals($expected, $flat);
    }

    public function testManyNestedItemsOneLevel()
    {
        $nested = [
            ['id' => 100, 'name' => 'i1', 'children' => [
                ['id' => 101, 'name' => 'i1_1'],
                ['id' => 102, 'name' => 'i1_2']
            ]],
            ['id' => 200, 'name' => 'i2', 'children' => [
                ['id' => 201, 'name' => 'i2_1'],
                ['id' => 202, 'name' => 'i2_2']
            ]],
        ];
        $expected = [
            self::makeItem(100, 'i1', 0),
            self::makeItem(101, 'i1_1', 0, 100),
            self::makeItem(102, 'i1_2', 1, 100),
            self::makeItem(200, 'i2', 1),
            self::makeItem(201, 'i2_1', 0, 200),
            self::makeItem(202, 'i2_2', 1, 200),
        ];
        $flat = NestedService::flatten($nested);
        
        $this->assertEquals($expected, $flat);
    }

    public function testOneNestedItemManyLevels()
    {
        $nested = [
            ['id' => 100, 'name' => 'i1', 'children' => [
                ['id' => 101, 'name' => 'i1_1', 'children' => [
                    ['id' => 102, 'name' => 'i1_2', 'children' => [
                        ['id' => 103, 'name' => 'i1_3']
                    ]]
                ]],
            ]],
        ];
        $expected = [
            self::makeItem(100, 'i1', 0),
            self::makeItem(101, 'i1_1', 0, 100),
            self::makeItem(102, 'i1_2', 0, 101),
            self::makeItem(103, 'i1_3', 0, 102),
        ];
        $flat = NestedService::flatten($nested);
        
        $this->assertEquals($expected, $flat);
    }

    public function testManyNestedItemsManyLevels()
    {
        $nested = [
            ['id' => 100, 'name' => 'i1', 'children' => [
                ['id' => 101, 'name' => 'i1_1', 'children' => [
                    ['id' => 102, 'name' => 'i1_2', 'children' => [
                        ['id' => 103, 'name' => 'i1_3'],
                        ['id' => 104, 'name' => 'i1_4'],
                        ['id' => 105, 'name' => 'i1_5'],
                    ]],
                    ['id' => 106, 'name' => 'i1_6', 'children' => [
                        ['id' => 107, 'name' => 'i1_7'],
                        ['id' => 108, 'name' => 'i1_8'],
                    ]],
                ]],
                ['id' => 109, 'name' => 'i1_9', 'children' => [
                    ['id' => 110, 'name' => 'i1_10']
                ]],
            ]],
            ['id' => 200, 'name' => 'i2', 'children' => [
                ['id' => 201, 'name' => 'i2_1', 'children' => [
                    ['id' => 202, 'name' => 'i2_2', 'children' => [
                        ['id' => 203, 'name' => 'i2_3'],
                        ['id' => 204, 'name' => 'i2_4'],
                        ['id' => 205, 'name' => 'i2_5'],
                    ]],
                    ['id' => 206, 'name' => 'i2_6', 'children' => [
                        ['id' => 207, 'name' => 'i2_7'],
                        ['id' => 208, 'name' => 'i2_8'],
                    ]],
                ]],
                ['id' => 209, 'name' => 'i2_9', 'children' => [
                    ['id' => 210, 'name' => 'i2_10']
                ]],
            ]],
        ];
        $expected = [
            self::makeItem(100, 'i1', 0),
            self::makeItem(101, 'i1_1', 0, 100),
            self::makeItem(102, 'i1_2', 0, 101),
            self::makeItem(103, 'i1_3', 0, 102),
            self::makeItem(104, 'i1_4', 1, 102),
            self::makeItem(105, 'i1_5', 2, 102),
            
            self::makeItem(106, 'i1_6', 1, 101),
            self::makeItem(107, 'i1_7', 0, 106),
            self::makeItem(108, 'i1_8', 1, 106),
            
            self::makeItem(109, 'i1_9', 1, 100),
            self::makeItem(110, 'i1_10', 0, 109),
            
            self::makeItem(200, 'i2', 1),
            self::makeItem(201, 'i2_1', 0, 200),
            self::makeItem(202, 'i2_2', 0, 201),
            self::makeItem(203, 'i2_3', 0, 202),
            self::makeItem(204, 'i2_4', 1, 202),
            self::makeItem(205, 'i2_5', 2, 202),
            
            self::makeItem(206, 'i2_6', 1, 201),
            self::makeItem(207, 'i2_7', 0, 206),
            self::makeItem(208, 'i2_8', 1, 206),
            
            self::makeItem(209, 'i2_9', 1, 200),
            self::makeItem(210, 'i2_10', 0, 209),


        ];
        $flat = NestedService::flatten($nested);
        
        $this->assertEquals($expected, $flat);
    }

    private static function makeItem($id, $name, $position, $parentId = null)
    {
        return ['id' => $id, 'name' => $name, 'position' => $position, 'parent_id' => $parentId];
    }
}
