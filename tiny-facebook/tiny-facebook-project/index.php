<?php

include("config/config.php");
include("config/bd.php"); // Ajout de la base de donnee
include("divers/balises.php");
include("config/actions.php");
include("config/fonctionhelper.php");
session_start();
ob_start(); // Je démarre le buffer de sortie : les données à afficher sont stockées


?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tiny Facebook</title>

        <!-- Bootstrap core CSS -->
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="./css/style.css" rel="stylesheet">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
      
-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/app.js"></script>

        <?php if(!isset($_SESSION['id'])){
    echo"<link href='./css/connect.css' rel='stylesheet'>";}
?>

        <!-- Ma feuille de style à moi -->

    </head>

    <body>

        <header>


            <?php 
    if (isset($_SESSION['id'])) {
     echo "<h5>Bonjour " . $_SESSION['login']."</h5>";
        
            
    }else{
        echo"
           <div class='stage'>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
                <div class='layer'></div>
            </div>
        ";
        
    }
    ?>
        </header>
        <?php  if(!isset($_SESSION['id'])){ 
 include'./vues/login.php';} ?>






        <div class="container">
            <?php
if (isset($_SESSION['info'])) {
    echo "<div class='alert alert-info alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button>
        <strong>Information : </strong> " . $_SESSION['info'] . "</div>";
    unset($_SESSION['info']);
}
?>




                <?php 
              if(isset($_SESSION['id'])){
                  echo"
                <div class='wrapper' onclick='myFunction(this)'>
                    <a href='javascript:void(0)' class='nav'>
                        <div class='one'></div>
                        <div class='two'></div>
                        <div class='three'></div>

                    </a>

                </div>";}
            
            ?>




                <nav>
                    <ul>
                        <div id='visible'>

                            <?php
        if (isset($_SESSION['id'])) {
            echo " <li><a class='btn btn-default btn-lg' href='index.php?action=monmur'>Mon mur</a></li>";
            echo " <li><a class='btn btn-default btn-lg' href='index.php?action=monprofile'>Mon Profil  </a></li>";
            echo " <li><a class='btn btn-danger btn-lg' href='index.php?action=deconnexion'>Deconnexion</a></li>";
        } else {
          
            
        }
        ?>

                        </div>
                    </ul>
                </nav>



                <!--<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">-->

                <?php
            function phpAlert($msg) {
            echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
            //Affiche les erreurs 
            if(isset($_SESSION["error"]) && $_SESSION["error"] !== 0){
               phpAlert($_SESSION["error"]);         unset($_SESSION["error"]); } 
            // Quelle est l'action à faire ?
            if (isset($_GET["action"])) {
                $action = $_GET["action"];
            } else {
                $action = "accueil";
            }

            // Est ce que cette action existe dans la liste des actions
            if (array_key_exists($action, $listeDesActions) == false) {
                include("vues/404.php"); // NON : page 404
            } else {
                include($listeDesActions[$action]); // Oui, on la charge
            }

            ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être
            ?>



        </div>
<?php include('./vues/footer.php')?>

    </body>

    </html>
