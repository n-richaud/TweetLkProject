<?php

class tweetTable
{
  public static function getTweet()
  {
    $connection = new dbconnection();
    $sql = "select * from jabaianb.tweet";
    $res = $connection->doQueryObject($sql, "tweetTable");
    return ($res === false) ? false : $res;
  }

  public static function getTweetsPostedBy($idUser)
  {
    $connection = new dbconnection();
    $sql = "select * from jabaianb.tweet where emetteur='".$idUser."'";
    $res = $connection->doQueryObject($sql, "tweet");
    return ($res === false) ? false : $res;
  }
}