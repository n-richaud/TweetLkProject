<!doctype html>
<html lang="fr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>TP02</title>
	<meta name="author" lang="fr" content="Di Malta Tony (uapv1301073), Richaud Nicolas (uapv1604281)" />
	<meta name="description" content="Première page qui permet d'enregistrer un utilisateur." />
	<link rel="stylesheet" href="style.css" />
	<script src="script.js"></script>
</head>
<body>
	
	<?php
		$db = new PDO('pgsql:host=localhost;dbname=etd;user=uapv1301073;password=afrK0m');

		if(!empty($_POST['identifiant']) && !empty($_POST['pass']) && !empty($_POST['nom']) && !empty($_POST['prenom']))
		{
			//$salt = "48@!alsd";
			$password_crypte = sha1($_POST['pass']);
			$txt = 'INSERT INTO jabaianb.utilisateur (id, identifiant, pass, nom, prenom, statut, avatar) VALUES (default, :identifiant, :pass, :nom, :prenom, :statut, :avatar)';
			$tmp = $db->prepare($txt);
			$tmp->execute(array("identifiant" => $_POST['identifiant'], "pass" => $password_crypte, "nom" => $_POST['nom'], "prenom" => $_POST['prenom'], "statut" => $_POST['statut'], "avatar" => $_FILES['avatar']['name']));
			$sql = $tmp->fetch();
		}
		$text = $db->query('SELECT * FROM jabaianb.utilisateur');

		$identifiant = $_REQUEST['identifiant'];
		$pass = $_REQUEST['pass'];
		$nom = $_REQUEST['nom'];
		$prenom = $_REQUEST['prenom'];
		$statut = $_REQUEST['statut'];

		if(!empty($prenom) && !empty($nom)) // On teste si le formulaire a été renseigné 
			echo "<p>Ajout de l'utilisateur ".$prenom." ".$nom.".</p>";
		else
			echo "<p>Liste des personnes inscrites via le formulaire.</p>";
		
		if($_FILES['avatar']['error'] > 0) // On teste si l'upload a réussi
			echo "<p>L'avatar n'a pas pu être récupéré.</p>";

		$destination = "images/".$_FILES['avatar']['name'];
		$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$destination); // On déplace le fichier temporaire vers le dossier "images"
	?>

		<table border="1">
		<tbody>
			<tr align='center'>
				<th>
					Supprimer
				</th>
				<th>
					Modifier
				</th>
				<th>
					Nom
				</th>
				<th>
					Prénom
				</th>
				<th>
					Avatar
				</th>
			</tr>
	<?php
		while ($Ligne = $text->fetch())
		{
	?>		<tr>
				<td>
	<?php
				if(!empty($Ligne['id']))
					echo "<form method='post' action='suppr.php?'>
						<p><input type='hidden' name='id' value='".$Ligne['id']."'/>
						<input type='submit' value='Suppr'/></p>
					</form>";
	?>
				</td>
				<td>
	<?php
				if(!empty($Ligne['id']))
					echo "<form method='post' action='modif.php?'>
						<p><input type='hidden' name='id' value='".$Ligne['id']."'/>
						<input type='submit' value='Modif'/></p>
					</form>";
	?>
				</td>
				<td>
	<?php			echo $Ligne['nom'];
	?>			</td>
				<td>
	<?php			echo $Ligne['prenom'];
	?>			</td>
				<td>
	<?php			if(!empty($resultat)) // On teste si l'image a bien été déplacé
					echo "<p><img src='".$destination."' height='250' width='250'></img></p>";
	?>
				</td>
			</tr>
	<?php	} ?>
		</tbody>
		</table>
	
	<p><a href="index.html">Index</a></p>
	
</body>
</html>
