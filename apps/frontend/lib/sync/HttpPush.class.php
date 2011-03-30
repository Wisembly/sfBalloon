<?php

class HttpPush
{
  protected $latency;
  protected $delay;
  
  public function __construct($latency, $delay)
  {
    $this->latency  = $latency;
    $this->delay    = $delay;
  }
  
  public function poll($clientUpdater, $wall, $date)
  {
    $modifs = $clientUpdater->hasNewContent($wall, $date);
    while($modifs){
      usleep(10000);
      $modifs = $clientUpdater->hasNewContent($wall, $date);
    }
  }
}