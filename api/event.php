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
    if($this->get_client_ip()==$_SERVER['SERVER_ADDR'])
      return true;
    else
      return false;
  }

  private function get_client_ip()
  {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
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
