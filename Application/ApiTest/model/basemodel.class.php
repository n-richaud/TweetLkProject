<?php

abstract class basemodel
{
  public function __construct($row = NULL)
  {
    $this->data = array();
    if(!empty($row) && is_array($row)) {
      foreach($row as $att => $value) {
        $this->data[$att] = $value;
      }
    }
  }

  public function __get($att)
  {
    return empty($att) ? NULL : $this->data[$att];
  }

  public function __set($att, $value)
  {
    $this->data[$att] = $value;
  }

  public function save()
  {
    $connection = new dbconnection();
    if(isset($this->data["id"])) {
      $sql = "update jabaianb.".get_class($this)." set ";
      $set = array();
      foreach($this->data as $att => $value) {
        if($att != 'id' && $value) {
          $set[] = "$att = '".$value."'";
        }
      }
      $sql .= implode(",", $set);
      $sql .= " where id=".$this->id;
    } else {
      $sql = "insert into jabaianb.".get_class($this)." ";
      $sql .= "(".implode(",",array_keys($this->data)).") ";
      $sql .= "values ('".implode("','",array_values($this->data))."')";
    }
    //print_r($sql);
    $connection->doExec($sql);
    $id = $connection->getLastInsertId("jabaianb.".get_class($this));
    //print_r($id);
    return $id == false ? NULL : $id;
  }
}