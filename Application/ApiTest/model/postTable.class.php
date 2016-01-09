<?php

class postTable
{
  public static function getPostbyId($id)
  {
    $connection = new dbconnection() ;
    $salt = "48@!alsd" ;
    $sql = "select * from jabaianb.post where id='".$id."'" ;

    $res = $connection->doQueryObject( $sql ) ;
    
    if($res === false)
      return false ;

    return $res ;
  }

  
  
}
