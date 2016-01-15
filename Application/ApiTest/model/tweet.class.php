<?php

class tweet extends basemodel
{
  public static function getParent($id)
  {
    $connection = new dbconnection();
    $sql = "select parent from jabaianb.tweet where id='".$id."'";
    $res = $connection->doQuery($sql);
    return ($res === false) ? false : $res;
  }

  public static function getLike($id)
  {
    $connection = new dbconnection();
    $sql = "select count(*) from jabaianb.vote where tweet='".$id."'";
    $res = $connection->doQuery($sql);
    return ($res === false) ? false : $res;
  }
}