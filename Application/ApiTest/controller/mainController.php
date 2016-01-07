<?php
/*
 * Controller 
 */

class mainController
{
	public static function index($request, $context)
	{
		return context::SUCCESS;
	}

	public static function inscription($request, $context)
	{
		if(!empty($request['user']) && !empty($request['pass'])) {
			$req = new utilisateurTable;
			$req = utilisateurTable::getUserByLoginAndPass($request['user'], $request['pass']);
			//print_r($req);
			if(!empty($req)) {
				$_SESSION['is_logged'] = 1;
				$_SESSION['id'] = $req[0]['id'];
				return context::SUCCESS;
			}
			return context::ERROR;
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
				return context::SUCCESS;
			}
			return context::ERROR;
		}
		return context::ACCESS;
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

	public static function tweetme($request, $context)
	{
		print_r($request);
		if(!empty($request['tweet'])) {
			$post['text'] = $request['text'];
			$post['image'] = $request['image'];

			$posttext = new post($post['text']);
			$postimage = new post($post['image']);

			$tweet['emetteur'] = $_SESSION['id'];
			$tweet['parent'] = $_SESSION['id'];
			$tweet['post'] = $_SESSION['id'];
			$postmytweet = new tweet($tweet);
			$postmytweet::save; 
			
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function share($request, $context)
	{
		if(!empty($request['idtweet'])) {
			$idtweet['idtweet'] = $request['idtweet'];
			$context->data = $idtweet;
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	public static function vote($request, $context)
	{
		if(!empty($request['idtweet'])) {
			$idtweet['idtweet'] = $request['idtweet'];
			$context->data = $idtweet;
			return context::SUCCESS;
		}
		return context::ERROR;
	}
}
