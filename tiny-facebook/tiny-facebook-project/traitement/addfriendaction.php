<?php

$friend = $_POST['friendname'];
$me = $_SESSION['id'];

$sql = "SELECT id FROM user WHERE login = ?";
//Renvoie liste des nom AMIS de la personne connecté 
$q = $pdo->prepare($sql);
$q->execute(array($friend));
$idfriend = $q->fetch();

    
$sql = "INSERT into friends (iduser, idfriend) values (?, ?);";
$q = $pdo->prepare($sql);
$q->execute(array($me,$idfriend['id']));

header('Location: index.php?action=monmur');
