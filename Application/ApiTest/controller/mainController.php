<?php
/*
 * Controller 
 */

class mainController
{
	public static function index($request, $context)
	{
		//$tweets = tweetTable::getTweet();
		return context::SUCCESS;
	}

	public static function inscription($request, $context)
	{
		//print_r($request);
		if(!empty($request['identifiant']) && !empty($request['motdepasse']) && !empty($request['nom']) && !empty($request['prenom'])) {
			$userInfo['identifiant'] = $request['identifiant'];
			$userInfo['pass'] = sha1($request['motdepasse']);
			$userInfo['nom'] = $request['nom'];
			$userInfo['prenom'] = $request['prenom'];
			if(isset($request['statut'])) {
				$userInfo['statut'] = $request['statut'];
			}
			if(isset($request['avatar'])) {
				$userInfo['avatar'] = $request['avatar'];
			}
			$id = utilisateur::save($userInfo);
			if(empty($id)) {
				return context::ERROR;
			}
			$context->setSessionAttribute('is_logged', 1);
			$context->setSessionAttribute('id', $id);
			return context::SUCCESS;
		}
		return context::ACCESS;
	}

	public static function login($request, $context)
	{
		//print_r($request);
		if(!empty($request['user']) && !empty($request['pass'])) {
			$req = utilisateurTable::getUserByLoginAndPass($request['user'], $request['pass']);
			//print_r($req);
			if(!empty($req)) {
				$context->setSessionAttribute('is_logged', 1);
				$context->setSessionAttribute('id', $req[0]['id']);
				context::redirect("././ApiTest.php?action=user");
			}
			return context::ERROR;
		}
		return context::ACCESS;
	}

	public static function logout($request, $context)
	{
		$context->setSessionAttribute('is_logged', 1);
		$context->setSessionAttribute('id', -1);
		context::redirect("././ApiTest.php");
	}

	public static function user($request, $context)
	{
		//print_r($request);
		if(!empty($request['id'])) {
			$user = utilisateurTable::getUserById($request['id']);
			if(empty($user)) {
				return context::ERROR;
			}
			$tweet = new tweetTable;
			$tweet = tweetTable::getTweetsPostedBy($request['id']);
			$data['user'] = $user[0];
			$data['tweet'] = $tweet;
			$context->data = $data;
			if($context->getSessionAttribute('is_logged') == 1 && $request['id'] == $context->getSessionAttribute('id')) {
				return context::SUCCESS;
			} else {
				return context::ACCESS;
			}
		} else if($context->getSessionAttribute('is_logged') == 1) {
			$user = utilisateurTable::getUserById($context->getSessionAttribute('id'));
			$tweet = tweetTable::getTweetsPostedBy($context->getSessionAttribute('id'));
			$data['user'] = $user[0];
			$data['tweet'] = $tweet;
			$context->data = $data;
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function users($request, $context)
	{
		$req = utilisateurTable::getUsers();
		$context->data = $req;
		return context::SUCCESS;
	}

	public static function edituser($request, $context)
	{
		//print_r($request);
		if(!empty($request['edituserform'])) {
			$userInfo['id'] = $context->getSessionAttribute('id');
			$userInfo['pass'] = sha1($request['motdepasse']);
			$userInfo['nom'] = $request['nom'];
			$userInfo['prenom'] = $request['prenom'];
			if(isset($request['statut'])) {
				$userInfo['statut'] = $request['statut'];
			}
			if(isset($request['avatar'])) {
				$userInfo['avatar'] = $request['avatar'];
			}
			$id = utilisateur::save($userInfo);
			return context::SUCCESS;
		}
		return context::ACCESS;
	}

	public static function tweetme($request, $context)
	{
		//print_r($request);
		if(!empty($request['tweetform'])) {
			$image = (empty($request['image']) ? "null" : $request['image']);
			$post['texte'] = $request['text'];
			$post['image'] = $image;
			$post['date'] = date("Y-m-d H:i:s");
			$idpost = post::save($post);
			$tweet['emetteur'] = $context->getSessionAttribute('id');
			$tweet['parent'] = $context->getSessionAttribute('id');
			$tweet['post'] = $idpost;
			$idtweet = tweet::save($tweet);
			//print_r($idtweet);
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function share($request, $context)
	{
		//print_r($request);
		if(!empty($request['idtweet'])) {
			$intweet['parent'] = $request['parent'];
			$intweet['post'] = $request['post'];
			$intweet['emetteur'] = $context->getSessionAttribute('id');
			$tweet = tweet::save($intweet);
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function vote($request, $context)
	{
		//print_r($request);
		if(!empty($request['idtweet']) && $context->getSessionAttribute('is_logged') == 1) {
			$intweet['message'] = $request['idtweet'];
			$intweet['utilisateur'] = $context->getSessionAttribute('id');
			$vote = vote::save($intweet);
			$infotweet['id'] = $request['idtweet'] ;
			$nbvotes = vote::getVote($request['idtweet']);
			//print_r($nbvotes);
			$infotweet['nbvotes'] = $nbvotes[0]['count'];
			$tweet = tweet::save($infotweet);
			context::redirect(history.back());
			return context::SUCCESS;
		}
		return context::ERROR;
	}
}
