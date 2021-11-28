<?php
	require_once "./include/functions.inc.php";
	session_start();

//PAGE DE VERIFICATION DE LOGIN => page intermédiare sans affichage

	//connexion à la database
	$connexion = connect_db();

	$query = "SELECT COUNT(*) FROM Boguemon WHERE Dans_Equipe=TRUE AND Id_Dre=".$_SESSION['id'];
	$rs = pg_query($connexion,$query);
	$count_bog = pg_fetch_row($rs);

	echo $_POST['bog_equipe'];
	
	if (isset($_POST['remove'])){
		//verification : au moins 1 boguemon dans equipe
		if ($count_bog[0]>1){
			//changement
			$query = "UPDATE Boguemon SET Dans_Equipe=FALSE WHERE Id_Dre=".$_SESSION['id']." AND Num_Bog=".$_POST['bog_equipe'];
			$r = pg_query($connexion,$query);
			echo 'done retiré';
			
			header('Location: espace-util.php?team-remove&'.$_POST['bog_equipe']); //redirection
			exit();
			
		}
		else{
			
			header('Location: espace-util.php?team-empty'); //redirection
			exit();
			
		}
	}
	
	elseif (isset($_POST['add'])){
		
		//verification : pas plus de 6 boguemons dans equipe
		if ($data[0]<6){
			//changement
			$query = "UPDATE Boguemon SET Dans_Equipe=TRUE WHERE Id_Dre=".$_SESSION['id']." AND Num_Bog=".$_POST['bog_equipe'];
			$r = pg_query($connexion,$query);
			echo 'done ajout';
			
			header('Location: espace-util.php?team-add&'.$_POST['bog_equipe']); //redirection
			exit();
			
		}
		else{
			
			header('Location: espace-util.php?team-full'); //redirection
			exit();
			
		}
		
	}

	else {
		echo 'error';
	}

?>
