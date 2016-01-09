<?php

class vote extends basemodel
{
  
  public static function getVote($id)
  {
    $connection = new dbconnection() ;
    
    $sql = "select COUNT(*) from jabaianb.vote where message='".$id."'" ;

    $res = $connection->doQuery( $sql );
    
    if($res === false)
      return false ;

    return $res ;
  }
 
  
  
}
