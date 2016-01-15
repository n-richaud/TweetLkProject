<?php

class utilisateurTable
{
  public static function getUserByLoginAndPass($login,$pass)
  {
    $connection = new dbconnection();
    $sql = "select id from jabaianb.utilisateur where identifiant='".$login."' and pass='".sha1($pass)."'";
    $res = $connection->doQuery($sql);
    return ($res === false) ? false : $res;
  }

  public static function getUserById($id)
  {
    $connection = new dbconnection();
    $sql = "select * from jabaianb.utilisateur where id='".$id."'";
    $res = $connection->doQueryObject($sql, "utilisateur");
    return ($res === false) ? false : $res;
  }

  public static function getUsers()
  {
    $connection = new dbconnection();
    $sql = "select * from jabaianb.utilisateur";
    $res = $connection->doQueryObject($sql, "utilisateurTable");
    return ($res === false) ? false : $res;
  }
}