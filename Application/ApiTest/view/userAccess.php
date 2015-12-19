 <div class="row">

      <div class="col s12 m4 l3 z-depth-3">
        <img width="150" height="150" class="circle responsive-img" src="<?php echo $context->data['user']['avatar'] ?>" </br></br>
	       <?php echo "Nom    : "; echo $context->data['user']['nom']." " ?> <?php echo $context->data['user']['prenom'] ?> </br> 
	       <?php echo "Statut : "; echo $context->data['user']['statut'] ?> </br>

      </div>

       <div class="col s12 m4 l6 push-l1"> <ul class="collection with-header z-depth-3">
      <ul>
       <li class="collection-header "><h4>Tweets de <?php echo $context->data['user']['prenom'] ?> </h4></li>
  <?php $datatweet=$context->data['tweet'];
	 	foreach ($datatweet as $key => $tweet) {
	?>
	
    <li class='collection-item avatar  '>
      <img src="././images/<?php echo $context->data['user']['avatar']; ?>" alt='' class='circle'>
      <span class='title'> Utilisateur <?php echo $tweet->emetteur ?>  a tweeté à <?php echo tweet::getPost($tweet->post)[0]['date'] ?> : </span>
      <p><?php  echo tweet::getPost($tweet->post)[0]['texte']  ; ?><br>
         <a href='././ApiTest.php?action=vote&idtweet=<?php echo $tweet->id ; ?>'><i class='material-icons'>thumb_up</i></a> : <?php echo $tweet->nbvotes;?> 
      </p>
      <a href='././ApiTest.php?action=share&idtweet=<?php echo $tweet->id ; ?>' class='secondary-content'><i class='material-icons'>input</i></a>
    </li>
    
  
<?php
}
?>
</ul>
<div class="col s3">
        
      </div>
  </div>

      

</div>





