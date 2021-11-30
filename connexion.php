<?php
	require_once "./include/functions.inc.php";

//PAGE DE VERIFICATION DE LOGIN => page intermédiare sans affichage

	//connexion à la database
	$connexion = connect_db();
	
	$username = $_POST["username"];
	$password = md5($_POST["password"]);

	$query = "SELECT Id_Dre FROM Dresseur WHERE Nom_Dre='$username' AND Password='$password'";
	$rs = pg_query($connexion,$query);
	$data = pg_fetch_row($rs);
	pg_close();
	
	if($data[0] != null) { //présence d'un correspondance
		session_start();
		$_SESSION['username'] = $username;
		$_SESSION['id'] = $data[0]; //colonne id du premier résultat
		header('Location: espace-util.php?'.$_SESSION['username']); //redirection
  		exit();
	}
	else { //pas de résultat
		header('Location: index.php?bad-login=1'); //redirection
  		exit();
	}
	
?>
