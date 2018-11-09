<?php
 if(!isset($_SESSION["id"])) {
        // On n est pas connecté, il faut retourner à la pgae de login
        header("Location:index.php?action=login");
    }

$content = $_POST['content'];
var_dump($_POST['content']);
$me = $_SESSION['id'];
var_dump($me);

        $sql = "INSERT into ecrit (contenu,dateEcrit,idAuteur) values
        (?,CURRENT_TIMESTAMP,?)";
        $q = $pdo->prepare($sql); 
        $q->execute(array($_POST['content'],$me));
        header('Location: index.php?action=monmur');
