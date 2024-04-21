<?php

declare(strict_types=1);

namespace GildedRose\Strategies;

use GildedRose\Item;
use GildedRose\SpecificItemInterface;

class AgedBrieItemStrategy implements SpecificItemInterface
{
    public function supports(Item $item): bool
    {
        return 'Aged Brie' === $item->name;
    }

    public function updateQualityForItem(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality++;
        }

        $item->sellIn--;

        if ($item->sellIn < 0 && $item->quality < 50) {
            $item->quality++;
        }
    }
}
