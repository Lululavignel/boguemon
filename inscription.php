<?php
	session_start();
	if (isset($_SESSION['username'])){
    	require "./include/connected_header.inc.php";
	}
	else{
		require "./include/header.inc.php";
	}
	require_once "./include/functions.inc.php";
	require_once "./include/util.inc.php";
?>


	<h1>Inscription</h1>

	<p>C'est votre première fois sur Boguemon Ballad ? Créez votre compte et commencez votre aventure !</p>

	<form style="margin-right: auto; margin-left: auto; width: 60%;" action="inscription.php" method="post"> 
		<input type="text" name="username" id="username" placeholder="Nom d'utilisateur"/> </br>
		<input type="password" name="password" id="password" placeholder="Mot de passe"/> </br>
		<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer le Mot de passe"/> </br>
		
		<input type="submit" name="submit" value="Inscription" />
		
		<p>Déjà inscrit? <a href="index.php" class="underlined">Connectez-vous ici</a></p>
	</form>	

<?php

//VERIFICATION
if (isset($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['confirm_password'])){
  	//connexion à la database
	$connexion = connect_db();
	
	//gestion des erreurs de formulaire
    if($_REQUEST['password']!=$_REQUEST['confirm_password']){
        echo "<div class='error'>
             <h3>Les deux mots de passe ne correspondent pas.</h3>
       </div>";
    }
	else if ($_REQUEST['username']=="" || $_REQUEST['password']=="" || $_REQUEST['confirm_password']==""){
		echo "<div class='error'>
             <h3>Tous les champs n'ont pas été remplis.</h3>
       </div>";
	}
	
	//execution de l'inscription
    else{
      // récupérer le nom d'utilisateur 
      $username = stripslashes($_REQUEST['username']); //encodage html vers string pour éviter les erreurs dans les requêtes SQL
      
      // récupérer le mot de passe 
      $password = stripslashes($_REQUEST['password']);
      $password = md5($password); //hash du password
      
      $query = "INSERT INTO Dresseur(Id_Dre, Nom_Dre, Password, Boguemoula, Admin)
            VALUES (DEFAULT, '$username', '$password', '100', '0')";
      
      $rs = pg_query($connexion, $query);
        if($rs){
           echo "<div class='sucess'>
                 <h3>Inscription réussie</h3>
                 <p>Vous pouvez désormais vous <a href='index.php'  class='underlined'>connecter ici</a>.</p>
           </div>";
        }
		else{
			echo "<div class='error'>
             <h3>Echec de l'inscription, base de données inaccecible.</h3>
       </div>";
		}
    }
}

require_once "./include/footer.inc.php"; 

?>