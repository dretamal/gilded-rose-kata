<?php

namespace GildedRose\Tests;

use GildedRose\Program;
use GildedRose\Item;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    /* output stored after executing UpdateQuality 15 times on every Item */
    private $itemsData = array(
        "+5 Dexterity Vest" => array(
            "initialSellIn" => 10,
            "initialQuality" => 20,
            "outputValues" => array(
                1 => array(
                    'sellIn' => 9,
                    'quality' => 19
                ),
                2 => array(
                    'sellIn' => 8,
                    'quality' => 18
                ),
                5 => array(
                    'sellIn' => 5,
                    'quality' => 15
                ),
                9 => array(
                    'sellIn' =>  1,
                    'quality' => 11
                ),
                10 => array(
                    'sellIn' =>  0,
                    'quality' => 10
                ),
                12 => array(
                    'sellIn' => -2,
                    'quality' => 6
                ),
                15 => array(
                    'sellIn' => -5,
                    'quality' => 0
                )
            )
        ),
        "Elixir of the Mongoose" => array(
            "initialSellIn" => 5,
            "initialQuality" => 7,
            "outputValues" => array(
                1 => array(
                    'sellIn' => 4,
                    'quality' => 6
                ),
                2 => array(
                    'sellIn' => 3,
                    'quality' => 5
                ),
                3 => array(
                    'sellIn' => 2,
                    'quality' => 4
                ),
                4 => array(
                    'sellIn' => 1,
                    'quality' => 3
                ),
                5 => array(
                    'sellIn' => 0,
                    'quality' => 2
                ),
                6 => array(
                    'sellIn' => -1,
                    'quality' => 0
                ),
                7 => array(
                    'sellIn' => -2,
                    'quality' => 0
                ),
                8 => array(
                    'sellIn' => -3,
                    'quality' => 0
                ),
                9 => array(
                    'sellIn' => -4,
                    'quality' => 0
                ),
                10 => array(
                    'sellIn' => -5,
                    'quality' => 0
                ),
                11 => array(
                    'sellIn' => -6,
                    'quality' => 0
                ),
                12 => array(
                    'sellIn' => -7,
                    'quality' => 0
                ),
                13 => array(
                    'sellIn' => -8,
                    'quality' => 0
                ),
                14 => array(
                    'sellIn' => -9,
                    'quality' => 0
                ),
                15 => array(
                    'sellIn' => -10,
                    'quality' => 0
                )
            )
        ),
        "Aged Brie" => array(
            "initialSellIn" => 2,
            "initialQuality" => 0,
            "outputValues" => array(

                1 => array(
                    'sellIn' => 1,
                    'quality' => 1
                ),
                2 => array(
                    'sellIn' => 0,
                    'quality' => 2
                ),
                3 => array(
                    'sellIn' => -1,
                    'quality' => 4
                ),
                4 => array(
                    'sellIn' => -2,
                    'quality' => 6
                ),
                5 => array(
                    'sellIn' => -3,
                    'quality' => 8
                ),
                6 => array(
                    'sellIn' => -4,
                    'quality' => 10
                ),
                7 => array(
                    'sellIn' => -5,
                    'quality' => 12
                ),
                8 => array(
                    'sellIn' => -6,
                    'quality' => 14
                ),
                9 => array(
                    'sellIn' => -7,
                    'quality' => 16
                ),
                10 => array(
                    'sellIn' => -8,
                    'quality' => 18
                ),
                11 => array(
                    'sellIn' => -9,
                    'quality' => 20
                ),
                12 => array(
                    'sellIn' => -10,
                    'quality' => 22
                ),
                13 => array(
                    'sellIn' => -11,
                    'quality' => 24
                ),
                14 => array(
                    'sellIn' => -12,
                    'quality' => 26
                ),
                15 => array(
                    'sellIn' => -13,
                    'quality' => 28
                )
            )
        ),
        "Sulfuras, Hand of Ragnaros" => array(
            "initialSellIn" => 0,
            "initialQuality" => 80,
            "outputValues" => array(
                1 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                2 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                3 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                4 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                5 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                6 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                7 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                8 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                9 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                10 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                11 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                12 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                13 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                14 => array(
                    'sellIn' => 0,
                    'quality' => 80
                ),
                15 => array(
                    'sellIn' => 0,
                    'quality' => 80
                )
            )
        ),
        "Backstage passes to a TAFKAL80ETC concert" => array(
            "initialSellIn" => 15,
            "initialQuality" => 20,
            "outputValues" => array(
                1 => array(
                    'sellIn' => 14,
                    'quality' => 21
                ),
                2 => array(
                    'sellIn' => 13,
                    'quality' => 22
                ),
                3 => array(
                    'sellIn' => 12,
                    'quality' => 23
                ),
                4 => array(
                    'sellIn' => 11,
                    'quality' => 24
                ),
                5 => array(
                    'sellIn' => 10,
                    'quality' => 25
                ),
                6 => array(
                    'sellIn' => 9,
                    'quality' => 27
                ),
                7 => array(
                    'sellIn' => 8,
                    'quality' => 29
                ),
                8 => array(
                    'sellIn' => 7,
                    'quality' => 31
                ),
                9 => array(
                    'sellIn' => 6,
                    'quality' => 33
                ),
                10 => array(
                    'sellIn' => 5,
                    'quality' => 35
                ),
                11 => array(
                    'sellIn' => 4,
                    'quality' => 38
                ),
                12 => array(
                    'sellIn' => 3,
                    'quality' => 41
                ),
                13 => array(
                    'sellIn' => 2,
                    'quality' => 44
                ),
                14 => array(
                    'sellIn' => 1,
                    'quality' => 47
                ),
                15 => array(
                    'sellIn' => 0,
                    'quality' => 50
                ),
                16 => array(
                    'sellIn' => -1,
                    'quality' => 0
                ),
                17 => array(
                    'sellIn' => -2,
                    'quality' => 0
                ),
                18 => array(
                    'sellIn' => -3,
                    'quality' => 0
                ),
                19 => array(
                    'sellIn' => -4,
                    'quality' => 0
                ),
                20 => array(
                    'sellIn' => -5,
                    'quality' => 0
                ),
                21 => array(
                    'sellIn' => -6,
                    'quality' => 0
                ),
                22 => array(
                    'sellIn' => -7,
                    'quality' => 0
                ),
                23 => array(
                    'sellIn' => -8,
                    'quality' => 0
                ),
                24 => array(
                    'sellIn' => -9,
                    'quality' => 0
                ),
                25 => array(
                    'sellIn' => -10,
                    'quality' => 0
                )
            )

        ),
        "Conjured Mana Cake" => array(
            "initialSellIn" => 3,
            "initialQuality" => 6,
            "outputValues" => array(

                1 => array(
                    'sellIn' => 2,
                    'quality' => 5
                ),
                2 => array(
                    'sellIn' => 1,
                    'quality' => 4
                ),
                3 => array(
                    'sellIn' => 0,
                    'quality' => 3
                ),
                4 => array(
                    'sellIn' => -1,
                    'quality' => 1
                ),
                5 => array(
                    'sellIn' => -2,
                    'quality' => 0
                ),
                6 => array(
                    'sellIn' => -3,
                    'quality' => 0
                ),
                7 => array(
                    'sellIn' => -4,
                    'quality' => 0
                ),
                8 => array(
                    'sellIn' => -5,
                    'quality' => 0
                ),
                9 => array(
                    'sellIn' => -6,
                    'quality' => 0
                ),
                10 => array(
                    'sellIn' => -7,
                    'quality' => 0
                ),
                11 => array(
                    'sellIn' => -8,
                    'quality' => 0
                ),
                12 => array(
                    'sellIn' => -9,
                    'quality' => 0
                ),
                13 => array(
                    'sellIn' => -10,
                    'quality' => 0
                ),
                14 => array(
                    'sellIn' => -11,
                    'quality' => 0
                ),
                15 => array(
                    'sellIn' => -12,
                    'quality' => 0
                )
            )
        )
    );

    public function testIntegration()
    {
        ob_start();
        Program::main();
        $output = ob_get_contents();
        ob_end_clean();
        $this->assertEquals($this->getMainOutput(), $output);
    }
    private function getMainOutput()
    {
        return "HELLO
                                              Name -  SellIn - Quality
                                 +5 Dexterity Vest -       9 -      19
                                         Aged Brie -       1 -       1
                            Elixir of the Mongoose -       4 -       6
                        Sulfuras, Hand of Ragnaros -       0 -      80
         Backstage passes to a TAFKAL80ETC concert -      14 -      21
                                Conjured Mana Cake -       2 -       5\n";
    }
    public function testUpdateQualityItems()
    {
        foreach ($this->itemsData as $itemName => $itemData) {

            $items = $this->initializeOneItem($itemName, $itemData['initialSellIn'], $itemData['initialQuality']);
            $program = new Program($items);

            $lastDayProcessed = null;

            foreach ($itemData['outputValues'] as $day => $itemAttributes) {
                if (empty($lastDayProcessed)) {
                    $daysToUpdate = $day;
                } else {
                    $daysToUpdate = $day - $lastDayProcessed;
                }
                $this->updateItemQualityNDays($program, $daysToUpdate);
                $itemExpected = $this->buildItemFromParams($itemName, $itemAttributes['sellIn'], $itemAttributes['quality']);
                $this->ownAssertItemExpected($itemExpected, $program);
                $lastDayProcessed = $day;
            }
        }
    }

    private function updateItemQualityNDays(Program $program, $days = 1)
    {
        for ($i=1; $i<=$days; $i++){
            $program->updateQuality();
        }
    }

    private function buildItemFromParams($name, $sellIn, $quality)
    {
        return new Item(array('name' => $name, 'sellIn' => $sellIn, 'quality' => $quality));
    }

    /**
     * @param $itemExpected
     * @param $program
     */
    private function ownAssertItemExpected($itemExpected, $program)
    {
        $this->assertAttributeEquals(
            array($itemExpected),
            'items',
            $program
        );
    }

    /**
     * @param $itemName
     * @param $initialSellIn
     * @param $initialQuality
     * @return array
     */
    private function initializeOneItem($itemName, $initialSellIn, $initialQuality)
    {
        $item = new Item(
            array(
                'name' => $itemName,
                'sellIn' => $initialSellIn,
                'quality' => $initialQuality
            )
        );
        $items = array($item);
        return $items;
    }

    /**
     * just for info purposes
     */
    public function testViewOutput()
    {
        $itemName = "Backstage passes to a TAFKAL80ETC concert";
        $items = $this->initializeOneItem($itemName, $initialSellIn = 15, $initialQuality = 20);
        $program = new Program($items);
        $days = 25;

        for($i=1;$i<=$days;$i++){
            $program->UpdateQuality();
            $items = $program->getItems();
            $item = $items[0];

            echo "\n".$i . " => array(\n";
            echo "\t'sellIn' => " . $item->sellIn . ", \n\t'quality' => " . $item->quality . "\n),";
        }

    }
}