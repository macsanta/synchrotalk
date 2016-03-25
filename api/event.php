<?php

class event extends api
{
  protected function Reserve()
  {

    return
    [
      'design' => 'main/body',
    ];
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

}
