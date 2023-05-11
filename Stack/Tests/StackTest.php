<?php

namespace Stack\Tests;

use PHPUnit\Framework\TestCase;
use Stack\Classes\Stack;

class StackTest extends TestCase
{
    public function testPushAndPop()
    {
        $stack = new Stack();

        $stack->push('Apple');
        $stack->push('Banana');
        $stack->push('Cherry');

        $this->assertEquals(3, $stack->size());
        $this->assertFalse($stack->isEmpty());
        $this->assertEquals('Cherry', $stack->peek());

        $item = $stack->pop();
        $this->assertEquals('Cherry', $item);
        $this->assertEquals(2, $stack->size());
        $this->assertEquals('Banana', $stack->peek());

        $stack->pop();
        $stack->pop();

        $this->assertTrue($stack->isEmpty());
    }

    public function testClear()
    {
        $stack = new Stack();

        $stack->push('Apple');
        $stack->push('Banana');
        $stack->push('Cherry');

        $stack->clear();

        $this->assertTrue($stack->isEmpty());
        $this->assertEquals(0, $stack->size());
    }
}