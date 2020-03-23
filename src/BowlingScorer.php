<?php


class BowlingScorer
{

    private int $score = 0;
    private bool $firstThrow = true;
    private int $frameScore = 0;
    private bool $spare = false;

    public function roll(int $roll)
    {
        if ($this->firstThrow) {
            if ($this->spare) {
                $this->spare = false;
                $this->addScore(10 + $roll);
            }
            $this->frameScore += $roll;
            $this->firstThrow = false;
        } else {
            if ($roll + $this->frameScore == 10) {
                $this->spare = true;
            } else {
                $this->addScore($roll + $this->frameScore);
            }
            $this->frameScore = 0;
            $this->firstThrow = true;
        }

    }

    private function addScore(int $frameScore) {
        $this->score += $frameScore;
    }

    public function getScore()
    {


        return $this->score;

    }
}