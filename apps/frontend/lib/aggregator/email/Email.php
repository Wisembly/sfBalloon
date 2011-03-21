<?php

class Email
{
  protected $eventCode;
  protected $content;
  protected $to;
  protected $from;

  public function __construct($eventCode, $content, $from, $to)
  {
    $this->eventCode  = $eventCode;
    $this->content    = $content;
    $this->to         = $to;
    $this->from       = $from;
  }
  public function getEventCode()
  {
    return strtolower($this->eventCode);  
  }

  public function getContent()
  {
    return $this->content;
  }

  public function getFrom()
  {
    return $this->from;
  }

  public function getTo()
  {
    return $this->to;
  }
}