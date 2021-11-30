<?php
	require_once "./include/functions.inc.php";
	session_start();

//PAGE DE VERIFICATION DE LOGIN => page intermédiare sans affichage

	//connexion à la database
	$connexion = connect_db();

	if (isset($_GET['choix-echange'])){
		$info = explode('-', $_GET['choix-echange']);

		$id_bog_exp = $info[0];
		$id_dre_exp = $info[1];
		$id_bog_rec = $info[2];
		$id_dre_rec = $info[3];

		if ($_GET['submit']=="Accepter") {

			$query = "UPDATE Boguemon SET Id_Dre=".$id_dre_exp." WHERE Id_Bog=".$id_bog_rec." AND Id_Dre=".$id_dre_rec.";";
			$rs = pg_query($connexion,$query);

			$query = "UPDATE Boguemon SET Id_Dre=".$id_dre_rec." WHERE Id_Bog=".$id_bog_exp." AND Id_Dre=".$id_dre_exp.";";
			$rs = pg_query($connexion,$query);

			$query = "UPDATE Echange SET Etat='Effectué' WHERE Id_Dre_Rec=".$id_dre_rec." AND Id_Bog_Rec=".$id_bog_rec." AND Id_Dre_Exp=".$id_dre_exp." AND Id_Bog_Exp=".$id_bog_exp.";";
			$rs = pg_query($connexion,$query);
			
			header('Location: echange.php?exchange-completed');
			exit();
		}

		else if ($_GET['submit']=="Refuser"){

			$query = "UPDATE Echange SET Etat='Refusé' WHERE Id_Dre_Rec=".$id_dre_rec." AND Id_Bog_Rec=".$id_bog_rec." AND Id_Dre_Exp=".$id_dre_exp." AND Id_Bog_Exp=".$id_bog_exp.";";
			$rs = pg_query($connexion,$query);

			header('Location: echange.php?exchange-completed');
			exit();
		}

		else{
			header('Location: echange.php?anormal-error');
			exit();
		}
	}


	elseif (isset($_GET['suppr'])) {
		$info = explode('-', $_GET['suppr']);

		$id_bog_exp = $info[0];
		$id_dre_exp = $info[1];
		$id_bog_rec = $info[2];
		$id_dre_rec = $info[3];
		$suppr = $info[4];

		foreach ($info as $value) {
			echo $value." / ";
		}

		if ($suppr==1) {
			$query = "UPDATE Echange SET Suppr_Exp=TRUE WHERE Id_Dre_Rec=".$id_dre_rec." AND Id_Bog_Rec=".$id_bog_rec." AND Id_Dre_Exp=".$id_dre_exp." AND Id_Bog_Exp=".$id_bog_exp.";";
			$rs = pg_query($connexion,$query);
		}

		elseif ($suppr==2){
			$query = "UPDATE Echange SET Suppr_Rec=TRUE WHERE Id_Dre_Rec=".$id_dre_rec." AND Id_Bog_Rec=".$id_bog_rec." AND Id_Dre_Exp=".$id_dre_exp." AND Id_Bog_Exp=".$id_bog_exp.";";
			$rs = pg_query($connexion,$query);
		}
		else{
			header('Location: echange.php?anormal-error');
			exit();
		}

		//Vider les lignes que plus personne ne veut afficher
		$query = "DELETE FROM Echange WHERE Suppr_Exp=TRUE AND Suppr_Rec=TRUE AND Id_Dre_Rec=".$id_dre_rec." AND Id_Bog_Rec=".$id_bog_rec." AND Id_Dre_Exp=".$id_dre_exp." AND Id_Bog_Exp=".$id_bog_exp.";";
		$rs = pg_query($connexion,$query);

		header('Location: echange.php?suppr-completed');
		exit();
	}

	else{
		echo "<p>Vous n'êtes pas sensé vous trouvez ici, ceci est une page de traitement. <a href='index.php' class='underlined'>Retourner à l'accueil</a></p>";
	}

?>
