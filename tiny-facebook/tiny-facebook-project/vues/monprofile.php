<?php
  if(!isset($_SESSION["id"])) {
        // On n est pas connecté, il faut retourner à la pgae de login
        header("Location:index.php?action=login");
    }

?>
    <div class="container">
        <div class="dim" id="dim"></div>
        <div class="col-md-6">
            <fieldset>
                <legend>
                    <h1>Mon Profil</h1>
                </legend>

                <?php
$sql = "SELECT * FROM user WHERE id=?";

// Etape 1  : preparation
$q = $pdo->prepare($sql);

// Etape 2 : execution : 2 paramètres dans la requêtes !!
$q->execute(array($_SESSION['id']));

// Etape 3 : ici le login est unique, donc on sait que l'on peut avoir zero ou une  seule ligne.
$line = $q->fetch();
   
// REQUETE Pour la liste des gens DEJA amis
$sql = "SELECT login FROM user u INNER JOIN friends f on f.idfriend = u.id WHERE f.iduser = ? AND f.isvalidate=1"; //Renvoie liste des nom AMIS de la personne connecté 
$q = $pdo->prepare($sql);
$q->execute(array($_SESSION["id"]));
         
            
            
?>


                    <div class="image-upload">

                        <label for="file-input"><?php
                   if($line['avatar'] != null){
    echo ("<img id='imgpp' src='uploads/".$line['avatar']."'/>");
}else{
    echo ("<p>Vous n'avez pas de photo pour l'instant</p>");
}

?>
                    <div class="overlay">
                <p id="modifyprofilepic">Modifier</p>

                </div>
                        </label>
                    </div>
            </fieldset>

            <form enctype="multipart/form-data" role="form" action="index.php?action=upload" method="POST">

                <input type="file" name="fileToUpload" id="file-input" />
                <input type="submit" name="sub" id="submit" class="btn btn-success btn-lg" value="Envoyer" />
            </form>

        </div>
        <div class="col-md-6">
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
            <p>Mes demandes amis en attente:</p>
            <ul>
                <?php

            
$sql = "SELECT login FROM user u INNER JOIN friends f on f.idfriend = u.id WHERE f.iduser = ? AND f.isvalidate IS NULL"; //Renvoie liste des nom AMIS de la personne connecté 
$q = $pdo->prepare($sql);
$q->execute(array($_SESSION["id"]));
while ($result = $q->fetch()){ 
echo"
<form name='formdel' action='index.php?action=delfriendaction' method='POST'>
<li><a href='index.php?action=friendwall?".$result['login']."'>".$result['login']."</a>
    
<input type='hidden' name='friendname' id='friendname' value=".$result['login']." />
<button type='submit' class='btn btn-secondary btn-sm' disabled>En attente de validation</button> 
</li>
        </form>
    
    

";}  
$sql = "SELECT login FROM user u INNER JOIN friends f on f.idfriend = u.id WHERE f.iduser = ? AND f.isvalidate=0"; //Renvoie liste des nom AMIS de la personne connecté qui ont refusé l'invite
$q = $pdo->prepare($sql);
$q->execute(array($_SESSION["id"]));
while ($result = $q->fetch()){ 
echo"
<form name='formdel' action='index.php?action=delfriendaction' method='POST'>
<li><a href='index.php?action=friendwall?".$result['login']."'>".$result['login']."</a>
<button type='submit' class='btn btn-secondary btn-sm' disabled>Refusé</button> 
</li>
        </form>
    
    

";}  
            
            ?>
            </ul>
            <button class="btn btn-primary toggle">Ajouter des amis</button>
            <div class="search-box" id="target">
                <main>
                    <form role="form" autocomplete="off">

                        <input type="text" class="search" placeholder="Recherchez un amis" size="30" id="search" />
                    </form>
                    <div id="display"></div>


                </main>
            </div>


        </div>
    </div>
