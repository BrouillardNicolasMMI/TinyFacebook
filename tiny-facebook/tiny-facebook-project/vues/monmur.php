<?php

  if(!isset($_SESSION["id"])) {
        // On n est pas connecté, il faut retourner à la pgae de login
        header("Location:index.php?action=login");
    }

    // On veut affchier notre mur ou celui d'un de nos amis et pas faire n'importe quoi
    $ok = false;

    if(!isset($_GET["id"]) || $_GET["id"]==$_SESSION["id"]){
        $id = $_SESSION["id"];
        $ok = true; // On a le droit d afficher notre mur
    } else {
        $id = $_GET["id"];
        // Verifions si on est amis avec cette personne
        $sql = "SELECT * FROM friends WHERE isvalidate=1
                AND ((iduser=? AND idfriend=?) OR ((idfriend=? AND iduser=?)))";
        $q = $pdo->prepare($sql);
        $q->execute(array($_GET["id"],$_SESSION["id"]));
        $line = $q->fetch();
        var_dump($line);
        exit();
        // les deux ids à tester sont : $_GET["id"] et $_SESSION["id"]
        // A completer. Il faut récupérer une ligne, si il y en a pas ca veut dire que lon est pas ami avec cette personne
    }
    if($ok==false) {
        echo "Vous n êtes pas encore ami, vous ne pouvez voir son mur !!";       
    } else {
    // A completer
    // Requête de sélection des éléments dun mur
     $sql = "SELECT * FROM ecrit WHERE idAmi=? order by dateEcrit DESC";
     // le paramètre  est le $id
    }
if($ok==true) {
    
    //Fonction heure passé
    
function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'an',
        2592000 => 'mois',
        604800 => 'semaine',
        86400 => 'jour',
        3600 => 'heure',
        60 => 'minute',
        1 => 'secondes'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}
    
    
   
$sql = "SELECT * FROM user WHERE id=?";

// Etape 1  : preparation
$q = $pdo->prepare($sql);

// Etape 2 : execution : 2 paramètres dans la requêtes !!
$q->execute(array($_SESSION['id']));

// Etape 3 : ici le login est unique, donc on sait que l'on peut avoir zero ou une  seule ligne.
$me = $q->fetch();
   
// REQUETE Pour la liste des gens DEJA amis
$sql = "SELECT login FROM user u INNER JOIN friends f on f.idfriend = u.id WHERE f.iduser = ? AND f.isvalidate=1"; //Renvoie liste des nom AMIS de la personne connecté 
$q = $pdo->prepare($sql);
$q->execute(array($_SESSION["id"]));
    //inutile
    
    
    
    $sql = "SELECT id FROM user u INNER JOIN friends f on f.idfriend = u.id WHERE f.iduser = ? AND f.isvalidate=1"; //Renvoie liste des nom AMIS de la personne connecté 
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION["id"]));
    $line = $q->fetch();
   // var_dump($line); 
    //exit();
    
        $sql = "SELECT * FROM ecrit INNER JOIN friends f on f.iduser = ecrit.idAuteur WHERE f.iduser=? AND idAuteur=? AND f.isvalidate=1  order by dateEcrit DESC";  
        $qmain = $pdo->prepare($sql);
        $qmain->execute(array($_SESSION["id"],$_SESSION["id"]));
    
    
        if($me['avatar']==null){
        $me['avatar']="user404.png";
        }
        
    
    
?>



    <div class="dim" id="dim"></div>
    <div class="col-md-10">
        <fieldset>





            <h1 class="col-xs-12 col-sm-7 col-md-10">Mon Mur</h1>

            <div class='col-xs-12 col-sm-7 col-md-12' id='new_status'>
                <ul class='navbar-nav col-xs-12' id='post_header'>
                    <li><a href='#'><span class='glyphicon glyphicon-picture'></span>Ajoutez une Photos</a></li>
                </ul>
                <div class='col-xs-12' id='post_content'>
                    <img alt='profile picture' class='col-xs-1' src='uploads/<?php echo $me["avatar"]; ?>'>
                    <div class='textarea_wrap'>
                        <textarea class='col-xs-11' name="content" form="usrform" placeholder='Quoi de neuf ?'></textarea>

                    </div>
                </div>
                <div class='col-xs-12' id='post_footer'>
                    <ul class='navbar-nav col-xs-7'>

                    </ul>
                    <div class='col-xs-5'>

                        <form action="index.php?action=postapost" method="POST" id="usrform">

                            <input type='hidden' name='whopost' id='whopost' value="<?php echo $me['id'];?>" />
                            <button type="submit" class='btn btn-primary'>Postez</button>
                        </form>
                    </div>
                </div>
            </div>
        </fieldset>
        <?php 
    
    //grande boucle pour chaque post 
                 while($line = $qmain->fetch()){
                    //var_dump($line);
                     //exit();
                     
                     //heure des post
                     $heure=humanTiming(strtotime($line['dateEcrit']));
                     
                     
        //select du nom de la personne qui poste l'article
        $sql = "SELECT * FROM user WHERE id=? ";  
        $q = $pdo->prepare($sql);
        $q->execute(array($line['idAuteur']));
        $auteurnom = $q->fetch(); 
                     
        //Select des commentaire
        $sql = "SELECT * FROM commentaire c JOIN ecrit e ON e.id = c.idComment  WHERE idComment=? ";  
        $q2 = $pdo->prepare($sql);
        $q2->execute(array($line['id']));
                     
        //Compte les commentaire             
        $sql = "SELECT COUNT(*) FROM commentaire WHERE idComment = ?";  
        $q3 = $pdo->prepare($sql);
        $q3->execute(array($line['id']));
        $nbrcom=$q3->fetch();
                     
                     
                     if($nbrcom[0]==0){
                        $nbrcom[0]="Pas de commentaire";
                     }
                     if($auteurnom['avatar']==null){
        $auteurnom['avatar']="user404.png";
    }
                     if($line['idAuteur']==$me['id']){ 
                     $itsmypostdelete="<a href='#'><i class='glyphicon glyphicon-remove'></i></a>";
                     }else{
                          $itsmypostdelete="<p>Amis</p>";
                     }
                
echo"
            <div class='panel panel-default'>
            
                <div class='panel-body'>
                    <section class='post-heading'>
                        <div class='row'>
                            <div class='col-md-11'>
                                <div class='media'>
                                    <div class='media-left'>
                                        <a href='#'>
                                  <img class='media-object photo-profile' src='uploads/".$auteurnom['avatar']."' width='40' height='40' alt='...'>
                                </a>
                                    </div>
                                    <div class='media-body'>
                                        <a href='#' class='anchor-username'>
                                            <h4 class='media-heading'>".$auteurnom['login']."</h4>
                                        </a>
                                        <a href='#' class='anchor-time'>".$heure."</a>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-1'>
                                ".$itsmypostdelete."
                            </div>
                        </div>
                    </section>
                    <section class='post-body'>
                    <h3>
                       <br/>
                    </h3>
                        <p>".$line['contenu']."</p>
                    </section>
                    <section class='post-footer'>
                    <h5><br/></h5>
                        <hr>
                        <div class='post-footer-option container'>
                            <ul class='list-unstyled'>
                                <li><a href='#'><i class='glyphicon glyphicon-thumbs-up'></i> Like</a></li>
                                <li><a href='javascript:void(0)' id='affichercomment".$line['id']."' onClick='myFunction(".$line['id'].")' ><i class='glyphicon glyphicon-comment'></i> Commentaire (".$nbrcom[0].")</a></li>

                            </ul>
                        </div>
                       
                    </section>
                </div>
            </div>";



while($auteurnom=$q2->fetch()){
    //Pour chaque commentaire rechercher le nom 
        $sql = "SELECT * FROM user WHERE id=? ";  
        $q = $pdo->prepare($sql);
        $q->execute(array($auteurnom['idAuteur']));
        $auteurnomcom = $q->fetch(); 
    $heurecom=humanTiming(strtotime($auteurnom['datecom']));
    if($auteurnomcom['avatar']==null){
        $auteurnomcom['avatar']="user404.png";
    }
    echo"

            <div class='wraper' >
                <div class='commentsection".$line['id']."' >

                    <div class='box-comments'>
                        <div class='comment'><img src='uploads/".$auteurnomcom['avatar']."' alt='' />
                            <div class='content'>
                                <div class='media-body'>
                                    <a href='#' class='anchor-username'>
                                        <h4 class='media-heading'>".$auteurnomcom['login']."</h4>
                                    </a>
                                    <a href='#' class='anchor-time'>".$heurecom."</a>
                                </div>
                                <a href=''><i class='glyphicon glyphicon-thumbs-up like'></i></a>
                                <p>".$auteurnom['content']."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               
                
";
}
                //var_dump($line['id']);
                echo"
              
                <div class='box-new-comment'>
                    <img src='uploads/".$me['avatar']."' alt='' />
                    <div class='content'>
                          <form action='index.php?action=postacomment' method='POST' >
                        <div class='row'>

                            <input type='hidden' name='whichcomment' value='".$line['id']."' />
                            <textarea name='contents' placeholder='Ecrire un commentaire...'></textarea>
                        </div>
                        <div class='row'>
                        
                            <button type='submit' class='glyphicon glyphicon-pencil'></button>

                        </div>
                        </form>
                    </div>
               
                </div>
            ";
            
            
}
}//Fin de la grande boucle while qui retourne tout les article ME concernant et concernant mes amis
            
?>



        <div class="col-md-2">
            <p>Mes amis:</p>
            <ul id="friendlist">



                <?php
    
    
while ($result = $q->fetch()){ 
echo"
<form name='formdel' action='index.php?action=delfriendaction' method='POST'>
<li><a href='index.php?action=friendwall?".$result['login']."'>".$result['login']."</a>
    
<input type='hidden' name='friendname' id='friendname' value=".$result['login']." />
<button type='submit' class='btn btn-danger btn-sm' >Supprimer</button> 
</li>
        </form>
    
    

";}
$sql = "SELECT login FROM user u INNER JOIN friends f on f.idfriend = u.id WHERE f.idfriend = ? AND f.isvalidate IS NULL"; //Renvoie liste des nom AMIS de la personne connecté 
$q = $pdo->prepare($sql);
$q->execute(array($_SESSION["id"]));
while ($result = $q->fetch()){
$sql = "SELECT login FROM user u INNER JOIN friends f on f.iduser = u.id WHERE f.idfriend = ? AND f.isvalidate IS NULL"; //Renvoie liste des nom AMIS de la personne connecté 
$q = $pdo->prepare($sql);
$q->execute(array($_SESSION["id"]));
$res = $q->fetch();
echo"

<li><a href='index.php?action=friendwall?".$res['login']."'>".$res['login']."</a>

<form name='formaccept' action='index.php?action=acceptfriendaction' method='POST' style='display:inline'>
<input type='hidden' name='friendname' id='friendname' value=".$res['login']." />
<button type='submit' class='btn btn-success btn-sm' >Accepter</button> 
        </form>
        
        <form name='formrefuse' action='index.php?action=refusefriendaction' method='POST' style='display:inline'>
<input type='hidden' name='friendname' id='friendname' value=".$res['login']." />
<button type='submit' class='btn btn-danger btn-sm' >Refuser</button> 
        </form>
</li>
    
    

";
}
            
?>


            </ul>



        </div>
    </div>
