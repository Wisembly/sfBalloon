<?php

class ClientUpdater
{
  public function getEventsSinceDate($wall, $date)
  {
    // récupere les derniers evenements (Votes + Quotes) depuis cette date.

    $result = array();

    $today = new DateTime();
    $today->setTimestamp((int)$date);
    $d = $today->format('Y-m-d H:i:s');

    $newQuotes      = Doctrine::getTable('Quote')->findNewSinceByWall($d, $wall);
    $updatedQuotes  = Doctrine::getTable('Quote')->findUpdatedSinceByWall($d, $wall);

    $result = array(
      'new'       => $newQuotes->toArray(),
      'update'    => $updatedQuotes->toArray(),
      'timestamp' => time()
    );

    return $result;
  }

  function hasNewContent($wall, $date)
  {
    $today = new DateTime();
    $today->setTimestamp((int)$date);
    $d = $today->format('Y-m-d H:i:s');

    $newQuotes      = Doctrine::getTable('Quote')->findNewSinceByWall($d, $wall);
    $updatedQuotes  = Doctrine::getTable('Quote')->findUpdatedSinceByWall($d, $wall);
    
    return ($newQuotes || $updatedQuotes) ? true: false;
  }
}