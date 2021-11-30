<?php
	declare(strict_types=1);
	require_once "./include/functions.inc.php";
	require_once "./include/util.inc.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Boguemon Balade</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="icon" type="image/png" href="images/bogue_ico.png"/>
	<meta charset="utf-8" />
	<meta name="description" content="Projet BD-Réseau : Boguemon Ballad" />
	<meta name="keywords" content="php, web, html, td, database, reseau" />
	<meta name="author" content="Lucas LAVIGNE et Noah LACCHINI" />
	<meta name="date" content="2021-11-23" />
	<?php
		if (!(empty($redirection_url))) {
			echo redirection($redirection_url); //True if there is an error in filling forms
		}
	?>

</head>

<body>
	<header>
		<nav>
			<img src="images/boguemon_ballad.png" alt="Logo du site Boguemon Balade" />
			<ul class="scrollhorizontal">
				<li><a href="../index.php">Accueil</a></li>
				<li><a href="../propos.php">A propos</a></li>
				<li style="font-weight: bold;">    Menu : </li>
				<li><a href="../espace-util.php">Boguedex</a></li>
				<li><a href="../boutique.php">Boutique</a></li>
				<li><a href="../echange.php">Echange</a></li>
				<li style="font-weight: bold;">    Quitter : </li>
				<li><a href="deconnexion.php">Se déconnecter</a></li>
				
			</ul>
		</nav>		
	</header>

	<main>