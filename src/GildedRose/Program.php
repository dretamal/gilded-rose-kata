<?php

namespace GildedRose;

/**
 * Hi and welcome to team Gilded Rose.
 *
 * As you know, we are a small inn with a prime location in a prominent city
 * ran by a friendly innkeeper named Allison. We also buy and sell only the
 * finest goods. Unfortunately, our goods are constantly degrading in quality
 * as they approach their sell by date. We have a system in place that updates
 * our inventory for us. It was developed by a no-nonsense type named Leeroy,
 * who has moved on to new adventures. Your task is to add the new feature to
 * our system so that we can begin selling a new category of items. First an
 * introduction to our system:
 *
 * - All items have a SellIn value which denotes the number of days we have to sell the item
 * - All items have a Quality value which denotes how valuable the item is
 * - At the end of each day our system lowers both values for every item
 *
 * Pretty simple, right? Well this is where it gets interesting:
 *
 * - Once the sell by date has passed, Quality degrades twice as fast
 * - The Quality of an item is never negative
 * - "Aged Brie" actually increases in Quality the older it gets
 * - The Quality of an item is never more than 50
 * - "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
 * - "Backstage passes", like aged brie, increases in Quality as it's SellIn
 *   value approaches; Quality increases by 2 when there are 10 days or less and
 *   by 3 when there are 5 days or less but Quality drops to 0 after the concert
 *
 * We have recently signed a supplier of conjured items. This requires an
 * update to our system:
 *
 * - "Conjured" items degrade in Quality twice as fast as normal items
 *
 * Feel free to make any changes to the UpdateQuality method and add any new
 * code as long as everything still works correctly. However, do not alter the
 * Item class or Items property as those belong to the goblin in the corner who
 * will insta-rage and one-shot you as he doesn't believe in shared code
 * ownership (you can make the UpdateQuality method and Items property static
 * if you like, we'll cover for you).
 *
 * Just for clarification, an item can never have its Quality increase above
 * 50, however "Sulfuras" is a legendary item and as such its Quality is 80 and
 * it never alters.
 */
class Program
{
    private $items = array();

    const AGED_BRIE = "Aged Brie";

    const BACKSTAGE = "Backstage passes to a TAFKAL80ETC concert";

    const SULFURAS = "Sulfuras, Hand of Ragnaros";

    const MAXIMUM_QUALITY = 50;

    const QUALITY_INCREMENT_BY_TWO_THRESHOLD_DAYS = 10;

    const QUALITY_INCREMENT_BY_THREE_THRESHOLD_DAYS = 5;

    public static function Main()
    {
        echo "HELLO\n";

        $app = new Program(array(
            new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20)),
            new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0)),
            new Item(array( 'name' => "Elixir of the Mongoose",'sellIn' => 5,'quality' => 7)),
            new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80)),
            new Item(array(
                'name' => "Backstage passes to a TAFKAL80ETC concert",
                'sellIn' => 15,
                'quality' => 20
            )),
            new Item(array('name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6)),
        ));

        $app->UpdateQuality();

        echo sprintf("%50s - %7s - %7s\n", "Name", "SellIn", "Quality");
        foreach ($app->items as $item) {
            echo sprintf("%50s - %7d - %7d\n", $item->name, $item->sellIn, $item->quality);
        }
    }

    public function __construct(array $items)
    {
        $this->items = $items;
    }


    public function UpdateQuality()
    {
        for ($i = 0; $i < count($this->items); $i++) {

            $currentItem = $this->items[$i];

            $this->processItemQuality($currentItem);
            $this->processItemSellIn($currentItem);

            if ($this->itemSellInBelowZero($currentItem)) {
                $this->updateQualityItemsByItemType($currentItem);
            }
        }
    }

    /**
     * @param $item
     * @return bool
     */
    private function isSulfurasItem($item)
    {
        return $item->name === self::SULFURAS;
    }

    /**
     * @param $item
     */
    private function decreaseItemQuality($item)
    {
        $item->quality = $item->quality - 1;
    }

    /**
     * @param $item
     */
    private function increaseItemQualityByOne($item)
    {
        $item->quality = $item->quality + 1;
    }

    /**
     * @param $item
     */
    private function decreaseItemSellIn($item)
    {
        $item->sellIn = $item->sellIn - 1;
    }

    /**
     * @param $item
     * @return bool
     */
    private function itemIsBelowMaximumQuality($item)
    {
        return $item->quality < self::MAXIMUM_QUALITY;
    }

    /**
     * @param $item
     * @return bool
     */
    private function itemHasPositiveQuality($item)
    {
        return $item->quality > 0;
    }

    /**
     * @param $item
     * @return bool
     */
    private function itemSellInBelowZero($item)
    {
        return $item->sellIn < 0;
    }

    /**
     * @param $currentItem
     */
    private function increaseBackstageQualityWithSpecialRules($currentItem)
    {
        if ($currentItem->sellIn <= self::QUALITY_INCREMENT_BY_TWO_THRESHOLD_DAYS) {
            $this->increaseItemQualityByOne($currentItem);
        }

        if ($currentItem->sellIn <= self::QUALITY_INCREMENT_BY_THREE_THRESHOLD_DAYS) {
            $this->increaseItemQualityByOne($currentItem);
        }
    }

    /**
     * @param $currentItem
     * @return bool
     */
    private function itemQualityCanBeDecreased($currentItem)
    {
        return $this->itemHasPositiveQuality($currentItem) &&
        $this->isSulfurasItem($currentItem) === false;
    }

    /**
     * @param $currentItem
     */
    private function updateQualityItemsByItemType($currentItem)
    {
        switch ($currentItem->name) {
            case "Aged Brie":
                if ($this->itemIsBelowMaximumQuality($currentItem)) {
                    $this->increaseItemQualityByOne($currentItem);
                }
                break;
            case 'Backstage passes to a TAFKAL80ETC concert':
                $currentItem->quality = $currentItem->quality - $currentItem->quality;
                break;
            default:
                if ($this->itemQualityCanBeDecreased($currentItem)) {
                    $this->decreaseItemQuality($currentItem);
                }
                break;
        }

    }

    /**
     * @param $currentItem
     */
    private function processItemQuality($currentItem)
    {
        switch ($currentItem->name) {
            case 'Aged Brie':
                if ($this->itemIsBelowMaximumQuality($currentItem)) {
                    $this->increaseItemQualityByOne($currentItem);
                }
                break;
            case 'Backstage passes to a TAFKAL80ETC concert':
                if ($this->itemIsBelowMaximumQuality($currentItem)) {
                    $this->increaseItemQualityByOne($currentItem);
                    $this->increaseBackstageQualityWithSpecialRules($currentItem);
                }
                break;
            default:
                if ($this->itemQualityCanBeDecreased($currentItem)) {
                    $this->decreaseItemQuality($currentItem);
                }
                break;
        }
    }

    /**
     * @param $currentItem
     */
    private function processItemSellIn($currentItem)
    {
        if ($this->isSulfurasItem($currentItem) === false) {
            $this->decreaseItemSellIn($currentItem);
        }
    }
}
