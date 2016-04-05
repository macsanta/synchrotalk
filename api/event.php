<?php

class event extends api
{
  protected function Reserve()
  {
    if(!$this->auth())
      return false;
  }

  private function auth($auth_key)
  {
    if (session_status() !== PHP_SESSION_ACTIVE)
      session_start();

    if(!isset($_SESSION['web_socket_key'])){
      $key_res = db::Query('SELECT `value` FROM config WHERE name = :name',[':name' => 'web_socket_key']);
      $_SESSION['web_socket_key'] = $key_res[0]->value;
    }

    if($auth_key!==null && $auth_key==$_SESSION['web_socket_key'])
      return true;
    else
      return false;
  }

  protected function get_events($target=null, $last_id=null, $auth_key=null)
  {
    if(!$this->auth($auth_key))
      return false;

    if(!$target)
    {
      error_log('Missed Target Group!');
      return false;
    }

    if (session_status() !== PHP_SESSION_ACTIVE)
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
