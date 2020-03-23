<?php

use PHPUnit\Framework\TestCase;

final class BowlingScorerTest extends TestCase
{
    private $bowlingScorer;

    protected function setUp(): void
    {
        $this->bowlingScorer = new BowlingScorer();
        parent::setUp();
    }

    public function testShouldBeAbleToScoreAndSeeScore(): void
    {
        ($this->bowlingScorer)->roll(0);
        $this->assertEquals(0, $this->bowlingScorer->getScore());
        ($this->bowlingScorer)->roll(4);
        $this->assertEquals(4, $this->bowlingScorer->getScore());
    }

    public function testPointsShouldBeTalliedAfterAFrame(): void
    {
        ($this->bowlingScorer)->roll(4);
        $this->assertEquals(0, $this->bowlingScorer->getScore());
        ($this->bowlingScorer)->roll(4);
        $this->assertEquals(8, $this->bowlingScorer->getScore());
    }

    public function testSpare(): void {
        ($this->bowlingScorer)->roll(4);
        ($this->bowlingScorer)->roll(6);
        $this->assertEquals(0, $this->bowlingScorer->getScore());
        ($this->bowlingScorer)->roll(5);
        $this->assertEquals(15, $this->bowlingScorer->getScore());
    }
    
    public function testFullZeroGame(): void {
        for ($i = 0; $i<20; $i++) {
            ($this->bowlingScorer)->roll(0);
        }
        $this->assertEquals(0, $this->bowlingScorer->getScore());
    }

    public function testFullRollsGame(): void {
        for ($i = 0; $i<20; $i++) {
            ($this->bowlingScorer)->roll(4);
        }
        $this->assertEquals(80, $this->bowlingScorer->getScore());
    }

    public function testFullSparesGame(): void {
        for ($i = 0; $i<21; $i++) {
            ($this->bowlingScorer)->roll(5);
        }
        $this->assertEquals(150, $this->bowlingScorer->getScore());
    }

    public function testAStrike(): void {
        ($this->bowlingScorer)->roll(10);
        $this->assertEquals(0, $this->bowlingScorer->getScore());
        ($this->bowlingScorer)->roll(3);
        $this->assertEquals(0, $this->bowlingScorer->getScore());
    }
}
