<?php
 if(!isset($_SESSION["id"])) {
        // On n est pas connecté, il faut retourner à la pgae de login
        header("Location:index.php?action=login");
    }

$content = $_POST['contents'];
$idcomment = $_POST['whichcomment'];
var_dump($content);
var_dump($idcomment);
$me = $_SESSION['id'];


        $sql = "INSERT into commentaire (idAuteur,idComment,content,datecom) values
        (?,?,?,CURRENT_TIMESTAMP)";
        $q = $pdo->prepare($sql); 
        $q->execute(array($me,$idcomment,$content));
        header('Location: index.php?action=monmur');
