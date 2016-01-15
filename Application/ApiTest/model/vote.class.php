<?php

class vote extends basemodel
{
  public static function getVote($id)
  {
    $connection = new dbconnection();
    $sql = "select count(*) from jabaianb.vote where message='".$id."'";
    $res = $connection->doQueryObject($sql, "vote");
    return ($res === false) ? false : $res;
  }
}