<?php

class event extends api
{
  protected function Reserve()
  {

  }

  protected function add_event($target=null, $data=null, $target_group=null)
  {
    if($target && $data && $target_group){
      $sql = "INSERT INTO events (target,data,target_group) VALUES (:target,:data,:target_group)";
      $sql_params = [
        ':target' => $target,
        ':data' => json_encode($data, true),
        ':target_group' => $target_group
      ];
      db::Query($sql, $sql_params);
    }
  }

  protected function get_events($target=null, $target_group=null)
  {
    if($target && $target_group){
      $sql = "SELECT * FROM events WHERE target=:target AND target_group=:target_group";
      $sql_params = ['target' => $target, ':target_group' => $target_group];
      $res = db::Query($sql, $sql_params);
      return $res;
    }
    return false;
  }

}
