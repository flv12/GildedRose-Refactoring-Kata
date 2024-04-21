<?php

namespace GildedRose;

interface SpecificItemInterface
{
    public function supports(Item $item): bool;

    public function updateQualityForItem(Item $item): void;
}
