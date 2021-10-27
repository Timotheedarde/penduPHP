<?php

namespace App\Controller;

class WordToGuess
{
    private $letters;

    function __construct($letters) {
        $this->letters = $letters;
    }

    public function __get($property){

        if('letters' === $property) {
            return $this->letters;
        }
    }



}