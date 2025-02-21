<?php

declare(strict_types=1);

namespace GildedRose\Strategies;

use GildedRose\Item;
use GildedRose\SpecificItemInterface;

class SulfurasItemStrategy implements SpecificItemInterface
{
    public function supports(Item $item): bool
    {
        return 'Sulfuras, Hand of Ragnaros' === $item->name;
    }

    public function updateQualityForItem(Item $item): void
    {
        // Do nothing
    }
}
