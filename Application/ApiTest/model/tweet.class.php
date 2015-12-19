<?php

class tweet extends basemodel
{
 

  public static function getPost($id)
  {
    $connection = new dbconnection() ;
    
    $sql = "select * from jabaianb.post where id='".$id."'" ;

    $res = $connection->doQuery( $sql );
    
    if($res === false)
      return false ;

    return $res ;
  }

  public static function getParent($id)
  {
    $connection = new dbconnection() ;

    $sql = "select parent from jabaianb.tweet where id='".$id."'" ;

    $res = $connection->doQuery( $sql );
    
    if($res === false)
      return false ;

    return $res ;

  }

  public static function getLike($id)
  {
    $connection = new dbconnection() ;

    $sql = "select COUNT(*) from jabaianb.vote where tweet='".$id."'" ;

    $res = $connection->doQuery( $sql );
    
    if($res === false)
      return false ;

    return $res ;

  }
}
