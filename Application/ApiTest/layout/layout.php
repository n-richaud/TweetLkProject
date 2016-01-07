<!DOCTYPE html>
<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<!--Import material icon font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.js"></script> 

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title><?php echo $action ?></title>
	</head>

    <body>
		<nav>
			<div class="nav-wrapper blue accent-2">
				<a href="././ApiTest.php" class="brand-logo"><img width="75" height="75" src="././images/pangolin.png"></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="././ApiTest.php">Page d'accueil</a></li>
					<li><a href="ApiTest.php?action=inscription">Inscription</a></li>
					<li><a href="ApiTest.php?action=user">Profil utilisateur</a></li>
					<li><a href="ApiTest.php?action=users">Liste des profils</a></li>
					<li><a href="ApiTest.php?action=login">Login</a></li>
				</ul>
			</div>
		</nav>
		<div class="row"></div>
		<?php include($template_view); ?>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript"> $(document).ready(function(){
			$('.parallax').parallax();
		});</script> 
	</body>
</html>  