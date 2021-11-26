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

	
	
<?php
	if (isset($_SESSION['username'])){

		echo "<h1>Mon Boguedex</h1>";
		
		echo $_SESSION['id'];
	
		echo "<p>Bienvenue ".$_SESSION['username']."</p>";
	}
	
	else{
		echo "<div class='error'>
		<h3>Vous n'êtes pas connecté.</h3>
		<p>Pour accéder à la page de connexion : <a href='index.php' class='underlined'>Cliquez ici</a></p>
		</div>";
}
	
	

?>