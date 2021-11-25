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


	<h1>A propos</h1>

	<p>Notre projet de base de données se reposera sur les Boguémons, des créatures sauvages possédant des capacités élémentaires. Les joueurs seront des dresseurs qui pourront attraper des Boguemons sauvages pour former une équipe et réaliser des combats de Boguemons avec d’autres joueurs.</p>
	<p>Chaque Boguémon :
	<ul>
		<li>appartient à une espèce différente et chacune de ces espèces ont un type. 
est identifié par un numéro de Boguédex représentant son espèce.
peut maîtriser jusqu’à 4 capacités, de certains types uniquement (selon le(s) type(s) du Boguemon).</li>
		
		<li>a des statistiques qui peuvent varier, même au sein d’une même espèce.
gagne de l’expérience lorsqu’il remporte un combat. Avec assez d’expérience, il monte de niveau, ce qui augmente légèrement ses statistiques.</li>
		<li>Le joueur pourra chercher des Boguemons avec un bouton d’exploration. Grâce à cette fonctionnalité, le joueur pourra rencontrer des Boguemons sauvages, ce qui lance un combat contre celui-ci. Lors de ce combat, le joueur peut  attaquer le Boguemon avec l’un de son équipe, l’attraper avec l’une de ses Bogueball, ou bien fuir le combat. Certains objets sont également utilisables en combat.</li>
		<li>Lorsqu’un joueur attrape un Boguemon, celui-ci est stocké dans un “PC”. Il peut choisir de l’utiliser dans son équipe ou non, sachant qu’un dresseur peut avoir 6 Boguemons maximum dans son équipe. Avoir un Boguemon dans son équipe permet de pouvoir l’utiliser lors des combats.</li>
	</ul>



<p>Le but est de former la meilleure équipe de Boguemons afin de devenir le meilleur dresseur.
</p>

<?php require_once "./include/footer.inc.php"; ?>