<?php

namespace App\Controller;

use App\Controller\DeadMan as DeadManClass;

class ProposedLettersList
{
    private $letters;

    function __construct() {
        $this->letters = [];
    }

    public function __get($property) {

        if('letters' === $property) {
            return $this->letters;
        }
    }


    public function __set($property,$value) {

        if('letters' === $property) {
            $this->letters = $value;
        }

    }

    public function addLetterToList($letterAdd){

        $list = $this->__get('letters');
        array_push($list, $letterAdd);
        $this->__set('letters', $list);

    }
}