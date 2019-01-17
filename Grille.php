<?php

require_once "./Lumiere.php";

class Grille {

    private $grille;
    private $long;
    private $larg;

    // Constructeur d'une grille
    function __construct($long, $larg) {
        $this->long = $long ;
        $this->larg = $larg ;
        for ($i = 0; $i < $larg; $i++) {
            for ($j = 0; $j < $long; $j++) {
                $this->grille[$i][$j] = new Lumiere((bool) rand(0, 1), $i, $j);
            }
        }
    }

    // Affichage d'une grille faisant appel à l'affichage des lumières qui la composent
    function afficher() {
        for ($i = 0; $i < $this->larg; $i++) {
            echo "<br>";
            for ($j = 0; $j < $this->long; $j++) {
                $this->grille[$i][$j]->afficher();
            }  //Rajouter un retour à la ligne en html au bon endroit
        }
    }

    function Allumons($x, $y) { // J'ai échangé X et Y car j'ai inversé les deux à un moment.
        $this->grille[$x][$y]->changeEtat(); // le point où on appuie change toujours d'état
  
        if ($x > 0) {
            $this->grille[$x-1][$y]->changeEtat();
        }
        if ($x < $this->larg - 1) {
            $this->grille[$x+1][$y]->changeEtat();
        }

        if ($y > 0) {
            $this->grille[$x][$y-1]->changeEtat();
        }
        if ($y < $this->long - 1) {
            $this->grille[$x][$y+1]->changeEtat();
        }
    }
    
    function Tacoyaki($x, $y) {
        $i = $x;
        $j = $y;
        while( $j >= 0 && $i>= 0){
            $this->grille[$i][$j]->changeEtat();
            $i--;
            $j--;
        }
        $i1 = $x-1;
        $j1 = $y+1;
        while( $j1 < $this->long && $i1 >= 0){
            $this->grille[$i1][$j1]->changeEtat();
            $i1--;
            $j1++;
        }
        $i2 = $x+1;
        $j2 = $y+1;
        while( $j2 < $this->long && $i2 < $this->long){
            $this->grille[$i2][$j2]->changeEtat();
            $i2++;
            $j2++;
        }
        $i3 = $x+1;
        $j3 = $y-1;
        while( $j3 >= 0 && $i3 < $this->long){
            $this->grille[$i3][$j3]->changeEtat();
            $i3++;
            $j3--;
        }
    }

    function Gagner($anglais) {
        for ($i = 0; $i < $this->larg; $i++) {
            for ($j = 0; $j < $this->long; $j++) {
                if ($this->grille[$i][$j]->getEtat() == true) {
                    return; // arrête si tout n'est pas éteinds
                }
            }
        }
        if($anglais == 0){
            echo "<div id=\"gagne\">GAGNÉ</div>";
        }else{
            echo "<div id=\"gagne\">WIN</div>";
        }
        echo "<div id=\"feu\"></div>"; // feu d'artifice
    }

    function Edit($x, $y) {
        $this->grille[$x][$y]->changeEtat(); //Seul le point où on appuie change d'état
    }
}