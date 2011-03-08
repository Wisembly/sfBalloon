<?php

class KeyIdHydrator extends Doctrine_Hydrator_Abstract
{
  public function hydrateResultSet($stmt)
  {
    $results = $stmt->fetchAll(Doctrine_Core::FETCH_NUM);
    $array = array();
    
    foreach ($results as $result)
    {
      array_push($array, $result[0]);
    }
    
    return $array;
  }
}