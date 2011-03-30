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
    $nbLoops = round($this->latency / $this->delay);
    
    $newContent = false;
    
    for ($i = 0; $i < $nbLoops; $i++) {
      $newContent = $clientUpdater->hasNewContent($wall, $date);
      if($newContent) break;
      
      usleep($this->delay * 1000 * 1000);
    }
  }
}