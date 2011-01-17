<?php


class WallTable extends Doctrine_Table
{
  public function findByEventQuery($event)
  {
    return $this->createQuery('w')->leftJoin('w.Event e')->where('w.event_id = ?', $event);
  }
}