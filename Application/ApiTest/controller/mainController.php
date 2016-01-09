<?php
/*
 * Controller 
 */


class mainController
{
	public static function index($request, $context)
	{
		//$tweets = new tweetTable;
		//$tweets = tweetTable::getTweet();
		return context::SUCCESS;
	}

	public static function inscription($request, $context)
	{
		print_r($request);
		if(!empty($request['identifiant'])&&!empty($request['motdepasse'])&&!empty($request['nom'])) {
			$userInfo['identifiant'] = $request['identifiant'];
			$userInfo['pass'] = sha1($request['motdepasse']);
			$userInfo['nom'] = $request['nom'];
			$userInfo['prenom'] = $request['prenom'];
			$userInfo['statut'] = $request['statut'];
			if (isset($request['avatar'])) {
				$userInfo['avatar'] = $request['avatar'];
			}
			
			$user = new utilisateur($userInfo);
			$id = $user->save();
			if(empty($id))
				return context::ERROR;
			$_SESSION['is_logged'] = 1;
			$_SESSION['id'] = $id;
			return context::SUCCESS;
		}
		return context::ACCESS;
	}

	public static function login($request, $context)
	{
		if(!empty($request['user']) && !empty($request['pass'])) {

			$req = new utilisateurTable;
			$req = utilisateurTable::getUserByLoginAndPass($request['user'], $request['pass']);
			//print_r($req);
			if(!empty($req)) {
				$_SESSION['is_logged'] = 1;
				$_SESSION['id'] = $req[0]['id'];
				context::redirect("././ApiTest.php?action=user");
			}
			return context::ERROR;
		}
		return context::ACCESS;
	}

	public static function logout($request, $context)
	{
		$_SESSION['is_logged'] = 0;
		$_SESSION['id'] = -1;
		context::redirect("././ApiTest.php");
	}

	public static function user($request, $context)
	{
		if(!empty($request['id'])) {
			$user = new utilisateurTable;
			$user = utilisateurTable::getUserById($request['id']);
			if(empty($user)) {
				return context::ERROR;
			}
			$tweet = new tweetTable;
			$tweet = tweetTable::getTweetsPostedBy($request['id']);
			$data['user'] = $user[0];
			$data['tweet'] = $tweet;
			$context->data = $data;
			
			if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] && $request['id'] == $_SESSION['id']) 
				return context::SUCCESS;
			else
				return context::ACCESS;
		} else if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == 1) {
			$user = new utilisateur;
			$user = utilisateurTable::getUserById($_SESSION['id']);
			$tweet = new tweetTable;
			$tweet = tweetTable::getTweetsPostedBy($_SESSION['id']);
			$data['user'] = $user[0];
			$data['tweet'] = $tweet;
			$context->data = $data;
				return context::SUCCESS;	
		} else {
			return context::ERROR;
		}
	}

	public static function users($request, $context)
	{
		
		$req = new utilisateurTable;
		$req = utilisateurTable::getUsers();
		$context->data = $req;
		return context::SUCCESS;
	}

	public static function tweetView($request, $context)
	{
		return context::SUCCESS;
	}

	public static function edituser($request, $context)
	{
		if(isset($request['edituserform'])) {
			print_r($request);

			$userInfo['id'] = $_SESSION['id'];
			$userInfo['pass'] = sha1($request['motdepasse']);
			$userInfo['nom'] = $request['nom'];
			$userInfo['prenom'] = $request['prenom'];
			$userInfo['statut'] = $request['statut'];
			if (isset($request['avatar'])) {
				$userInfo['avatar'] = $request['avatar'];
			}
			
			$user = new utilisateur($userInfo);
			$id = $user->save();
			return context::SUCCESS;
		}
		return context::ACCESS;
	}

	public static function tweetme($request, $context)
	{
		if(isset($request['tweetform'])) {
			$image = (!isset($request['image']) ? "null" : $request['image']);
			$post['texte'] = $request['text'];
			$post['image'] = $image;
			$timestamp = new DateTime();
			$post['date'] = $timestamp->format("Y-m-d H:i:s");
			$posttext = new post($post);
			$idpost = $posttext->save();
			
			$tweet['emetteur'] = $_SESSION['id'];
			$tweet['parent'] = $_SESSION['id'];
			$tweet['post'] = $idpost;
			$postmytweet = new tweet($tweet);
			$idtweet = $postmytweet->save(); 
			echo $idtweet;
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function share($request, $context)
	{
		if(!empty($request['idtweet'])) {
			
			$intweet['parent'] = $request['parent'];
			$intweet['post'] = $request['post'];
			$intweet['emetteur'] = $_SESSION['id'];
			$tweet = new tweet($intweet);
			$tweet->save();

			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function vote($request, $context)
	{
		if(!empty($request['idtweet']) && $_SESSION['is_logged'] == 1) {
			$intweet['message'] = $request['idtweet'];
			$intweet['utilisateur'] = $_SESSION['id']; 
			

			$vote = new vote($intweet);
			$vote->save();
			
			$infotweet['id']= $request['idtweet'] ;
			$nbvotes = new vote() ;
			$nbvotes = vote::getVote($request['idtweet']);
			print_r($nbvotes);
			$infotweet['nbvotes']=$nbvotes[0]['count'];
			$tweet = new tweet($infotweet); 
			$tweet->save();

			return context::SUCCESS;
		}
		return context::ERROR;
	}
}
