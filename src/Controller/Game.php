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
    private $invisibleWordList;

    public function __construct($wordToGuess, $deadManScore) {
        $this->wordToGuess = $wordToGuess;
        $this->wordToGuessList = $this->createWordToGuess();
        $this->proposedLettersList = $this->createProposedLettersList();
        $this->deadManScore = $this->createDeadMan($deadManScore);
        $this->invisibleWordList = $this->createInvisibleWord();
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
            return $this->deadManScore;
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

    public function play($letter){
        $wordToGuessList = $this->__get("wordToGuessList")->letters;
        if ($this->proposeLetter($letter)){
            foreach ($wordToGuessList as $key => $value){
                if ($value===$letter){
                    $this->invisibleWordList[$key] = $value;
                }
            }
            if (!in_array($letter,$wordToGuessList)){
                $this->deadManScore->decrementScore();
            }
        }

        //var_dump("proposedLettersList",$this->proposedLettersList );
        //var_dump("invisibleWordlist",$this->invisibleWordList);
        //var_dump("string",$this->invisibleWord);
        //echo "Score = " . $this->deadManScore->__get("score");
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
        return array_fill(0,count($this->wordToGuessList->__get('letters')),"*");
    }


    public function getElements(){
        return array(
            "wordToGuess" => $this->wordToGuess,
            "hideWord" => implode($this->invisibleWordList),
            "score"=>$this->deadManScore->__get("score"),
            "proposedLetters"=>$this->proposedLettersList->__get("letters")
        );
    }
}
