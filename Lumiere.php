<?php

class Lumiere {
    
    private $etat;
    private $posx;
    private $posy;

    // Accesseur en lecture de la propriété "éteint" ou "allumé"
    function getEtat() {
        return $this->etat;
    }
    
    // Constructeur d'une lumiere
    function __construct($allume, $posX, $posY) {  
        $this->etat = $allume;  //$allume est 0 ou 1 en parametre de new Lumiere dans Grille.php, donc on recupere l'état que l'on passe dans $etat
        $this->posx = $posX;
        $this->posy = $posY;
        
    }

    // Affichage d'une lumiere
    function afficher() {
        if($this->etat == false){
            echo "<a href=\"memoire.php?X=".$this->posx."&Y=".$this->posy."\"><span class =\"cell off \"></span></a>";  //Eteint
        }
        else {
            echo "<a href=\"memoire.php?X=".$this->posx."&Y=".$this->posy."\"><span class =\"cell on \"></span></a>";             
        }
    }
    
    /*Y=<?php echo \$posY; ?> posX=<?php echo \$posX; ?>*/
    
    function changeEtat(){
        $this->etat = !$this->etat;
        return;
    }
}