<?php


class EventTable extends Doctrine_Table
{
  public function findByShort($short)
  {
    return $this->createQuery('e')->leftJoin('e.Walls w')->where('e.short = ?', $short)->fetchOne();
  }
}