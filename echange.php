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

<h1>Centre d'échange</h1>

<?php
if (isset($_SESSION['username'])){

	//connexion à la database
	$connexion = connect_db();

?>
	<p>Dans le centre d'échage, vous pouvez échanger vos Boguemons avec les autres Dresseurs.</p>

	
	<h2>Faire une demande d'échange</h2>
	<p>Entrez un nom de Dresseur pour voir ses Boguemon et proposer un échange.</p>

	<form style="margin-right: auto; margin-left: auto; width: 60%;" action="echange.php" method="get"> 
		<input type="text" name="nom_dre_rec" id="nom_dre_rec" placeholder="Nom d'utilisateur"/> 
		<input type="submit" name="submit" value="Commencer un échange" />
	</form>

<?php

	if (isset($_GET['nom_dre_rec'])) {
		$query="SELECT Id_Dre,Nom_Dre FROM Dresseur WHERE Nom_Dre='".$_GET['nom_dre_rec']."';";
		$rs = pg_query($connexion,$query);
		$data = pg_fetch_row($rs);

		if ($data[0] != NULL) {
			$id_dre_rec = $data[0];
			$nom_dre_rec = $data[1];
			header('Location: liste-echange.php?id_dre_rec='.$id_dre_rec.'&nom_dre_rec='.$nom_dre_rec);
			exit();
			//Choix des Boguemons à echnger sur la page liste-echange.php
		}
		else {
			echo "<div class='error'>
			<h3>Dresseur introuvable</h3>
			<p>Le nom d'utilisateur entré ne correspond à aucun résultat.</p>
			</div>";
		}
		

	}

	if (isset($_GET['self-exchange'])) {
		echo "<div class='error'>
			<h3>Utilisateur incorrect</h3>
			<p>Vous ne pouvez pas vous échanger des Boguemons avec vous-même.</p>
		</div>";
	}

	echo "<h2>Demandes d'échange envoyées et reçues</h2> 
	<p>Acceptez ou refusez les demandes d'échanges que vous avez reçu et consultez vos demandes d'échanges.</p>";

	$query="SELECT * FROM Echange WHERE (Id_Dre_Rec=".$_SESSION['id']." OR Id_Dre_Exp=".$_SESSION['id'].") AND Etat='En attente';";
	$rs = pg_query($connexion,$query);

	echo "<table>
	<thead>
		<th> Le Dresseur </th>
		<th> a proposé à </th>
		<th> d'échanger son </th>
		<th> de niveau </th>
		<th> contre un</th>
		<th> de niveau </th>
		<th> Réponse </th>
	</thead>
	<tbody>";


	while ($data = pg_fetch_row($rs)){

		$id_bog_exp=$data[0];
		$id_dre_exp=$data[1];
		$id_bog_rec=$data[2];
		$id_dre_rec=$data[3];
		$etat=$data[4];

		//Recherche du nom de Dresseur qui PROPOSE l'échange selon leur id
		$query="SELECT Nom_Dre FROM Dresseur WHERE Id_Dre=".$id_dre_exp.";";
		$rs_nom=pg_query($connexion,$query);
		$data_nom=pg_fetch_row($rs_nom);

		$nom_dre_exp=$data_nom[0];

		//Recherche du nom de Dresseur qui DOIT REPONDRE à l'échange selon leur id
		$query="SELECT Nom_Dre FROM Dresseur WHERE Id_Dre=".$id_dre_rec.";";
		$rs_nom=pg_query($connexion,$query);
		$data_nom=pg_fetch_row($rs_nom);

		$nom_dre_rec=$data_nom[0];

		//Recherche du nom du Boguemon PROPOSEé
		$query="SELECT Nom_Bog,Niveau FROM Boguemon NATURAL JOIN Espece WHERE Id_Bog=".$id_bog_exp.";";
		$rs_nom=pg_query($connexion,$query);
		$data_nom=pg_fetch_row($rs_nom);

		$nom_bog_exp=$data_nom[0];
		$niveau_bog_exp=$data_nom[1];


		//Recherche du nom du Boguemon DEMANDEé
		$query="SELECT Nom_Bog,Niveau FROM Boguemon NATURAL JOIN Espece WHERE Id_Bog=".$id_bog_rec.";";
		$rs_nom2=pg_query($connexion,$query);
		$data_nom2=pg_fetch_row($rs_nom2);

		$nom_bog_rec=$data_nom2[0];
		$niveau_bog_rec=$data_nom2[1];
			
		
			echo "<tr>
				<td>".$nom_dre_exp."</td>
				<td>".$nom_dre_rec."</td>
				<td>".$nom_bog_exp."</td>
				<td>".$niveau_bog_exp."</td>
				<td>".$nom_bog_rec."</td>
				<td>".$niveau_bog_rec."</td>
				<td>";
				if ($id_dre_exp==$_SESSION['id']) {
					echo "En attente de ".$nom_dre_rec."</td>";
				}
				else {
					echo "
					<form action='result-echange.php' style='display: inline;' method='get'>
					<input type='radio' class='only' name='choix-echange' id='choix-echange' value='".$id_bog_exp."-".$id_dre_exp."-".$id_bog_rec."-".$id_dre_rec."' checked='' />
						<input type='submit' name='submit' value='Accepter' /> 
					</form>
					<form action='result-echange.php' style='display: inline;' method='get'>
					<input type='radio' class='only' name='choix-echange' id='choix-echange' value='".$id_bog_exp."-".$id_dre_exp."-".$id_bog_rec."-".$id_dre_rec."' checked='' />
						<input type='submit' name='submit' value='Refuser' /> 
					</form>
				</td>
				</tr>";
				}
	}
	echo "</tbody>
	</table>";

	//Afficher le tableau

	echo "<h2>Echanges terminés</h2> 
	<p>Historique des échanges terminés, vous pouvez les supprimer à tout moment.</p>";

	$query="SELECT * FROM Echange WHERE (Id_Dre_Rec=".$_SESSION['id']." OR Id_Dre_Exp=".$_SESSION['id'].")  AND (Etat='Effectué' OR Etat='Refusé')";
	$rs = pg_query($connexion,$query);


		echo "<table>
	<thead>
		<th> Le Dresseur </th>
		<th> a proposé à </th>
		<th> d'échanger son </th>
		<th> de niveau </th>
		<th> contre un</th>
		<th> de niveau </th>
		<th> Etat </th>
	</thead>
	<tbody>";

	while ($data = pg_fetch_row($rs)){

		$id_bog_exp=$data[0];
		$id_dre_exp=$data[1];
		$id_bog_rec=$data[2];
		$id_dre_rec=$data[3];
		$etat=$data[4];
		$etat_suppr1=$data[5];
		$etat_suppr2=$data[6];

		//Recherche du nom de Dresseur qui PROPOSE l'échange selon leur id
		$query="SELECT Nom_Dre FROM Dresseur WHERE Id_Dre=".$id_dre_exp.";";
		$rs_nom=pg_query($connexion,$query);
		$data_nom=pg_fetch_row($rs_nom);

		$nom_dre_exp=$data_nom[0];

		//Recherche du nom de Dresseur qui A REPONDU à l'échange selon leur id
		$query="SELECT Nom_Dre FROM Dresseur WHERE Id_Dre=".$id_dre_rec.";";
		$rs_nom=pg_query($connexion,$query);
		$data_nom=pg_fetch_row($rs_nom);

		$nom_dre_rec=$data_nom[0];

		//Recherche du nom du Boguemon PROPOSEé
		$query="SELECT Nom_Bog,Niveau FROM Boguemon NATURAL JOIN Espece WHERE Id_Bog=".$id_bog_exp.";";
		$rs_nom=pg_query($connexion,$query);
		$data_nom=pg_fetch_row($rs_nom);

		$nom_bog_exp=$data_nom[0];
		$niveau_bog_exp=$data_nom[1];


		//Recherche du nom du Boguemon DEMANDEé
		$query="SELECT Nom_Bog,Niveau FROM Boguemon NATURAL JOIN Espece WHERE Id_Bog=".$id_bog_rec.";";
		$rs_nom2=pg_query($connexion,$query);
		$data_nom2=pg_fetch_row($rs_nom2);

		$nom_bog_rec=$data_nom2[0];
		$niveau_bog_rec=$data_nom2[1];

		if ($id_dre_exp==$_SESSION['id']) {
			$suppr = 1;
		}
		elseif ($id_dre_rec==$_SESSION['id']) {
			$suppr = 2;
		}

		if ( !( (($suppr==1)&&($etat_suppr1=='t')) || (($suppr==2)&&($etat_suppr2=='t')) ) )  { //ne pas afficher la ligne si supprimé par l'utilisateur
			
			echo "<tr>
				<td>".$nom_dre_exp."</td>
				<td>".$nom_dre_rec."</td>
				<td>".$nom_bog_exp."</td>
				<td>".$niveau_bog_exp."</td>
				<td>".$nom_bog_rec."</td>
				<td>".$niveau_bog_rec."</td>
				<td>".$etat."</td>
				<td>";
				
				echo "
					<form action='result-echange.php' method='get'>
						<input type='radio' class='only' name='suppr' id='suppr' value='".$id_bog_exp."-".$id_dre_exp."-".$id_bog_rec."-".$id_dre_rec."-".$suppr."' checked='' />
						<input type='submit' name='submit' value='Supprimer' /> 
					</form>
				</td>
				</tr>";
		}
	}
	echo "</tbody>
	</table>";

}

else{
	echo "<div class='error'>
	<h3>Vous n'êtes pas connecté.</h3>
	<p>Pour accéder à la page de connexion : <a href='index.php' class='underlined'>Cliquez ici</a></p>
	</div>";
}

require_once "./include/footer.inc.php"; 

?>