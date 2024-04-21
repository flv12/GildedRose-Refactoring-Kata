<?php

declare(strict_types=1);

namespace GildedRose\Strategies;

use GildedRose\Item;
use GildedRose\SpecificItemInterface;

class ConjuredItemStrategy implements SpecificItemInterface
{
    public function supports(Item $item): bool
    {
        return str_contains($item->name, 'Conjured');
    }

    public function updateQualityForItem(Item $item): void
    {
        if ($item->quality > 0) {
            $item->quality--;;
        }

        $item->sellIn--;

        if ($item->sellIn < 0 && $item->quality > 0) {
            $item->quality--;
        }
    }
}
