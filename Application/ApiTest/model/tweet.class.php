<?php

class tweet extends basemodel
{
  public static function getParent($id)
  {
    $connection = new dbconnection();
    $sql = "select parent from jabaianb.tweet where id='".$id."'";
    $res = $connection->doQueryObject($sql, "tweet");
    return ($res === false) ? false : $res;
  }

  public static function getLike($id)
  {
    $connection = new dbconnection();
    $sql = "select COUNT(*) from jabaianb.vote where tweet='".$id."'";
    $res = $connection->doQueryObject($sql, "tweet");
    return ($res === false) ? false : $res;
  }
}