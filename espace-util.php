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

	
	
<?php
	if (isset($_SESSION['username'])){

		echo "<h1>Mon Boguedex</h1>";
	
		echo "<p>Bienvenue ".$_SESSION['username']."</p>";
	}
	
	//connexion à la database
	$connexion = connect_db();
	
	echo $_SESSION['username'];
?>