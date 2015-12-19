<?php

abstract class basemodel
{
 var $data;

 public function __construct($row = NULL)
 {
  $data = array();
  if(!empty($row) && is_array($row))
  {
    foreach($row as $att => $value)
    {
      __set($att, $value);
    }
  }
 }
 
 public function __get($att = NULL)
 {
  return empty($att) ? NULL : $data[$att];
 }

 public function __set($att = NULL, $value = NULL)
 {
  $data[$att] = $value;
 }

 public function save()
 {
    $connection = new dbconnection() ;

    if($this->id)
    {
      $sql = "update jabaianb.".get_class($this)." set " ;

      $set = array() ;
      foreach($this->data as $att => $value)
        if($att != 'id' && $value)
          $set[] = "$att = '".$value."'" ;

      $sql .= implode(",",$set) ;
      $sql .= " where id=".$this->id ;
    }
    else
    {
      $sql = "insert into jabaianb.".get_class($this)." " ;
      $sql .= "(".implode(",",array_keys($this->data)).") " ;
      $sql .= "values ('".implode("','",array_values($this->data))."')" ;
    }

    $connection->doExec($sql) ;
    $id = $connection->getLastInsertId("jabaianb.".get_class($this)) ;

    return $id == false ? NULL : $id ; 
 }

}
