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

                        <div class="chooser" id="nbcase"><p>Grid size</p>
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
                                        Height: <input type="number" name="long" style="width: 40px; margin-right: 15px;">
                                        Width: <input type="number" name="larg" style="width: 40px;">
                                        <br>
                                        <br><button type="submit" value="ok">Ok</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <a href="./memoire.php?long=<?php echo $_SESSION["long"]; ?>&larg=<?php echo $_SESSION["larg"]; ?>">
                            <div class="chooser" id="new"><p>Random grid</p></div>
                        </a>

                        <a href="./memoire.php?mod=<?php echo 1; ?>">
                            <div class="chooser" id="edit"><p>Edit grid</p></div>
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

                        <div id="bregles"><p>Rules</p>
                            <?php
                            if ($css == "style") {
                            echo "<div class=\"regles\"><p>Welcome to Lights Out !</p><br>
                                The aim of the game is to switch off all the lights.<br>
                            <br>
                            By clicking on a light, you change the state of the others 4 around.<br>
                            <br>
                            Good luck !<br>
                            <br>
                                <img src=\"image/reglesLo.gif\" alt=\"Bonne Chance\" style=\"width: 80%;\"/>
                            </div>";
                            } else {
                            echo "<div class=\"regles\"><p>Welcome to Tacoyaki !</p><br>
                                The aim of the game is to turn all the discs to black.<br>
                                <br>
                                By clicking on a disc, you change the state of its diagonals and its
                                own state.<br>
                                <br>
                                Good luck !<br>
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
                        echo "<div id=\"coup\">move : " . $nbCoup;

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
                        if ($css == "style") {
                        echo "<div class=\"txt\" id=\"html\"><img src=\"image/html.png\" alt=\"html\" style=\"top: 0px;\"/>
                            The specifications of the web development is based on three main parts : design, 
                            interactions, implementation.<br>
                            <br>
                            The design was completely free, the only obligation we had was to be able to see 
                            the difference between the two states of the game : light or darkness.<br>
                            It's Kael who realised the HTML and CSS implementation, he's behind the whole 
                            aspect of the website ; he wanted it to be perfect so he worked on it all project 
                            long !<br>
                            <br>
                            The web page respects the HTML5 format and includes HTML, CSS, and PHP only.<br>
                            <br>
                            <h2><i>Enter a whole world of lights.</i></h2>
                        </div>
                        <div class=\"txt\" id=\"jeu\"><img src=\"image/jeu.png\" alt=\"jeu\"/>
                            The game was entirely coded in PHP. Different interactions were necesseraly asked,
                            like being able to chose the size of the grid, to generate a random one, to post 
                            a victory message when the player wins...<br>
                            We decided to add minor interactions, as we wanted to do something creative and 
                            adjustable.<br>
                            <br>
                            This stage was realised jointly by each member of the team : Sixtyne made and 
                            posted the grid and its composants, Axel did the implementation of the game itself, 
                            and Kaël thought about the visual incorporation of the game in the website.
                        </div>
                        <div class=\"txt\" id=\"maths\"><img src=\"image/maths.png\" alt=\"maths\"/>
                            Once we understood how the game works, we had to establish a mathematical model 
                            for the problem in order to elaborate a strategy and then an algorithm of 
                            resolution.<br>
                            <br>
                            By noticing that we want to find a combination which leads the grid in a particular 
                            configuration, we used our knowledge in linear algebra in order to transform the 
                            problem into an equation and so study the existence and uniqueness of the solutions.<br>
                            <br>
                            Mathematics made Sixtyne happiness, who worked on it quite a long time !<br>
                            <br>
                            Even if establishing a mathematical model of the game wasn’t that hard to find, our 
                            teacher, Mrs Saini, put us on the right track of to find the solution.
                        </div>
                        <div class=\"txt\" id=\"code\"><img src=\"image/code.png\" alt=\"code\"/>
                            After having establish a mathematical model, we had to implement everything in the 
                            form of a solver in C language. Axel was the one in charge, and he had to turn 
                            things over in his head in order to release a good-looking program in time !<br>
                            <br>
                            He wrote all the essential fonctions required for the establishment of the game’s
                            model and its mathematical resolution, under some technical constraints. The program 
                            takes a grid in input, and gives the list of the switches on which we have to click
                            to win the game. Moreover, a specific coding of the grid was defined in order to 
                            facilitate the use of the program in connection with the game’s interactive web 
                            version.<br>
                            <br>
                            This stage relies mainly on the mathematical understanding of the problem.
                        </div>";
                        }else{
                        echo "<div class=\"txt\" id=\"tck\"><img src=\"image/Tck.png\" alt=\"code\"/>
                            The last part of the project made us think about a variety of Lights Out : the 
                            Tacoyaki game. We had to transform the function governing the changing state of 
                            the discs (the algorithm of the game itself), as this time the diagonals change 
                            their state.<br>
                            <br>
                            The website was transformed as well. An ingenious implementation allows the 
                            user to switch games with a single button, and an extra variable links the CSS 
                            code to its game.
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

                            <div id="descsixtyne" class="desc"> Sixtyne is the mathematician (and 
                                traductor !) of the team. She masters the numbers like no other and 
                                is able to find the solutions of the most complex equations !<br>
                                If we’re able to understand how the game works and resolve it 
                                effortlessly, it’s because of her.<br>
                                <br>
                                She also took part, with her mathematical point of view, in the 
                                writing of the PHP code and C language, so that the game can be 
                                understood in machine language.
                                <a href="#ferme" class="ferme"></a>
                            </div>
                            <div id="descaxel" class="desc"> Axel loves to resolve the issues 
                                proposed with his computer skills. During this project, he worked 
                                on the implementation of the game itself and its solver, and so he 
                                created a code which analyzes and resolves whichever game the 
                                faster way.<br>
                                <br>
                                The creation of a program which gives the solution is the final 
                                point of our project.
                                <a href="#ferme" class="ferme"></a>
                            </div>
                            <div id="desckael" class="desc"> Kaël, passionate of computer-aided 
                                realizations, took charge of the project’s virtual realization, in 
                                other words, he did the HTML and CSS implementation for the website.<br>
                                <br>
                                He likes to give a visually reachable dimension of the game and 
                                its media.
                                <a href="#ferme" class="ferme"></a>
                            </div>
                            <div id="descprof" class="desc"> Mr Thomas is our pincipal project leader.
                                He gave us a resolvable issue in four stages (as described
                                <?php
                                if ($css == "style") {
                                    echo "<a href=\"#content\" style=\"color: #a5a4ff\">above</a>";
                                } else {
                                    echo "<a href=\"#content\" style=\"color: #ffc166\">above</a>";
                                }
                                ?>).<br>
                                <br>
                                He supervised our works and helped us when needed.
                                <a href="#ferme" class="ferme"></a>
                            </div>
                        </div>
                        <p>
                            Follow us !   
                        </p>
                        <a href="https://www.facebook.com/" target="blank"><div class="logo" id="facebook"></div></a>
                        <a href="https://twitter.com/?lang=fr" target="blank"><div class="logo" id="twitter"></div></a>
                        <a href="https://www.youtube.com/" target="blank"><div class="logo" id="youtube"></div></a>
                        <a href="https://fr.pinterest.com/" target="blank"><div class="logo" id="pinterest"></div></a>
                    </div>

                    <footer>
                        <a href="./memoire.php?En=<?php echo 0; ?>">French</a> | <i>English</i>
                    </footer>
                    <a href="index.php"><div id="up"></div></a>
                </div>
            </div>  
        </div>
    </body>
</html>