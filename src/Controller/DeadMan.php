<?php

namespace App\Controller;


class DeadMan
{
    private $score;

    function __construct($score) {
        $this->score = $score;
    }

    public function __get($property) {

        if('score' === $property) {
            return $this->score;
        }
    }

    public function __set($property,$value) {

        if('score' === $property) {
            $this->score = $value;
        }
    }

    public function decrementScore(){
        $this->__set('score',$this->__get('score') - 1);
    }
}

