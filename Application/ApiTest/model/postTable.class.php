<?php

class postTable
{
  public static function getPostbyId($id)
  {
    $connection = new dbconnection();
    $sql = "select * from jabaianb.post where id='".$id."'";
    $res = $connection->doQueryObject($sql, "postTable");
    return ($res === false) ? false : $res;
  }
}