<!doctype html>
<html lang="fr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>TP02</title>
	<meta name="author" lang="fr" content="Di Malta Tony (uapv1301073), Richaud Nicolas (uapv1604281)" />
	<meta name="description" content="Première page qui permet de supprimer un utilisateur." />
	<link rel="stylesheet" href="style.css" />
	<script src="script.js"></script>
</head>
<body>
	
	<?php
		$db = new PDO('pgsql:host=localhost;dbname=etd;user=uapv1301073;password=afrK0m');
		$txt = 'DELETE FROM jabaianb.utilisateur WHERE id = :i';
		$tmp = $db->prepare($txt);
		$tmp->execute(array("i" => $_POST['id']));
		$text = $db->query('SELECT * FROM jabaianb.utilisateur');
		$url = "/~uapv1301073/TP4/squelette_l3/squelette/login";
		echo "<script type='text/javascript'> window.onload = function () { top.location.href = '".$url."/ajout.php?'; };</script>";
	?>
	
</body>
</html>
