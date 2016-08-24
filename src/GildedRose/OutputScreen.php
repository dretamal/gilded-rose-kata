<?php
/**
 * Created by PhpStorm.
 * User: dretamal
 * Date: 8/24/16
 * Time: 4:35 PM
 */

namespace GildedRose;

class OutputScreen
{
    public static function output($items)
    {
        echo sprintf("%50s - %7s - %7s\n", "Name", "SellIn", "Quality");
        foreach ($items as $item) {
            echo sprintf("%50s - %7d - %7d\n", $item->name, $item->sellIn, $item->quality);
        }
    }
}