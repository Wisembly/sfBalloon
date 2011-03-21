<?php

class NoResponse
{
  protected $status;

  public function __construct($status = null)
  {
    $this->status = $status;
  }

  public function __toString()
  {
    return ;
  }

  public function getStatus()
  {
    return $this->status;
  }
}