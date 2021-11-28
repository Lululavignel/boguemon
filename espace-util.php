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
		
		//connexion à la database
		$connexion = connect_db();

		echo "<h1>Mon Boguedex</h1>";
		
		echo $_SESSION['id'];
	
		echo "<p>Bienvenue ".$_SESSION['username']."</p>";
		
		
		// AFFICHAGE DU SAC
		echo "<h2>Mon Sac</h2>";
		
		$query = "SELECT * FROM Objet NATURAL JOIN Boutique WHERE Id_Dre=".$_SESSION['id'];
		$rs = pg_query($connexion,$query);

		echo "<table>
		<thead>
			<th> Objet </th>
			<th> Nombre </th>
		</thead>
		
		<tbody>";
		
		while ($data = pg_fetch_row($rs)){
			$nom_obj = $data[4];
			$nb_obj = $data[3];
			echo "<tr>
				<td>".$nom_obj."</td>
				<td>".$nb_obj."</td>
				</tr>";
		}
		echo "</tbody>
			</table>";
		
		
		// AFFICHAGE DES BOGUEMONS
		echo "<h2>Mes Boguemons</h2>";
		
		echo "<h3> Equipe </h3>";
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
			<th>Dans Equipe</th>
		</thead>
		
		<tbody>";
		
		while ($data = pg_fetch_row($rs)){
			$id_bog = $data[0];
			
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
					<form action='equipe.php' method='post'>
						<input type='radio' name='bog_equipe' id='bog_equipe' value='".$id_bog."' checked='' />
						<input type='submit' name='remove' value='Retirer' /> 
					</form>
				</td>
				</tr>";
		}
		echo "</tbody>
			</table>";
		
		
		echo "<h3> Box </h3>";
		$query = "SELECT * FROM Boguemon NATURAL JOIN Espece WHERE Id_Dre=".$_SESSION['id']."AND Dans_Equipe=FALSE";
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
			<th>Dans Equipe</th>
		</thead>
		
		<tbody>";
		
		while ($data = pg_fetch_row($rs)){
			$id_bog = $data[0];
			
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
					<form action='equipe.php' method='post'>
						<input type='radio' name='bog_equipe' id='bog_equipe' value='".$id_bog."' checked='' />
						<input type='submit' name='add' value='Ajouter' /> 
					</form>
				</td>
				</tr>";
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
	
	

?>