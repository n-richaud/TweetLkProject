<div class="row">
  <div class="col s12 m4 l3 z-depth-3">
    <div>
    <?php
			echo '
				<img width="150" height="150" class="circle responsive-img" onerror="this.onerror=null;this.src="././images/avatar-default.png;" src="././images/'.$context->data['user']['avatar'].'"></br></br>
				<p>Nom    : '.$context->data['user']['nom'].' '.$context->data['user']['prenom'].'<a href="ApiTest.php?action=edituser"><i class="material-icons">assignment</i></a></p>
				<p>Statut : '.$context->data['user']['statut'].'</p>
			';
		?>
		</div>
  </div>
  <div class="col s12 m4 l7 push-l1 z-depth-5"> 
    <form method="post" action="ApiTest.php?action=tweetme" enctype="multipart/form-data">
		<p><div class="input-field col s6">
      <i class="material-icons prefix">mode_edit</i>
      <textarea placeholder="Nouveau tweet" id="icon_prefix2" name="text" class="materialize-textarea"></textarea>
      <div class="file-field input-field">
	    	<div class="btn light-blue darken-4">
	    		<span>Inclure photo</span>
	    		<input type="file" name="imagepokemon">
	    	</div>
		    <div class="file-path-wrapper">
		    	<input class="file-path validate" type="text">
		   	</div>
	    </div>
		</div></p>
		<button class="light-blue darken-4 btn waves-effect waves-light" type="submit" name="tweetform">Tweeter</button></br>
		</form>
	</div>
  <div class="col s12 m8 l7 push-l1"> <ul class="collection with-header z-depth-5">
  	<ul>
			<li class="collection-header "><h4>Vos tweets</h4></li>
			<?php
				$datatweet = $context->data['tweet'];
		 		foreach($datatweet as $tweet) {
					$tweetpost = tweet::getPost($tweet->post);
					$infopost = new post($tweetpost[0]->data);
					echo '
		    		<li class="collection-item avatar z-depth-2">
	      			<img src="././images/'.$context->data['user']['avatar'].'" alt="" class="circle">
	      			<span class="title">L\'utilisateur n°'.$tweet->emetteur.' a tweeté le '.$infopost->date.' : </span>
	      			<p>'.$infopost->texte.'</br>
	         			<a href="././ApiTest.php?action=vote&idtweet='.$tweet->id.'"><i class="material-icons">thumb_up</i></a> : '.$tweet->nbvotes.'
	      			</p>
		    		</li>
					';
				}
			?>
		</ul>
	</div>
</div>