<?php

function can($user, $action, $object){
  if(!$user->isAuthenticated()){
    return false; 
  }
  return $user->getGuardUser()->can($action, $object);
}