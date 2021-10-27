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
    destroySession();
    return 0;
}

if(isset($_SESSION["MaPartie"]))
{
    $Partie = $_SESSION["MaPartie"];
    if(isset($_POST["lettre"])){
        $letter = $_POST["lettre"];
        $Partie->party($letter);
        //controle fin de partie
        $_SESSION["MaPartie"] = $Partie;
    }
}
else $_SESSION["MaPartie"]= new GameClass("ALOE", 10);

//Le jeu est fini, recommencer le jeu
function destroySession(){
    session_destroy();
}

//var_dump($_SESSION["MaPartie"]->getElements());
echo $twig->render('index.html.twig',$_SESSION["MaPartie"]->getElements());

