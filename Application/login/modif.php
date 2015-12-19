<!doctype html>
<html lang="fr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>TP02</title>
	<meta name="author" lang="fr" content="Di Malta Tony (uapv1301073), Richaud Nicolas (uapv1604281)" />
	<meta name="description" content="Première page qui permet de mofidier un utilisateur." />
	<link rel="stylesheet" href="style.css" />
	<script src="script.js"></script>
</head>
<body>
	
	<?php
		$db = new PDO('pgsql:host=localhost;dbname=etd;user=uapv1301073;password=afrK0m');
		
		if(!empty($_POST['pass']) && !empty($_POST['nom']) && !empty($_POST['prenom']))
		{
			if($_FILES['avatar']['error'] > 0) // On teste si l'upload a échoué
			{
				$txt = 'UPDATE jabaianb.utilisateur SET pass = :pass, nom = :nom, prenom = :prenom, statut = :statut WHERE id = '.$_POST['id'];
				$tmp = $db->prepare($txt);
				$tmp->execute(array("pass" => $_POST['pass'], "nom" => $_POST['nom'], "prenom" => $_POST['prenom'], "statut" => $_POST['statut']));
			}
			else
			{
				$txt = 'UPDATE jabaianb.utilisateur SET pass = :pass, nom = :nom, prenom = :prenom, statut = :statut, avatar = :avatar WHERE id = '.$_POST['id'];
				$tmp = $db->prepare($txt);
				$tmp->execute(array("pass" => $_POST['pass'], "nom" => $_POST['nom'], "prenom" => $_POST['prenom'], "statut" => $_POST['statut'], "avatar" => $_FILES['avatar']['name']));
			}
			$sql = $tmp->fetch();
		}
		$aff = "SELECT * FROM jabaianb.utilisateur WHERE id=".$_POST['id'];
		$text = $db->query($aff);

		$Ligne = $text->fetch();
		$id = $Ligne['id'];
		$identifiant = $Ligne['identifiant'];
		$pass = $Ligne['pass'];
		$nom = $Ligne['nom'];
		$prenom = $Ligne['prenom'];
		$statut = $Ligne['statut'];
		$avatar = $Ligne['avatar'];

		if(!empty($prenom) && !empty($nom)) // On teste si le formulaire a été renseigné 
			echo "<p>Modification de l'utilisateur ".$prenom." ".$nom.".</p>";
		else
			echo "<p>Liste des personnes inscrites via le formulaire.</p>";
		
		if($_FILES['avatar']['error'] > 0) // On teste si l'upload a réussi
			echo "<p>L'avatar n'a pas pu être récupéré.</p>";
		
		$destination = "images/".$_FILES['avatar']['name'];
		$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$destination); // On déplace le fichier temporaire vers le dossier "images"
	
	echo "<form method='post' action='modif.php?' enctype='multipart/form-data'>
		<p>Modification :</p>
		<p><input type='hidden' name='id' value='".$id."' />
		<input type='text' name='pass' placeholder='Mot de Passe' />
		<input type='text' name='nom' value='".$nom."' />
		<input type='text' name='prenom' value='".$prenom."' />
		<input type='text' name='statut' value='".$statut."' />
		<input type='file' name='avatar' value='".$avatar."' />
		<p><img src='images/".$avatar."' height='100' width='100'></img></p>
		<input type='submit' value='Modifier' /></p>
	</form>";
	?>

	<p><a href="index.html">Index</a></p>
	
</body>
</html>
