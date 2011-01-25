<?php

function can($user, $action, $object){
  return $user->can($action, $object);
}