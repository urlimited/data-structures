<?php

namespace Tests;


use Queue\Classes\Queue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    public function testEnqueueAndDequeue()
    {
        $queue = new Queue();

        $queue->enqueue(10);
        $queue->enqueue(20);
        $queue->enqueue(30);

        $this->assertEquals(10, $queue->dequeue());
        $this->assertEquals(20, $queue->dequeue());
        $this->assertEquals(30, $queue->dequeue());
    }

    public function testPeek()
    {
        $queue = new Queue();

        $queue->enqueue(10);
        $queue->enqueue(20);

        $this->assertEquals(10, $queue->peek());

        $queue->dequeue();

        $this->assertEquals(20, $queue->peek());
    }

    public function testIsEmpty()
    {
        $queue = new Queue();

        $this->assertTrue($queue->isEmpty());

        $queue->enqueue(10);

        $this->assertFalse($queue->isEmpty());

        $queue->dequeue();

        $this->assertTrue($queue->isEmpty());
    }

    public function testSize()
    {
        $queue = new Queue();

        $this->assertEquals(0, $queue->size());

        $queue->enqueue(10);
        $queue->enqueue(20);
        $queue->enqueue(30);

        $this->assertEquals(3, $queue->size());

        $queue->dequeue();

        $this->assertEquals(2, $queue->size());
    }

    public function testClear()
    {
        $queue = new Queue();

        $queue->enqueue(10);
        $queue->enqueue(20);

        $queue->clear();

        $this->assertTrue($queue->isEmpty());
        $this->assertEquals(0, $queue->size());
    }
}