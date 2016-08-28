<?php
/**
 * Created by PhpStorm.
 * User: dretamal
 * Date: 8/21/16
 * Time: 7:34 PM
 */

namespace GildedRose;

class ItemManager
{

    private $items = array();

    const AGED_BRIE = "Aged Brie";

    const BACKSTAGE = "Backstage passes to a TAFKAL80ETC concert";

    const SULFURAS = "Sulfuras, Hand of Ragnaros";

    const MAXIMUM_QUALITY = 50;

    const QUALITY_INCREMENT_BY_TWO_THRESHOLD_DAYS = 10;

    const QUALITY_INCREMENT_BY_THREE_THRESHOLD_DAYS = 5;

    public function __construct($items = array())
    {
        $this->items = $items;
    }

    public function initItems()
    {
        $this->items = array(
            new Item(array('name' => "+5 Dexterity Vest", 'sellIn' => 10, 'quality' => 20)),
            new Item(array('name' => "Aged Brie", 'sellIn' => 2, 'quality' => 0)),
            new Item(array('name' => "Elixir of the Mongoose", 'sellIn' => 5, 'quality' => 7)),
            new Item(array('name' => "Sulfuras, Hand of Ragnaros", 'sellIn' => 0, 'quality' => 80)),
            new Item(array(
                'name' => "Backstage passes to a TAFKAL80ETC concert",
                'sellIn' => 15,
                'quality' => 20
            )),
            new Item(array('name' => "Conjured Mana Cake", 'sellIn' => 3, 'quality' => 6)),
        );
    }

    public function getItems()
    {
        return $this->items;
    }


    public function updateItemAttributes()
    {
        foreach ($this->items as $currentItem) {

            $this->processItemQuality($currentItem);
            $this->processItemSellIn($currentItem);
            $this->updateQualityItemsByItemType($currentItem);

        }
    }

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
    private function updateQualityItemsByItemType($currentItem) {

        if ($this->itemSellInBelowZero($currentItem)) {
            switch ($currentItem->name) {
                case self::AGED_BRIE:
                    if ($this->itemIsBelowMaximumQuality($currentItem)) {
                        $this->increaseItemQualityByOne($currentItem);
                    }
                    break;
                case self::BACKSTAGE:
                    $currentItem->quality = $currentItem->quality - $currentItem->quality;
                    break;
                default:
                    if ($this->itemQualityCanBeDecreased($currentItem)) {
                        $this->decreaseItemQuality($currentItem);
                    }
                    break;
            }
        }
    }

    /**
     * @param $currentItem
     */
    private function processItemQuality($currentItem)
    {
        switch ($currentItem->name) {
            case self::AGED_BRIE:
                if ($this->itemIsBelowMaximumQuality($currentItem)) {
                    $this->increaseItemQualityByOne($currentItem);
                }
                break;
            case self::BACKSTAGE:
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