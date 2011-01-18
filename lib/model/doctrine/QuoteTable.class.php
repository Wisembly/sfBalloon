<?php


class QuoteTable extends Doctrine_Table
{
  public function findAllByWall($wall)
  {
    return $this->createQuery('q')->leftJoin('q.User u')->where('q.wall_id = ?', $wall)->execute();
  }
}