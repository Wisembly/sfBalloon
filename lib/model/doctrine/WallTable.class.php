<?php


class WallTable extends Doctrine_Table
{
  public function findByEventQuery($event)
  {
    return $this->createQuery('w')->leftJoin('w.Event e')->where('w.event_id = ?', $event);
  }
  
  public function findByShortQuery($short)
  {
    return $this->createQuery('w')
                ->leftJoin('w.Event e')
                ->where('w.short = ?', $short);
  }
  
  public function findByShortWithQuotes($short)
  {
    return $this->findByShortQuery($short)
                ->leftJoin('w.Quotes q')
                ->orderBy('q.created_at DESC')
                ->fetchOne();
  }
  
  public function findByShort($short)
  {
    return $this->findByShortQuery($short)
                ->fetchOne();
  }
  
  public function findAvailableWalls()
  {
      $today = new DateTime();
      $today = $today->format('Y-m-d h:i:s');

      return $this->createQuery('w')
              ->where('w.start <= ?', $today)
              ->andWhere('w.stop > ?', $today)
              ->execute();
  }
}