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
	$row = $requete->fetch();
	$_SESSION['type'] = 0;

	if ( isset($row) ){
		$_SESSION['type'] = 1;
	}
	else if ($row == null) {
		$requete = $bdd->prepare($req2);
		$resultat = $requete->execute();
		$row = $requete->fetch();

		if ( isset($row) ){
			$_SESSION['type'] = 2;
		}
		else if ($row == null) {
			$requete = $bdd->prepare($req3);
			$resultat = $requete->execute();
			$row = $requete->fetch();

			if ( isset($row) ){
				$_SESSION['type'] = 3;
			}
		}
	}
}

/**
 * Fournit la liste des enfants et les informations les concernant dans un tableau
 * @param $bdd objet PDO
 * @return Array
*/
function studiesList($bdd)
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
 * Fournit la liste des enfants et les informations les concernant dans un tableau
 * @param $bdd objet PDO
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

function listeManifestation(PDO $bdd, $domaine)
{

	$req = "SELECT * FROM manifestation";

	$requete = $bdd->prepare($req);
	$requete->execute();
	$i=0;

	while ($val = $requete -> fetch(PDO::FETCH_ASSOC))

		{
			$id = $val['idM'];
			$date = $val['dateM'];
			$nom = $val['libM'];
			$date = convertirDateAnglaisVersFrancais($date);

			echo "<tr>";
			echo "<td width=\"35%\" bgcolor=\"#F8F8FF\" align=center>$nom</td>";
			echo "<td width=\"35%\"bgcolor=\"#F8F8FF\" align=center>$date</td>";

			echo "<td bgcolor=\"#F8F8FF\" align=center><a href=\"modif.php?id=$id\"><img src=\"images/Modifier.png\" alt=\"Supprimer la manifestation\" id=\"icone_action\" /></a></td>";
			echo "<td bgcolor=\"#F8F8FF\" align=center><a href=\"gestion_participants.php?id=$id\"><img src=\"images/Ajouter.png\" title=\"Ajouter des participants\" id=\"icone_action\" /></a></td>";
			echo "<td bgcolor=\"#F8F8FF\" align=center><a href=\"include/suppr.php?id=$id\" onclick=\"return confirm('Voulez-vous vraiment suprimer cette manifestation ?');\"><img src=\"images/Supprimer.png\" title=\"Supprimer la manifestation\" id=\"icone_action\" /></a></td>";

			echo "</tr>\n";

			$i++;
		}


	$requete -> closeCursor();
	$bdd= NULL;
}

function listeParticipantsP(PDO $bdd)
{

	$req = "SELECT IdP, NomP, PrenomP FROM parent";
	$requete = $bdd->prepare($req);
	$requete->execute();

	$i=0;

		while ($val = $requete -> fetch(PDO::FETCH_ASSOC))

		{
				$nom = $val['NomP'];
				$prenom = $val['PrenomP'];

				echo "<tr>";
				echo "<td width=\"42%\" bgcolor=\"#F8F8FF\" align=center>$nom</td>";
				echo "<td width=\"42%\" bgcolor=\"#F8F8FF\" align=center>$prenom</td>";

				echo "<td width=\"16%\"bgcolor=\"#F8F8FF\" align=center><input type='checkbox' name='participe[]' value='1'/></td>";

				echo "</tr>\n";

				$i++;
		}

		$requete -> closeCursor();
		$bdd= NULL;
}

function listeParticipantsE(PDO $bdd)
{

	$req = "SELECT idE, NomE, PrenomE FROM enfant";
	$requete = $bdd->prepare($req);
	$requete->execute();

	$i=0;

		while ($val = $requete -> fetch(PDO::FETCH_ASSOC))

		{
				$nom = $val['NomE'];
				$prenom = $val['PrenomE'];

				echo "<tr>";
				echo "<td width=\"42%\" bgcolor=\"#F8F8FF\" align=center>$nom</td>";
				echo "<td width=\"42%\" bgcolor=\"#F8F8FF\" align=center>$prenom</td>";

				echo "<td width=\"16%\" bgcolor=\"#F8F8FF\" align=center><input type='checkbox' name='participe[$nom]' value='$prenom'/></td>";

				echo "</tr>\n";

				$i++;
		}

		$requete -> closeCursor();
		$bdd= NULL;
}


function VerifAbsence (PDO $bdd)
{
	try
	{
		foreach($_POST['choix'] AS $key => $value)
		{
			if ($value == 'A')
			{
				connexionDB();

				$req = "INSERT INTO ABSENCE VALUES ('', CURDATE(), $key)";

				$requete = $bdd->prepare($req);
				$requete->execute();
			}
		}
	}

	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

	echo "<script> window.location='../modules.php';</script>";


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
