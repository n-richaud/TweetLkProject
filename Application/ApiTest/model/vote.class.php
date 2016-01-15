<?php

class vote extends basemodel
{
  public static function getVote($id)
  {
    $connection = new dbconnection();
    $sql = "select count(*) from jabaianb.vote where message='".$id."'";
    $res = $connection->doQuery($sql);
    return ($res === false) ? false : $res;
  }
}