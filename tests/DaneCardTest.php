<?php

use GuzzleHttp\Psr7\Response;
use Pokemon\Models\Ability;
use Pokemon\Models\Attack;
use Pokemon\Models\Card;
use Pokemon\Models\CardImages;
use Pokemon\Models\CardMarket;
use Pokemon\Models\CardMarketPrices;
use Pokemon\Models\Legalities;
use Pokemon\Models\Pagination;
use Pokemon\Models\Prices;
use Pokemon\Models\PriceTiers;
use Pokemon\Models\Set;
use Pokemon\Models\SetImages;
use Pokemon\Models\TCGPlayer;
use Pokemon\Models\Weakness;
use Pokemon\Pokemon;

/**
 * DaneCardTest
 * 
 * An extension of the CardTest class, created by Dane Rainbird (hello@danerainbird.me)
 * Tests the WHERE function with AND and OR
 */
class DaneCardTest extends TestCase
{

    /**
     * @return string
     */
    protected function fixtureDirectory(): string
    {
        return 'cards';
    }

    /**
     * Run before tests
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test WHERE functionality with AND
     */
    public function testWhereWithAnd(): void {
        Pokemon::Options(['verify' => false]);

        $cards = Pokemon::Card()->where(['types' => ['AND', 'grass', 'lightning']])->all();

        $this->assertNotEmpty($cards);
        $this->assertContainsOnlyInstancesOf(Card::class, $cards);
        $this->assertCount(1, $cards);
    }

    /**
     * Test WHERE functionality with OR
     */
    public function testWhereWithOr(): void {
        Pokemon::Options(['verify' => false]);

        $cards = Pokemon::Card()->where(['types' => ['OR', 'grass', 'lightning']])->all();

        $this->assertNotEmpty($cards);
        $this->assertContainsOnlyInstancesOf(Card::class, $cards);
        
        foreach ($cards as $card) {
            $this->assertTrue(in_array('Grass', $card->getTypes()) || in_array('Lightning', $card->getTypes()));
        }
    }

    /**
     * Test WHERE functionality with an OR and a 'regular' query chained on 
     */
    public function testWhereWithOrChained(): void {
        Pokemon::Options(['verify' => false]);

        $cards = Pokemon::Card()->where(['types' => ['OR', 'grass', 'lightning'], 'rarity' => 'vmax'])->all();

        $this->assertNotEmpty($cards);
        $this->assertContainsOnlyInstancesOf(Card::class, $cards);
        
        foreach ($cards as $card) {
            $this->assertTrue(in_array('Grass', $card->getTypes()) || in_array('Lightning', $card->getTypes()));
            $this->assertStringContainsString('VMAX', $card->getRarity());
        }
    }
}