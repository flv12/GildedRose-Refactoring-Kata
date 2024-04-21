<?php

declare(strict_types=1);

namespace GildedRose;

class BackstagePassesItemStrategy implements SpecificItemInterface
{
    public function supports(Item $item): bool
    {
        //return false;
        return 'Backstage passes to a TAFKAL80ETC concert' === $item->name;
    }

    public function updateQualityForItem(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality++;

            if ($item->sellIn < 11) {
                if ($item->quality < 50) {
                    $item->quality++;
                }
            }

            if ($item->sellIn < 6) {
                if ($item->quality < 50) {
                    $item->quality++;
                }
            }
        }

        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality -= $item->quality;
        }
    }
}
