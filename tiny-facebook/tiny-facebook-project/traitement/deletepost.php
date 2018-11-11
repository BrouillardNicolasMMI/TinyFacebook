<?php
if(!isset($_SESSION["id"])) {
        // On n est pas connecté, il faut retourner à la pgae de login
        header("Location:index.php?action=login");
    }
$idpostdelete =$_POST['idpostdelete'];
$me=$_SESSION['id'];

$sql="SELECT * FROM ecrit WHERE idAuteurPost=? AND id=?";
$q=$pdo->prepare($sql);
$q->execute(array($me,$idpostdelete));

$mypost=$q->fetch();
if($mypost!==null){
    if($mypost['image']!=null){
        //var_dump($mypost['image']);
        //exit();
        //suppression d'eventuelle image dans le post
        $myFile = "uploads/".$mypost['image'];
        unlink($myFile) or die("Impossible de supprimer le fichier ".$myFile);
    }
    //suppression des commentaires
    $sql="DELETE FROM commentaire WHERE idComment=?";
    $q= $pdo->prepare($sql);
    $q->execute(array($idpostdelete));
    //var_dump($idpostdelete);
    //exit();
    
    //supression du post
    $sql="DELETE FROM ecrit WHERE idAuteurPost=? AND id=?";
    $q= $pdo->prepare($sql);
    $q->execute(array($me,$idpostdelete));
    //var_dump($idpostdelete);
    //exit();
    header("Location:index.php?action=monmur");
}else{
    header("Location:index.php?action=monmur");
}


