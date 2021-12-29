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

	
	
<?php
	if (isset($_SESSION['username'])){
		
		//connexion à la database
		$connexion = connect_db();

		echo "<h1>Détails de l'échange</h1>";
	
	
		echo "<p>Sélectionnez les 2 Boguemons à échanger parmis ceux de votre équipe et de celle de <strong>".$_GET['nom_dre_rec']."</strong></p>";
		echo "<p style='font-style: italic;'>Notez que pour pouvoir échanger un Boguemon, celui doit être dans votre équipe ET ne doit pas être déjà impliqué dans un échange.</p>";
		

		//Ajout dans la table Echange après la confirmation de l'échange
		if ((isset($_GET['bog_equipe']))&&(isset($_GET['bog_equipe2']))) {

			$query = 'INSERT INTO Echange(Id_Dre_Exp, Id_Bog_Exp, Id_Dre_Rec, Id_Bog_Rec)
				VALUES ('.$_SESSION["id"].', '.$_GET["bog_equipe"].', '.$_GET["id_dre_rec"].', '.$_GET["bog_equipe2"].');';
			$rs = pg_query($connexion,$query);

			header('Location: echange.php?sent-exchange');
			exit();
		}

		//Vérifier que le l'utilisateur n'a pas entré son nom
		if($_GET['id_dre_rec']==$_SESSION['id']){
			header('Location: echange.php?self-exchange');
			exit();
		}



        echo "<form action='liste-echange.php' method='get'>";
		
		
		echo "<input type='radio' class='only' name='id_dre_exp' id='id_dre_exp' value='".$_SESSION['id']."' checked='' />";
		echo "<label for='id_dre_exp' class='h3'> Mon Equipe </label>";
		$query = "SELECT * FROM Boguemon NATURAL JOIN Espece WHERE Id_Dre=".$_SESSION['id']." AND Dans_Equipe=TRUE";
		$rs = pg_query($connexion,$query);
		

		echo "<table>
		<thead>
			<th>Boguemon</th>
			<th>Surnom</th>
			<th>Niveau</th>
			<th>XP</th>
			<th>PV</th>
			<th>Att</th>
			<th>Def</th>
			<th>Att_spe</th>
			<th>Def_spe</th>
			<th>Vitesse</th>
			<th>Type1</th>
			<th>Type2</th>
			<th>Donner</th>
		</thead>
		
		<tbody>";
		
		while ($data = pg_fetch_row($rs)){
			$id_bog = $data[1];
			
			$nom_bog = $data[17];
			$surnom = $data[2];
			$niveau = $data[8];
			$xp = $data[9];
			
			$pv = $data[10];
			$att = $data[11];
			$def = $data[12];
			$att_spe = $data[13];
			$def_spe = $data[14];
			$vitesse = $data[15];
			
			$type1_bog = $data[18];
			$type2_bog = $data[19];
			
			$equipe = $data[16];

			//Vérifier que le Boguemon n'est pas déjà impliqué dans un échange
			$query = "SELECT * FROM Echange WHERE (Id_Bog_Exp=".$id_bog." OR Id_Bog_Rec=".$id_bog.") AND Etat='En attente';";
			$rv = pg_query($connexion,$query);
			$verif = pg_fetch_row($rv);

			if ($verif[0] == '') {
			
			echo "<tr>
				<td>".$nom_bog."</td>
				<td>".$surnom."</td>
				<td>".$niveau."</td>
				<td>".$xp."</td>
				<td>".$pv."</td>
				<td>".$att."</td>
				<td>".$def."</td>
				<td>".$att_spe."</td>
				<td>".$def_spe."</td>
				<td>".$vitesse."</td>
				<td>".$type1_bog."</td>
				<td>".$type2_bog."</td>
				<td>
						<input type='radio' name='bog_equipe' id='bog_equipe' value='".$id_bog."' checked='' />
				</td>
				</tr>";
			}
		}
		echo "</tbody>
			</table>";
		
		echo "</br>";

		echo "<input type='radio' class='only' name='id_dre_rec' id='id_dre_rec' value='".$_GET['id_dre_rec']."' checked='' />";
		echo "<label for='id_dre_rec' class='h3'>Equipe de ".$_GET['nom_dre_rec']."</label>";
		
		
		$query = "SELECT * FROM Boguemon NATURAL JOIN Espece WHERE Id_Dre=".$_GET['id_dre_rec']."AND Dans_Equipe=TRUE";
		$rs = pg_query($connexion,$query);
		

		echo "<table>
		<thead>
			<th>Boguemon</th>
			<th>Surnom</th>
			<th>Niveau</th>
			<th>XP</th>
			<th>PV</th>
			<th>Att</th>
			<th>Def</th>
			<th>Att_spe</th>
			<th>Def_spe</th>
			<th>Vitesse</th>
			<th>Type1</th>
			<th>Type2</th>
			<th>Recevoir</th>
		</thead>
		
		<tbody>";
		
		while ($data = pg_fetch_row($rs)){
			$id_bog = $data[1];
			
			$nom_bog = $data[17];
			$surnom = $data[2];
			$niveau = $data[8];
			$xp = $data[9];
			
			$pv = $data[10];
			$att = $data[11];
			$def = $data[12];
			$att_spe = $data[13];
			$def_spe = $data[14];
			$vitesse = $data[15];
			
			$type1_bog = $data[18];
			$type2_bog = $data[19];
			
			$equipe = $data[16];

			//Vérifier que le Boguemon n'est pas déjà impliqué dans un échange
			$query = "SELECT * FROM Echange WHERE (Id_Bog_Exp=".$id_bog." OR Id_Bog_Rec=".$id_bog.") AND Etat='En attente';";
			$rv = pg_query($connexion,$query);
			$verif = pg_fetch_row($rv);

			if ($verif[0] == '') {
			
			echo "<tr>
				<td>".$nom_bog."</td>
				<td>".$surnom."</td>
				<td>".$niveau."</td>
				<td>".$xp."</td>
				<td>".$pv."</td>
				<td>".$att."</td>
				<td>".$def."</td>
				<td>".$att_spe."</td>
				<td>".$def_spe."</td>
				<td>".$vitesse."</td>
				<td>".$type1_bog."</td>
				<td>".$type2_bog."</td>
				<td>
						<input type='radio' name='bog_equipe2' id='bog_equipe2' value='".$id_bog."' checked='' />
				</td>
				</tr>";
			}
		}
		echo "</tbody>
			</table>";
	

	echo "<input type='submit' name='exchange' value='Confirmer la demande'/> 
	
	</form>";
	
	}
	else{
		echo "<div class='error'>
		<h3>Vous n'êtes pas connecté.</h3>
		<p>Pour accéder à la page de connexion : <a href='index.php' class='underlined'>Cliquez ici</a></p>
		</div>";
	}
	
require_once "./include/footer.inc.php"; 
?>