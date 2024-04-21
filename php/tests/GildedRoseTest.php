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

    public function testConjuredItems(): void
    {
        $items[] = new Item("Conjured Mana Cake", 3, 6);
        $this->gildedRose->setItems($items);
        $this->gildedRose->updateQuality();

        $this->assertEquals("Conjured Mana Cake", $this->gildedRose->getItems()[0]->name);
        $this->assertEquals(2, $this->gildedRose->getItems()[0]->sellIn);
        $this->assertEquals(5, $this->gildedRose->getItems()[0]->quality);

        $this->gildedRose->updateQuality();
        $this->assertEquals(1, $this->gildedRose->getItems()[0]->sellIn);
        $this->assertEquals(4, $this->gildedRose->getItems()[0]->quality);

        $this->gildedRose->updateQuality();
        $this->assertEquals(0, $this->gildedRose->getItems()[0]->sellIn);
        $this->assertEquals(3, $this->gildedRose->getItems()[0]->quality);

        $this->gildedRose->updateQuality();
        $this->assertEquals(-1, $this->gildedRose->getItems()[0]->sellIn);
        $this->assertEquals(1, $this->gildedRose->getItems()[0]->quality);
    }
}
