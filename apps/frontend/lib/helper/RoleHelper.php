<?php

function can($user, $action, $object){
  if($object instanceof sfOutputEscaperIteratorDecorator){
    $object = $object->getRawValue();
  }
  return $user->can($action, $object);
}