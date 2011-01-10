<?php

class myUser extends sfGuardSecurityUser
{
  public function __call($m, $a)
  {
    return call_user_func_array(array($this->getGuardUser(), $m), $a);    
  }
}
