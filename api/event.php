<?php

class event extends api
{
  protected function Reserve()
  {
    if(!$this->auth())
      return false;
  }

  private function auth()
  {
    if (session_status() !== PHP_SESSION_ACTIVE)
      session_start();
    if(isset($_SESSION['websocket_server_key']) && $_SESSION['websocket_server_key']=='25a5858ad47ece3efc83ad58aa12ff79')
      return true;
    else
      return false;
  }

  protected function get_events($target=null, $last_id=null)
  {
    if(!$this->auth())
      return false;

    if(!$target)
    {
      error_log('Missed Target Group!');
      return false;
    }
    session_start();
    $sql = "SELECT * FROM events WHERE target=:target AND id > :last_id";
    $sql_params = [':target' => $target, ':last_id' => $last_id];
    $events = db::Query($sql, $sql_params);
    foreach ($events->__2array() as &$event){
      $event['data'] = json_decode($event['data'], true);
    }
    return [
      'data' => [
        'events' => $events,
      ],
    ];
  }


}
