<?php

function connect_db() {
	// Values for CYU database
	/*
	$ip = "10.40.128.23";
	$database = "db21l3i_e_nlacchin";
	$username = "y21l3i_e_nlacchin";
	$password = "A123456*";
	*/

	// Values for Alwaysdata database
	$ip = "postgresql-ananasjp.alwaysdata.net";
	$database = "ananasjp_bdd";
	$username = "ananasjp_user";
	$password = "Chocolatine1*";

	// Connexion à la base de données MySQL 
	//$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	$connect = pg_connect("host=".$ip." dbname=".$database." user=".$username. " password=".$password);

	// Vérifier la connexion
	if($connect == false){
		die("ERREUR : Impossible de se connecter à la base de donnée. ");
	}
	else{
		return $connect;
	}
}

?>