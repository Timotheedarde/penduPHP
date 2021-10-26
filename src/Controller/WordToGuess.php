<?php

namespace App\Controller;

use App\Controller\Letter as letterClass;

class WordToGuess
{
    private $letters;
    private $isDone;

    function __construct($letters) {
        $this->letters = $letters;
        $this->isDone = false;
    }

    public function __get($property){

        if('letters' === $property) {
            return $this->letters;
        }
        if('isDone' === $property){
            return $this->isDone;
        }
    }

    public function __set($property,$value) {

        if('isDone' === $property) {
            $this->isDone = $value;
        }
    }


}