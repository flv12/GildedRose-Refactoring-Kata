<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Strategies\AgedBrieItemStrategy;
use GildedRose\Strategies\BackstagePassesItemStrategy;
use GildedRose\Strategies\ConjuredItemStrategy;
use GildedRose\Strategies\SulfurasItemStrategy;

final class GildedRose
{
    private array $items;
    private array $itemsStrategy;

    public function __construct()
    {
        $this->itemsStrategy = [
            new AgedBrieItemStrategy(),
            new BackstagePassesItemStrategy(),
            new SulfurasItemStrategy(),
            new ConjuredItemStrategy(),
        ];
    }

    /**
     * @param Item[] $items
     * @return void
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            foreach ($this->itemsStrategy as $strategy) {
                if ($strategy->supports($item)) {
                    $strategy->updateQualityForItem($item);
                    continue 2;
                }
            }

            // If no strategy for the item, use default one
            $this->defaultUpdateQualityForItem($item);
        }
    }

    private function defaultUpdateQualityForItem(Item $item): void
    {
        if ($item->quality > 0) {
            $item->quality -= 1;
        }

        $item->sellIn--;

        if ($item->sellIn < 0 && $item->quality > 0) {
            $item->quality--;
        }
    }
}
