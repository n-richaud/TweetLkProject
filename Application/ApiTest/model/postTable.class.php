<?php

class postTable
{
  public static function getPostbyId($id)
  {
    $connection = new dbconnection();
    $sql = "select * from jabaianb.post where id='".$id."'";
    $res = $connection->doQueryObject($sql, "post");
    return ($res === false) ? false : $res;
  }
}