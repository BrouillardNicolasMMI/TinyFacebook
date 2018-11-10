<?php

$sql = "SELECT * FROM user WHERE login=? AND mdp=PASSWORD(?)";

// Etape 1  : preparation
$q = $pdo->prepare($sql);

// Etape 2 : execution : 2 paramètres dans la requêtes !!
$q->execute(array($_POST['login'],$_POST['mdp']));

// Etape 3 : ici le login est unique, donc on sait que l'on peut avoir zero ou une  seule ligne.
$line = $q->fetch();
if($line == true){
    $_SESSION['id'] = $line['id'];
    $_SESSION['login'] = $line['login'];
   
    header('Location: index.php?action=monmur');
    
}else{
    $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorect.";
    exit();
    header('Location: index.php');
}
// un seul fetch


// Si $line est faux le couple login mdp est mauvais, on retourne au formulaire

// sinon on crée les variables de session $_SESSION['id'] et $_SESSION['login'] et on va à la page d'accueil
