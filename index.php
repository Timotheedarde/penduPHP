<?php

require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

use App\Controller\Game as GameClass;

session_start();

if(isset($_GET["session"]))
{
    ReloadGame();
    return 0;
}

if(isset($_SESSION["MaPartie"]))
{
    $Partie = $_SESSION["MaPartie"];
    //TODO controle fin de partie
    if($Partie->__get('deadManScore')->__get("score") != 0)
    {
        if(isset($_POST["lettre"])){
            $letter = $_POST["lettre"];
            $Partie->play($letter);
        }
    $_SESSION["MaPartie"] = $Partie;
    }
    else{
        ReloadGame();
    }
}
else $_SESSION["MaPartie"]= new GameClass("ALOE", 2);

//Le jeu est fini, recommencer le jeu
function ReloadGame(){
    session_destroy();
}

//var_dump($_SESSION["MaPartie"]->getElements());
echo $twig->render('index.html.twig',$_SESSION["MaPartie"]->getElements());

