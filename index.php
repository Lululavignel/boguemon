<?php
	ini_set('session.gc_maxlifetime', 1800);
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

<!-- Formulaire de connexion -->
	<h1>Accueil</h1>

	<p> Bienvenue sur Boguemon Balade ! Pour accéder à votre espace personnel, connectez vous.</p>

	<form style="margin-right: auto; margin-left: auto; width: 60%;" action="connexion.php" method="post">
		<input type="text" name="username" id="username" placeholder="Nom d'utilisateur"/> <br/>
		<input type="password" name="password" id="password" placeholder="Mot de passe"/> <br/>
		
		<input type="submit" name="submit" value="Connexion" />
		
		<p>Pas de compte ? <a href="inscription.php" class="underlined">Inscrivez-vous ici</a></p>
	</form>
	
<?php
	if (isset($_GET['bad-login'])){
		echo "<div class='error'> <h3>Echec de la connexion.</h3> 
		<p>Ce nom d'utilisateur n'existe pas ou le mot de passe entré est incorrect.</p>
		</div>";
	}
    
require_once "./include/footer.inc.php"; 
?>