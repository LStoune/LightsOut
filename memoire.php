<?php

require_once "./Grille.php";

session_start();

$x = htmlspecialchars($_GET["X"]);
$y = htmlspecialchars($_GET["Y"]);
$nbCoup = $_SESSION["nbCoup"];


if (isset($_GET["mod"])) {
    $mod = htmlspecialchars($_GET["mod"]);
} else {
    $mod = $_SESSION["mod"];
}

if (isset($_GET["css"])) {
    $css = htmlspecialchars($_GET["css"]);
} else {
    $css = $_SESSION["css"];
}

if (isset($_GET["jeu"])) {
    $jeu = htmlspecialchars($_GET["jeu"]);
} else {
    $jeu = $_SESSION["jeu"];
}

if (!isset($_GET["En"])) {
    $anglais = $_SESSION["En"];
} else {
    $anglais = htmlspecialchars($_GET["En"]);
}

if (!isset($_GET["long"])) {

    $grille = $_SESSION["grille"];
} else {

    $_SESSION["long"] = htmlspecialchars($_GET["long"]);
    $_SESSION["larg"] = htmlspecialchars($_GET["larg"]);
    $grille = New Grille($_SESSION["long"], $_SESSION["larg"]);
    $nbCoup = 0;
}

if (isset($_GET["X"])) {
    if ($mod == 1) {
        $grille->Edit($x, $y);
    } else {
        if ($jeu == "Out") {
            $grille->Allumons($x, $y);
        } else {
            $grille->Tacoyaki($x, $y);
        }

        $nbCoup++;
    }
}

if ($anglais == 0) {
    header("Location: index.php");
} else {
    header("Location: indexEn.php");
}


$_SESSION["mod"] = $mod;
$_SESSION["grille"] = $grille;
$_SESSION["nbCoup"] = $nbCoup;
$_SESSION["En"] = $anglais;
$_SESSION["jeu"] = $jeu;
$_SESSION["css"] = $css;
