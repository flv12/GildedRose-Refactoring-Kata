<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    private GildedRose $gildedRose;

    public function __construct()
    {
        parent::__construct();
        $this->gildedRose = new GildedRose();
    }

    public function testGetItems(): void
    {
        $items[] = new Item('foo', 0, 0);
        $this->gildedRose->setItems($items);

        $this->assertCount(1, $this->gildedRose->getItems());
    }

    public function testFoo(): void
    {
        $items[] = new Item('foo', 0, 0);
        $this->gildedRose->setItems($items);
        $this->gildedRose->updateQuality();

        $this->assertSame('foo', $this->gildedRose->getItems()[0]->name);
    }
}
