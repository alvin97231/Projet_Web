<?php

/**
 * Permet a travers un objet msqli, la connexion a la base de données
 * @return mysqli $bdd
*/
function connexionDB()
{
	try
		{
			$bdd = new mysqli("localhost", "root", "", "f4U");
			return $bdd;
		}
	catch(Exception $e)
		{
        	die('Erreur : '.$e->getMessage());
		}
}

/**
 * Connecte un utilisateur avec ses parametre
 * @param $bdd objet PDO
 * @param $login string de $POST['login']
 * @param $mdp string de $POST['mdp']
 * @return session demarrée ou redirection si mauvaises valeurs
*/
function initSessionUtilisateur($bdd, $login, $mdp)
{
	$req = "SELECT login, mdp, id_Personne
			FROM personne
			WHERE login = '".$login."'
			AND mdp = '".$mdp."'
			";

	$requete = $bdd->prepare($req);
	$resultat = $requete->execute();
	$row = $requete->fetch();

		if (!$row)
		{
			echo "<script> alert('Identifiant ou mot de passe incorrect');</script>";
			echo "<script> window.location='../index.php';</script>";
		}
		else
		{
	    	session_start();
	    	$_SESSION['login'] = $login;
	    	$_SESSION['mdp'] = $mdp;
	    	echo "<script> alert('Vous \352tes connect\351');</script>";
			echo "<script> window.location='../main.php';</script>";
	}
}

/**
 * Affecte a $idU la valeur de l'id de l'utilisateur qui s'est connecté
 * @param $bdd objet mysqli
 * @param $login string de $POST['login']
 * @param $mdp string de $POST['mdp']
*/
function affectTypeUtilisateur($bdd)
{
	session_start();
	$login = $_SESSION['login'];
	$mdp = $_SESSION['mdp'];

	$req = "SELECT id_Personne
			FROM personne
			WHERE login =  '".$login."'
			AND mdp = '".$mdp."'
			AND id_Personne = (SELECT id_Personne
													FROM eleve)";

	$req2 = "SELECT id_Personne
			FROM personne
			WHERE login =  '".$login."'
			AND mdp = '".$mdp."'
			AND id_Personne = (SELECT id_Personne
													FROM professeur)";

	$req3 = "SELECT id_Personne
		  FROM personne
		  WHERE login =  '".$login."'
		  AND mdp = '".$mdp."'
		  AND id_Personne = (SELECT id_Personne
		  										FROM administrateur)";

	$requete = $bdd->prepare($req);

	$resultat = $requete->execute();
	echo($resultat);
	$row = $requete->fetch();
	$_SESSION['type'] = 0;

	if ( isset($row) ){
		$_SESSION['type'] = 1;
		$_SESSION['id_Eleve']=$row[0];
	}
	else if ($row == null) {
		$requete = $bdd->prepare($req2);
		$resultat = $requete->execute();
		echo($resultat);
		$row = $requete->fetch();

		if ( isset($row) ){
			$_SESSION['type'] = 2;
			$_SESSION['id_Prof']=$row[0];
		}
		else if ($row == null) {
			$requete = $bdd->prepare($req3);
			$resultat = $requete->execute();
			echo($resultat);
			$row = $requete->fetch();

			if ( isset($row) ){
				$_SESSION['type'] = 3;
				echo $_SESSION['type'];
				$_SESSION['id_Admin']=$row[0];
			}
		}
	}
}

/**
 * Fournit la liste des enseignements dans un tableau
 * @param $bdd objet msqli
 * @return Array
*/
function studiesAdminList($bdd)
{

	$req = "SELECT id_Classe, Niveau FROM classe";

	$requete = $bdd->prepare($req);
	$requete->execute();
	$result = $requete -> get_result();

	while ($val = $result -> fetch_assoc())

		{

				$id = $val['id_Classe'];
				$niveau = $val['Niveau'];

				echo "<tr>";

				echo "<td>$id</td>";
				echo "<td>$niveau</td>";

				echo "</tr>\n";

		}

	$result -> free();
	//$bdd -> close();
}

/**
 * Fournit la liste des enseignements dans un tableau
 * @param $bdd objet msqli
 * @return Array
*/
function studiesTeacherList($bdd)
{
	$id_Prof = $_SESSION['id_Prof'];

	$query1 = "SELECT Matiere FROM professeur WHERE id_Personne = ?";
	$query2 = "SELECT id_Classe FROM est_prof WHERE id_Personne = ?";
	$query3 = "SELECT Niveau FROM classe WHERE id_Classe = ?";

	$stmt = $bdd->prepare($query1);
	$stmt->bind_param("i",$val1);
	$val1 = $id_Prof;
	$stmt->execute();
	$result = $stmt -> get_result();

	while ($val = $result -> fetch_assoc())

		{
				$matiere = $val['Matiere'];

				echo "<tr>";

				echo "<td>$matiere</td>";
		}

		$stmt = $bdd->prepare($query2);
		$stmt->bind_param("s",$val1);
		$val1 = $id_Prof;
		$stmt->execute();
		$result = $stmt -> get_result();
		$row = $result -> fetch_array( MYSQLI_NUM);
		$id_Classe = $row[0];

		$stmt = $bdd->prepare($query3);
		$stmt->bind_param("i",$val1);
		$val1 = $id_Classe;
		$stmt->execute();
		$result = $stmt -> get_result();

		while ($val = $result -> fetch_assoc())

			{
					$matiere = $val['Niveau'];

					echo "<td>$matiere</td>";
			}

	echo "</tr>\n";
	mysqli_stmt_close($stmt);
	$result -> free();
	//$bdd -> close();
}

/**
 * Fournit la liste des fournitures dans un tableau en fonction du prof
 * @param $bdd objet msqli
 * @return Array
*/
function suppliesTeacherList($bdd)
{
	$id_Prof = $_SESSION['id_Prof'];

	$query1= "SELECT id_Fourniture FROM choisir  WHERE id_Personne = ?";
	$query2= "SELECT Quantite FROM contenir  WHERE id_Fourniture = ?";
	$query3= "SELECT Libelle FROM fourniture  WHERE id_Fourniture = ?";

	$stmt = $bdd->prepare($query1);
	$stmt->bind_param("s",$val1);
	$val1 = $id_Prof;
	$stmt->execute();
	$result = $stmt -> get_result();
	$row = $result -> fetch_all();

	for($i = 0; $i < count($row); ++$i) {
		$id_Fourniture = $row[$i][0];

		$stmt = $bdd->prepare($query2);
		$stmt->bind_param("i",$val1);
		$val1 = $id_Fourniture;
		$stmt->execute();
		$result = $stmt -> get_result();

		while ($val = $result -> fetch_assoc())

			{
					$quantite = $val['Quantite'];

					echo "<tr>";

					echo "<td>$quantite</td>";
			}

			$stmt = $bdd->prepare($query3);
			$stmt->bind_param("i",$val1);
			$val1 = $id_Fourniture;
			$stmt->execute();
			$result = $stmt -> get_result();

			while ($val = $result -> fetch_assoc())

				{
						$libelle = $val['Libelle'];

						echo "<td>$libelle</td>";
				}
	}
	echo "</tr>\n";
	mysqli_stmt_close($stmt);
	$result -> free();
	//$bdd -> close();
}

/**
 * Fournit la liste utilisateurs dans un tableau
 * @param $bdd
 * @return Array
*/
function usersList($bdd)
{

	$req = "SELECT id_Personne, Nom, Prenom, login FROM personne";

	$requete = $bdd->prepare($req);
	$requete->execute();
	$result = $requete -> get_result();

	while ($val = $result -> fetch_assoc())

		{
				$id = $val['id_Personne'];
				$nom = $val['Nom'];
				$prenom = $val['Prenom'];
				$login = $val['login'];

				echo "<tr>";

				echo "<td>$id</td>";
				echo "<td>$nom</td>";
				echo "<td>$prenom</td>";
				echo "<td>$login</td>";

				echo "</tr>\n";

		}


		$result -> free();
		$bdd -> close();
}

/**
 * Transforme une date au format français jj/mm/aaaa vers le format anglais aaaa-mm-jj
 * @param $date au format  jj/mm/aaaa
 * @return string la date au format anglais aaaa-mm-jj
*/
function convertirDateFrancaisVersAnglais($date){
	@list($jour,$mois,$annee) = explode('/',$date);
	return date("Y-m-d", mktime(0, 0, 0, $mois, $jour, $annee));
}

/**
 * Transforme une date au format format anglais aaaa-mm-jj vers le format
 * français jj/mm/aaaa
 * @param $date au format  aaaa-mm-jj
 * @return string la date au format format français jj/mm/aaaa
*/
function convertirDateAnglaisVersFrancais($date)
{
    @list($annee,$mois,$jour) = explode('-',$date);
	return date("d/m/Y", mktime(0, 0, 0, $mois, $jour, $annee));
}


function estUtilisateurConnecte()
{
    return isset($_SESSION["login"]);
}

 function verifConnecte()
 {
 	if(! estUtilisateurConnecte())
 	{
 		header("location:./index.php");
 	}
 	else
 	{

 	}
 }
?>
