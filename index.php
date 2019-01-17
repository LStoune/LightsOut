<?php
require_once "./Grille.php";
session_start();

if (!isset($_SESSION["jeu"])) {
    $jeu = "Out";
} else {
    $jeu = $_SESSION["jeu"];
}

if (!isset($_SESSION["css"])) {
    $css = "style";
} else {
    $css = $_SESSION["css"];
}

if (!isset($_SESSION["long"])) {
    $long = 4;
} else {
    $long = $_SESSION["long"];
}

if (!isset($_SESSION["long"])) {
    $larg = 4;
} else {
    $larg = $_SESSION["larg"];
}

if (!isset($_SESSION["En"])) {
    $anglais = 0;
} else {
    $anglais = $_SESSION["En"];
}

if (isset($_SESSION["mod"])) {
    $mod = $_SESSION["mod"];
} else {
    $mod = 0;
}

if (isset($_SESSION["nbCoup"])) {
    $nbCoup = $_SESSION["nbCoup"];
} else {
    $nbCoup = 0;
}

if (!isset($_SESSION["grille"])) {
    $grille = new Grille($long, $larg);
} else {
    $grille = $_SESSION["grille"];
}


$_SESSION["jeu"] = $jeu;
$_SESSION["css"] = $css;
$_SESSION["grille"] = $grille;
$_SESSION["mod"] = $mod;
$_SESSION["En"] = $anglais;
$_SESSION["long"] = $long;
$_SESSION["larg"] = $larg;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        $css = $_SESSION["css"];

        if ($css == "style") {
            echo "<title>Lights Out - Mark V</title>";
        } else {
            echo "<title>Tacoyaki - Mark V</title>";
        }
        echo "<link rel=\"stylesheet\" href=\"$css.css\" media=\"screen and (min-width : 600px)\"type=\"text/css\"/>\n\t\t";
        echo "<link rel=\"stylesheet\" href=\"$css" . "_small.css\" media=\"screen and (max-width : 599px)\" type=\"text/css\"/>\n";
        ?>
        <link rel="icon" href="image/favicon.png" />
    </head>

    <body>


        <div id="corp">


            <div class="parallax">

                <div class="parallax__layer para-header">
                    <div class="back" id="header">

                        <div class="chooser" id="nbcase"><p>Nombre de cases</p>
                            <div id="taille"><i>x<?php echo $long; ?></i></div>

                            <div class="nbcase">

                                <div id="videresp"></div>
                                <a href="./memoire.php?long=3&larg=3"><div class="chiffre">3x3</div></a>
                                <a href="./memoire.php?long=4&larg=4"><div class="chiffre">4x4</div></a>
                                <a href="./memoire.php?long=5&larg=5"><div class="chiffre">5x5</div></a>
                                <a href="./memoire.php?long=6&larg=6"><div class="chiffre">6x6</div></a>

                                <div id="choix">
                                    &nbsp;&nbsp;&nbsp;
                                    <form action="memoire.php">
                                        Long: <input type="number" name="long" style="width: 40px; margin-right: 15px;">
                                        Larg: <input type="number" name="larg" style="width: 40px;">
                                        <br>
                                        <br><button type="submit" value="ok">Valider</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <a href="./memoire.php?long=<?php echo $_SESSION["long"]; ?>&larg=<?php echo $_SESSION["larg"]; ?>">
                            <div class="chooser" id="new"><p>Jeu aléatoire</p></div>
                        </a>

                        <a href="./memoire.php?mod=<?php echo 1; ?>">
                            <div class="chooser" id="edit"><p>Editer grille</p></div>
                        </a>

                        <?php
                        if ($css == "style") {
                            echo "<a href=\"./memoire.php?css=styleTk&jeu=Tacoyaki\">
                            <div class=\"chooser\" id=\"tacoyaki\">Tacoyaki</div>
                        </a>";
                        } else {
                            echo "<a href=\"./memoire.php?css=style&jeu=Out\">
                            <div class=\"chooser\" id=\"lightsOut\">Lights Out</div>
                        </a>";
                        }
                        ?>

                        <div id="bregles"><p>Règles</p>
                            <?php
                            if($css == "style"){
                                echo "<div class=\"regles\"><p>Bienvenue dans Lights Out !</p><br>
                                Le but de ce jeu est d'éteindre toutes les lumières.<br>
                                <br>
                                En cliquant sur une lumière, vous changez l'état des 4 autres alentours.<br>
                                <br>
                                Bonne chance !<br>
                                <br>
                                <img src=\"image/reglesLo.gif\" alt=\"Bonne Chance\" style=\"width: 80%;\"/>
                            </div>";
                            }else{
                                echo "<div class=\"regles\"><p>Bienvenue dans Tacoyaki !</p><br>
                                Le but de ce jeu est d'assombrir la grille.<br>
                                <br>
                                En cliquant sur un palet, vous changez l'état des diagonales.<br>
                                <br>
                                Bonne chance !<br>
                                <br>
                                <img src=\"image/reglesTk.gif\" alt=\"Bonne Chance\" style=\"width: 80%;\"/>
                            </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>


                <div class="parallax__layer para-0">
                    <div class="back" id="para0"></div>
                </div>

                <div class="parallax__layer para-1">
                    <div class="back" id="para1"></div>
                </div>

                <div class="parallax__layer para-2">
                    <div class="back" id="para2"></div>
                </div>

                <div class="parallax__layer para-3">
                    <div class="back" id="para3"></div>
                </div>

                <div class="parallax__layer para-4">
                    <div class="back" id="para4"></div>
                </div>

                <div class="parallax__layer para-5">
                    <div class="back" id="para5"></div>
                </div>

                <div class="parallax__layer para-6">
                    <div class="back" id="para6"></div>
                </div>

                <div class="parallax__layer para-7">
                    <div class="back" id="para7"></div>
                </div>

                <div class="parallax__layer para-8">
                    <div class="back" id="para8"></div>
                </div>


                <div id="surgrille">
                    <div id="grille">
                        <?php
                        $grille = $_SESSION["grille"];

                        $grille->afficher(); // Afficher la grille 
                        $grille->Gagner($anglais);
                        echo "<div id=\"coup\">coup : " . $nbCoup;

                        if ($_SESSION["mod"] == 1) {
                            echo "<div id=\"boutton\"><a href=\"./memoire.php?mod=2\">
                                    <button type=\"submit\" style=\"\">
                                    Play</button>
                            </a></div>";
                        }
                        ?>
                    </div>
                </div>


                <div id="content">
                    <div id="projet">
                        <?php
                        if($css == "style"){
                            echo "<div class=\"txt\" id=\"html\"><img src=\"image/html.png\" alt=\"html\" style=\"top: 0px;\"/>
                            Le cahier des charges du développement web est basé sur trois grandes lignes :
                            design, interactions, implémentation.<br>
                            <br>
                            Le design fut tout à fait libre, la seule contrainte étant de pouvoir distinguer 
                            visuellement les deux états de jeu possible : lumière ou obscurité. <br>
                            C'est Kaël qui a réalisé l'implémentation HTML et CSS, il est donc derrière 
                            l'aspect du site qu'il a voulu perfectionner tout au long du projet : une 
                            ambition colossale !<br>
                            <br>
                            La page respecte le format HTML5 et contient uniquement HTML, CSS, et PHP.<br>
                            <br>
                            <h2><i>Entrez dans un monde de lumière.</i></h2>
                        </div>
                        <div class=\"txt\" id=\"jeu\"><img src=\"image/jeu.png\" alt=\"jeu\"/>
                            Le jeu a entièrement été codé en PHP. Différentes interactions étaient
                            nécessairement demandées, comme choisir la taille du plateau, en générer un
                            aléatoirement, afficher un message de félicitations lorsque le jeu est gagné,
                            etc...<br>
                            Par souci de créativité, d'autres interactions mineures ont été ajoutées de 
                            notre plein gré.<br>
                            <br>
                            Cette phase a été réalisée conjointement par les membres du groupe, Sixtyne 
                            ayant créé et affiché la grille et ses composants, Axel s’étant chargé de 
                            l’implémentation du jeu en lui-même, et Kaël ayant réfléchi à l'incorporation 
                            visuelle de celui-ci dans le site.
                        </div>
                        <div class=\"txt\" id=\"maths\"><img src=\"image/maths.png\" alt=\"maths\"/>
                            Une fois que le principe du jeu fut compris, il a fallu modéliser le problème 
                            sous forme mathématique, afin d’élaborer une stratégie puis un algorithme de 
                            résolution.<br>
                            <br>
                            En remarquant qu’on cherche ici à trouver une combinaison de cases qui amène le 
                            plateau dans une configuration particulière, nous avons utilisé des connaissances 
                            acquises en algèbre linéaire pour mettre le problème en équation et étudier 
                            ainsi l’existence et l’unicité des solutions.<br>
                            <br>
                            Les mathématiques ont donc fait le bonheur de Sixtyne qui a planché dessus 
                            pendant un moment !<br>
                            <br>
                            Même si la modélisation mathématique du jeu ne fut pas compliquée à trouver, 
                            notre professeur, Mme Saini, nous a aidé pour nous mettre sur la piste 
                            de la résolution.
                        </div>
                        <div class=\"txt\" id=\"code\"><img src=\"image/code.png\" alt=\"code\"/>
                            La modélisation mathématique ayant été faite, il a fallu implémenter le 
                            tout sous forme d’un solver en C. Axel en était responsable, et s'est bien 
                            creusé la tête pour sortir un beau programme à temps !<br>
                            <br>
                            Il a écrit les fonctions nécessaires à la modélisation du jeu et à sa 
                            résolution mathématique, sous certaines contraintes techniques. Le programme 
                            prend une grille en entrée, et donne la liste des interrupteurs sur lesquels 
                            appuyer pour gagner la partie. Par ailleurs, un codage spécifique des 
                            grilles a été défini afin de faciliter l’utilisation du programme en relation 
                            avec la version web interactive du jeu.<br>
                            <br>
                            Cette phase s'appuie principalement sur la compréhension mathématique du 
                            problème.
                        </div>";
                        }else{
                        echo "<div class=\"txt\" id=\"tck\"><img src=\"image/Tck.png\" alt=\"code\"/>
                            La dernière partie du projet nous a fait réfléchir à une variante du Lights
                            Out, le Tacoyaki ! Il a fallu alors transformer la fonction régissant les
                            changements d'état des palets, car cette fois-ci ce sont les diagonales à
                            partir du palet cliqué qui changent d'état.<br>
                            <br>
                            Le site a été transformé aussi. Une astucieuse implémentation permet
                            de changer de jeu en un seul bouton, et une variable suplémentaire permet
                            de faire correspondre le CSS pour chaque jeu.
                            </div>";
                        }
                        ?>
                        
                    </div>
                    <div id="team">
                        <div class="lien">
                            <a href="#descsixtyne" class="perso" id="sixtyne"></a>
                            <a href="#descaxel" class="perso" id="axel"></a>
                            <a href="#desckael" class="perso" id="kael"></a>
                            <a href="#descprof" class="perso" id="prof"></a>

                            <div id="descsixtyne" class="desc"> Sixtyne est la mathématicienne du 
                                groupe. Elle maitrise les chiffres mieux que quiconque et trouve sans 
                                problème les résultats des équations les plus complexes !<br>
                                Si nous pouvons comprendre le fonctionnement du jeu et le résoudre sans 
                                peine, c'est bien grâce à elle.<br>
                                <br>
                                Elle a aussi participé, avec son point de vue mathématique, à 
                                l'écriture des codes <b>PHP</b> et <b>C</b>, permettant ainsi la 
                                compréhension du jeu en langage machine.
                                <a href="#ferme" class="ferme"></a>
                            </div>
                            <div id="descaxel" class="desc"> Axel aime résoudre les problématiques 
                                qui lui sont proposées d’un point de vue informatique. Dans ce projet 
                                il s'est attelé à l’implémentation du jeu en lui-même, ainsi qu’ à sa 
                                résolution, et a ainsi créé un code qui permet d'analyser et résoudre, 
                                de la façon la plus rapide, le jeu proposé.<br>
                                <br>
                                La création d'un programme proposant la solution est le point final 
                                de ce projet.
                                <br>
                                <a href="#ferme" class="ferme"></a>
                            </div>
                            <div id="desckael" class="desc"> Kaël, passionné de réalisations assistées 
                                par ordinateur, s'occupe quant à lui de la réalisation visuelle du 
                                projet, c’est-à-dire en grande partie des codes <b>HTML</b> et 
                                <b>CSS</b> du site.<br>
                                <br>
                                Il aime donner une dimension accessible visuellement au jeu et son 
                                support.
                                <a href="#ferme" class="ferme"></a>
                            </div>
                            <div id="descprof" class="desc"> M. Thomas a été notre chef de projet 
                                principal. Il nous a donné une problématique résolvable en quatre 
                                phases 
                                (décrites 
                                <?php
                                if ($css == "style") {
                                    echo "<a href=\"#content\" style=\"color: #a5a4ff\">ci-dessus</a>";
                                } else {
                                    echo "<a href=\"#content\" style=\"color: #ffc166\">ci-dessus</a>";
                                }
                                ?>
                                ).<br>
                                <br>
                                Il a supervisé nos travaux et nous a bien aidé quand nous en avions 
                                eu besoin.
                                <a href="#ferme" class="ferme"></a>
                            </div>
                        </div>
                        <p>
                            Rejoignez-nous sur les réseaux sociaux   
                        </p>
                        <a href="https://www.facebook.com/" target="blank"><div class="logo" id="facebook"></div></a>
                        <a href="https://twitter.com/?lang=fr" target="blank"><div class="logo" id="twitter"></div></a>
                        <a href="https://www.youtube.com/" target="blank"><div class="logo" id="youtube"></div></a>
                        <a href="https://fr.pinterest.com/" target="blank"><div class="logo" id="pinterest"></div></a>
                    </div>

                    <footer>
                        <i>Français</i> | <a href="./memoire.php?En=<?php echo 1; ?>">Anglais</a>
                    </footer>
                    <a href="index.php"><div id="up"></div></a>
                </div>
            </div>  
        </div>
    </body>
</html>