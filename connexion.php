<?php
	require_once "./include/functions.inc.php";

//PAGE DE VERIFICATION DE LOGIN => page intermédiare sans affichage

	//connexion à la database
	$connexion = connect_db();
	
	echo $_POST["username"];
	echo "\n";
	echo md5($_POST["password"]);
	$username = $_POST["username"];
	$password = md5($_POST["password"]);

	$query = "SELECT * FROM Dresseur WHERE Nom_Dre='$username' AND Password='$password'";
	$rs = pg_query($connexion,$query);
	$data = pg_fetch_array($rs);
	pg_close();
	
	if($data[0] == 1) { //présence d'un correspondance
		session_start();
		$_SESSION['username'] = $username;
		header('Location: espace-util.php?'.$_SESSION['username']); //redirection
  		exit();
	}
	else if ($data[0] == 0) {
		header('Location: index.php?bad-login=1'); //redirection
  		exit();
	}
	
	
?>
<!-- Si login ok, espace perso

Sinon, redirection vers accueil avec $_GET error pour afficher un message d'erreur-->
