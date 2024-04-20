<?php

namespace Tests;

use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function test__construct()
    {
        $item = new Item('foo', 0, 0);
        $this->assertInstanceOf(Item::class, $item);
    }

    public function test__toString()
    {
        $item = new Item('foo', 0, 0);
        $this->assertSame('foo, 0, 0', $item->__toString());

        $item = new Item('bar', 1, 1);
        $this->assertSame('bar, 1, 1', $item->__toString());
    }
}
