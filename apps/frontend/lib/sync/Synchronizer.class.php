<?php

class Synchronizer
{
  protected $clientUpdater;
  protected $httpPush;
  
  public function __construct(ClientUpdater $clientUpdater, HttpPush $httpPush)
  {
    $this->clientUpdater  = $clientUpdater;
    $this->httpPush       = $httpPush;
  }
  
  public function synchronize(Wall $wall, $date)
  {
    $this->httpPush->poll($this->clientUpdater, $wall, $date);
    
    return $this->clientUpdater->getEventsSinceDate($wall, $date);
  }
}