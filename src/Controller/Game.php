<?php

namespace App\Controller;

use App\Controller\WordToGuess as WTGClass;
use App\Controller\ProposedLettersList as PLLClass;
use App\Controller\DeadMan as DMClass;

class Game
{
    private $wordToGuess;
    private $wordToGuessList;
    private $proposedLettersList;
    private $goodLetterList;
    private $badLetterList;
    private $deadManScore;

    public function __construct($wordToGuess, $deadManScore) {
        $this->wordToGuess = $wordToGuess;
        $this->wordToGuessList = $this->createWordToGuess();
        $this->proposedLettersList = $this->createProposedLettersList();
        $this->deadManScore = $this->createDeadMan($deadManScore);
        $this->goodLetterList = [];
        $this->badLetterList = [];
        //var_dump($this->wordToGuessList);
        //var_dump($this->proposedLettersList);
        //var_dump($this->deadManScore);
    }

    public function __get($property) {

        if('wordToGuess' === $property) {
            return $this->wordToGuess;
        }
        if('wordToGuessList' === $property) {
            return $this->wordToGuessList;
        }
        if('proposedLettersList' === $property) {
            return $this->proposedLettersList;
        }
        if('goodLetterList' === $property) {
            return $this->goodLetterList;
        }
        if('badLetterList' === $property) {
            return $this->badLetterList;
        }
        if('deadManScore' === $property) {
            return $this->badLetterList;
        }

    }



    public function stringToArray(){
        return str_split($this->__get('wordToGuess'));
    }

    public function createWordToGuess(){
        $letters = $this->stringToArray();
        return new WTGClass($letters);
    }

    public function createProposedLettersList(){
        return new PLLClass();
    }

    public function createDeadMan($score){
        return new DMClass($score);
    }

    public function browseWordList(){
        for($i = 0; $i < count($this->__get("wordToGuessList")->letters); $i++)
        {
            echo $this->__get("wordToGuessList")->letters[$i];
        }
    }

    public function letterIsInList(){
        $wordToGuessList = $this->__get("wordToGuessList")->letters;
        $proposedLettersList = $this->__get("proposedLettersList")->letters;
        //var_dump($wordToGuessList);
        //var_dump($proposedLettersList);
        foreach($wordToGuessList as $value)
        {
            if(!in_array(end($proposedLettersList), $this->goodLetterList)
                && !in_array(end($proposedLettersList), $this->badLetterList))
            {
                if($value === end($proposedLettersList))
                {
                    //"correspondance";
                    array_push($this->goodLetterList, end($proposedLettersList));
                }
                elseif($value != end($proposedLettersList))
                {
                    //"pas de correspondance";
                    array_push($this->badLetterList, end($proposedLettersList));
                    $this->deadManScore->decrementScore();
                }
            }
        }
    }

    public function proposeLetter($letter){
        $this->proposedLettersList->addLetterToList($letter);
    }

    public function showGoodList(){
        echo "goodListe : " ; var_dump($this->__get("goodLetterList"));
    }

    public function showBadList(){
        echo "badListe : " ; var_dump($this->__get("badLetterList"));
    }

    public function showDeadManscore(){
        $this->deadManScore->showScore();
    }

    public function

}
