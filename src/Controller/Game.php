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
    private $deadManScore;
    private $invisibleWord;

    public function __construct($wordToGuess, $deadManScore) {
        $this->wordToGuess = $wordToGuess;
        $this->wordToGuessList = $this->createWordToGuess();
        $this->proposedLettersList = $this->createProposedLettersList();
        $this->deadManScore = $this->createDeadMan($deadManScore);
        $this->invisibleWord = $this->createInvisibleWord();
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

    public function party($letter){
        $wordToGuessList = $this->__get("wordToGuessList")->letters;
        if ($this->proposeLetter($letter)){
            foreach ($wordToGuessList as $key => $value){
                if ($value===$letter){
                    $this->invisibleWord[$key] = $value;
                }
            }
        }
        if (!in_array($letter,$wordToGuessList)){
            $this->deadManScore->decrementScore();
        }
    }

    public function proposeLetter($letter){
        if(!in_array($letter,$this->proposedLettersList->__get('letters')))
        {
            $this->proposedLettersList->addLetterToList($letter);
            return true;
        }
        return false;
    }

    public function createInvisibleWord(){
        return array_fill(0,count($this->wordToGuessList->__get('letters'))-1,"*");
    }

    public function getElements(){
        return array(
            "wordToGuess" => $this->wordToGuess,
            "hideWord" => $this->invisibleWord,
            "score"=>$this->deadManScore->__get("score"),
            "proposedLetters"=>$this->proposedLettersList->__get("letters")
        );
    }
}
