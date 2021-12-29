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

<h1>La Boutique</h1>

<p>Bienvenue à la boutique Boguemon ! C'est ici que vous pouvez faire le plein de Bogueballes pour vos exploration :</p>

<?php

	//connexion à la database
	$connexion = connect_db();


	//GESTION DES ERREURS
	if (isset($_GET['insufisant'])){
		echo "<div class='error'> <h3>Echec de l'achat.</h3> 
		<p>Solde insufisant : Vous n'avez pas assez de Boguemoula pour acheter cette balle.</p>
		</div>";
	}

	elseif (isset($_GET['achat'])) {
		echo "<div class='sucess'>
                 <h3>Achat effectué !</h3>
           </div>";
	}




	//AFFICHAGE DE LA BOGUEMOULA DE L'UTILISATEUR
	$query = "SELECT Boguemoula FROM Dresseur WHERE Id_Dre=".$_SESSION["id"].";";
	$rs = pg_query($connexion,$query);
	$data = pg_fetch_row($rs);

	echo "<h3 style='font-weight:bold; margin-right: 5%;'>Boguemoula de ".$_SESSION['username']." : ". $data[0]. "฿ </h3>";

	//AFFICHAGE DE LA BOUTIQUE
	$query = "SELECT * FROM Boutique;";
	$rs = pg_query($connexion,$query);

	$i =1;
	while ($data = pg_fetch_row($rs)) {
	
		if ($i<=4){ //restriction pour afficher seulement des balles
	
	echo '<form action="achat.php" method="post">
		<input type="radio" class="only" name="objet" id="objet" value="'.$data[0].'" checked="" />';
		echo "<label for='objet'>".$data[1]." / ".$data[2]."฿ </label>";
		echo '<input type="submit" name="submit" value="Acheter" /> 
		</form> </br>';
	
		}
	$i++;
	}

require_once "./include/footer.inc.php"; 
?>