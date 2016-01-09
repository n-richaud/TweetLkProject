 <div class="row">

      <div class="col s12 m4 l3 z-depth-3">
      <?php 
       $avatar=$context->data['user']['avatar'];
       if((strpos($context->data['user']['avatar'], 'http') === true && !filter_var($context->data['user']['avatar'], FILTER_VALIDATE_URL) !== false) || !file_exists($context->data['user']['avatar'])) 
                          {
                            $avatar= '././images/avatar-default.png';
                          }
                          else
                           $avatar= $context->data['user']['avatar'] ;
                            ?>
        <img width="150" height="150" class="circle responsive-img" src="<?php echo $avatar ?>" </br></br>
	       <?php echo "Nom    : "; echo $context->data['user']['nom']." " ?> <?php echo $context->data['user']['prenom'] ?> </br> 
	       <?php echo "Statut : "; echo $context->data['user']['statut'] ?> </br>

      </div>

       <div class="col s12 m4 l6 push-l1"> <ul class="collection with-header z-depth-3">
      <ul>
       <li class="collection-header "><h4>Tweets de <?php echo $context->data['user']['prenom'] ?> </h4></li>
  <?php $datatweet=$context->data['tweet'];
	 	foreach ($datatweet as $key => $tweet) {
	?>
	<?php $tweetpost=tweet::getPost($tweet->post)  ;  $infopost=new post($tweetpost[0]->data);?>
    <li class='collection-item avatar z-depth-2 '>
      <img src="././images/<?php echo $context->data['user']['avatar']; ?>" alt='' class='circle'>
      <span class='title'> Utilisateur <?php echo $tweet->emetteur ?>  a tweeté à  <?php echo $infopost->date ?>  : </span>
      <p><?php echo $infopost->texte  ; ?><br>
         <a href='././ApiTest.php?action=vote&idtweet=<?php echo $tweet->id ; ?>'><i class='material-icons'>thumb_up</i></a> : <?php echo $tweet->nbvotes;?> 
      </p>
      <a href='././ApiTest.php?action=share&idtweet=<?php echo $tweet->id."&parent=".$tweet->emetteur."&post=".$tweet->post ; ?>' class='secondary-content'><i class='material-icons'>input</i></a>
    </li>
  
<?php
}
?>
</ul>
<div class="col s3">
        
      </div>
  </div>

      

</div>





