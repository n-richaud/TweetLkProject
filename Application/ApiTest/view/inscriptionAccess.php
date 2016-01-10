<div class="row">
	<div class="col s3"></div>
	<div class="col s12 m4 l2"><p></p></div>
	<div class="col s12 m4 l8"><p><h2>Formulaire d'inscription</h2>
		<form method="post" action="ApiTest.php?action=inscription" enctype="multipart/form-data">
			<p>Veuillez renseigner vos informations personnelles :</p>
			<p><input type="text" name="identifiant" placeholder="Identifiant" required/>
			<input type="password" name="motdepasse" placeholder="Mot de Passe" required/>
			<input type="text" name="nom" placeholder="Nom" required/>
			<input type="text" name="prenom" placeholder="Prénom" required/>
			<input type="text" name="statut" placeholder="Statut" />
			<input type="file" name="avatar" placeholder="Avatar" />
			<button class="light-blue darken-4 btn waves-effect waves-light" type="submit" name="button_action">S'inscrire</button>
			</p>
		</form>
	</div>
    <div class="col s12 m4 l2"><p></p></div>
</div>