<?php

use App\Controller\Game as GameClass;

require __DIR__ . "/vendor/autoload.php";

$Jeu1 = new GameClass("ALOE", 10);
$Jeu1->proposeLetter("A");
$Jeu1->letterIsInList();
$Jeu1->proposeLetter("B");
$Jeu1->letterIsInList();
$Jeu1->proposeLetter("D");
$Jeu1->letterIsInList();
//$Jeu1->showGoodList();
//$Jeu1->showBadList();
$Jeu1->showDeadManscore();



//echo $Jeu1 ->__get("wordToGuess");
//var_dump($Jeu1->wordToArray());

//$Lettre1 = new LetterClass("E");
//echo $Lettre1->__get('value');
