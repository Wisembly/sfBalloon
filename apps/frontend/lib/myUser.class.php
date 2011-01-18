<?php

class myUser extends sfGuardSecurityUser
{
  //public function __call($m, $a)
  //{
  //  //return call_user_func_array(array($this->getGuardUser(), $m), $a);    
  //}
  
  public function setToken($token)
  {
    $this->setAttribute('token', $token);
  }
  
  public function getToken()
  {
    return $this->getAttribute('token');
  }
  
  public function hasToken()
  {
    return ($this->getToken());
  }
}
