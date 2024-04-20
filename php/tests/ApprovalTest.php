<?php

declare(strict_types=1);

namespace Tests;

use ApprovalTests\{Approvals, CombinationApprovals};
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

/**
 * This unit test uses [Approvals](https://github.com/approvals/ApprovalTests.php).
 */
class ApprovalTest extends TestCase
{
    private GildedRose $gildedRose;

    public function __construct()
    {
        parent::__construct();
        $this->gildedRose = new GildedRose();
    }

    public function testFoo(): void
    {
        $items[] = new Item('foo', 0, 0);
        $this->gildedRose->setItems($items);
        $this->gildedRose->updateQuality();

        Approvals::verifyList($items);
    }

    public function testThirtyDays(): void
    {
        ob_start();

        $argv = ['', '30'];
        include(__DIR__ . '/../fixtures/texttest_fixture.php');

        $output = ob_get_clean();

        Approvals::verifyString($output);
    }

    public function testAllCombinations(): void
    {
        CombinationApprovals::verifyAllCombinations3(
            function (string $name, int $sellIn, int $quantity) {
                $items[] = new Item($name, $sellIn, $quantity);

                $gildedRose = new GildedRose();
                $gildedRose->setItems($items);
                $gildedRose->updateQuality();
                return $items[0];
            },
            ['+5 Dexterity Vest', 'Aged Brie', 'Elixir of the Mongoose', 'Sulfuras, Hand of Ragnaros', 'Backstage passes to a TAFKAL80ETC concert', 'Conjured Mana Cake'],
            range(-5, 15),
            range(45, 55)
        );
    }
}
