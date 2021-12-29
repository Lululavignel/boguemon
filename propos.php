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
?>


	<h1>A propos</h1>

	<p>        Notre projet de base de données se reposera sur les Boguemons, des créatures sauvages possédant des capacités élémentaires. Les joueurs seront des dresseurs qui pourront attraper des Boguemons sauvages pour compléter leur Boguedex. Le dresseur peut former une équipe de Boguemons avec laquelle il partira à l’aventure.</p>
	<p>Chaque Boguémon :
	<ul>
		<li>appartient à une espèce différente et chacune de ces espèces ont un type. </li>
		<li>est identifié par un numéro de Boguédex représentant son espèce.</li>
		<li>peut maîtriser jusqu’à 4 capacités.</li>
		<li>a des statistiques qui peuvent varier, même au sein d’une même espèce.</li>
		<li>gagne de l’expérience lorsqu’il est dans l’équipe pendant l’exploration. Avec assez d’expérience, il monte de niveau. </li>
	</ul>
	<p>Grâce au client Java, le joueur pourra partir à l’aventure pour tenter de capturer de nouveaux Boguemons sauvages. Lorsque le dresseur en rencontre un, il peut essayer de l’attraper avec l’une de ses Boguéballes, ou bien fuir. Les chances de capture varient selon la qualité de la balle utilisée, la moyenne de niveau des Boguemons de l’équipe, et la rareté du Boguemon sauvage.</p>
	<p>Lorsqu’un joueur attrape un Boguemon, celui-ci est stocké dans sa ‘Box’. Grâce au site web, il peut choisir de l’utiliser dans son équipe ou non, sachant qu’un dresseur peut avoir entre 1 et 6 Boguémons dans son équipe. Avoir un Boguemon dans son équipe permet de le faire évoluer lors de l’exploration sur le client Java, mais aussi de pouvoir l’échanger avec d’autres dresseurs sur le site web.</p>


<p>Le but est d’attraper toutes les espèces de Boguemon pour remplir son Boguedex à 100%, et de former la meilleure équipe de Boguemons afin de devenir le meilleur dresseur.</p>

<p>Amusez-vous bien sur Boguemon Balade !</p>
<?php require_once "./include/footer.inc.php"; ?>