<?php

namespace GildedRose\Tests;

use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{


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
}

