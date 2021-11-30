<?php
	require_once "./include/functions.inc.php";
	session_start();

//PAGE DE VERIFICATION DE LOGIN => page intermédiare sans affichage

	//connexion à la database
	$connexion = connect_db();
	

	$query = "SELECT Prix FROM Boutique WHERE Id_Obj_Bou=".$_POST['objet'].";";
	$rs = pg_query($connexion,$query);
	$data_prix = pg_fetch_row($rs);
	
	$prix = $data_prix[0];

	$query = "SELECT Nombre_Objet FROM Objet WHERE Id_Dre=".$_SESSION['id']." AND Id_Obj_Bou=".$_POST['objet'].";";
	$rs = pg_query($connexion,$query);
	$data_nb = pg_fetch_row($rs);

	$nb_obj = $data_nb[0];

	$query = "SELECT Boguemoula FROM Dresseur WHERE Id_Dre=".$_SESSION["id"].";";
	$rs = pg_query($connexion,$query);
	$data_moula = pg_fetch_row($rs);

	$boguemoula = $data_moula[0];
	
	$nouveau_solde = $boguemoula-$prix;

	if ($boguemoula < $prix){
		header('Location: boutique.php?insufisant'); //redirection
  		exit();
	}
	else {

		if ($nb_obj==0){ //pas de résultat, insertion de l'objet
			//Insertion de l'objet dans table
			$query = "INSERT INTO Objet (Id_Obj, Id_Obj_Bou, Id_Dre, Nombre_Objet) VALUES (DEFAULT, ".$_POST['objet'].", ".$_SESSION['id'].",1) ";
			$r = pg_query($connexion,$query);
			//Modification du solde de boguemoula
			$query = "UPDATE Dresseur SET Boguemoula=".$nouveau_solde." WHERE Id_Dre=".$_SESSION['id'];
			$r = pg_query($connexion,$query);
		}
		else { //le dresseur possède déjà un objet de cette catégorie
			//Incrementation du nombre d'objet correpondant
			$nb_obj ++;
			$query = "UPDATE Objet SET Nombre_Objet=".$nb_obj." WHERE Id_Dre=".$_SESSION['id']." AND Id_Obj_Bou=".$_POST['objet'].";";
			$r = pg_query($connexion,$query);
			//Modification du solde de boguemoula
			$query = "UPDATE Dresseur SET Boguemoula=".$nouveau_solde." WHERE Id_Dre=".$_SESSION['id'];
			$r = pg_query($connexion,$query);
		}
	}
	
	header('Location: boutique.php?achat'); //redirection
  	exit();
	
	
?>
