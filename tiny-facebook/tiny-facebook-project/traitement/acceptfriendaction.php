<?php

$friend = $_POST['friendname'];
$me = $_SESSION['id'];

$sql = "SELECT id FROM user WHERE login = ?";
//Renvoie liste des nom AMIS de la personne connecté 
$q = $pdo->prepare($sql);
$q->execute(array($friend));
$idfriend = $q->fetch();

//$sql = "SELECT idfriend FROM friends WHERE iduser = ? "; //Renvoie liste des nom AMIS de la personne connecté 


//$sql = "SELECT login FROM user u INNER JOIN friends f on f.idfriend = u.id WHERE f.iduser = ? AND f.isvalidate IS NULL"; 
$sql = "SELECT COUNT(*) FROM friends WHERE idfriend = ? AND iduser = ? AND isvalidate IS NULL"; 
$q = $pdo->prepare($sql);
$q->execute(array($idfriend['id'],$_SESSION["id"]));
$isfriend = $q->fetch();
    //var_dump($idfriend);
    //var_dump($friend);
//exit();
    if(intval($isfriend[0])>=1){
        
        header('Location: index.php?action=monprofile');
    }else{
        $sql = "UPDATE friends SET isvalidate='1' WHERE idfriend=?";
        $q = $pdo->prepare($sql); 
        $q->execute(array($me));
        
        $sql = "SELECT COUNT(*) FROM friends WHERE idfriend = ? AND iduser = ? AND isvalidate=0"; 
        $q = $pdo->prepare($sql);
        $q->execute(array($idfriend['id'],$_SESSION["id"]));
        $isfriend = $q->fetch();
    //var_dump($idfriend);
    //var_dump($friend);
//exit();
    if(intval($isfriend[0])>=1){
        $sql = "UPDATE friends SET isvalidate='1' WHERE idfriend=?";
        $q = $pdo->prepare($sql); 
        $q->execute(array($me));
         header('Location: index.php?action=monprofile');
    }else{
        $sql = "INSERT into friends (iduser, idfriend, isvalidate) values (?, ?, 1);";
        $q = $pdo->prepare($sql); 
        $q->execute(array($me,$idfriend['id']));
        header('Location: index.php?action=monprofile');        
    }
    }
