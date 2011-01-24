<?php


class QuoteTable extends Doctrine_Table
{
  
  public function getQuotesQuery($wall)
  {
    return $this->createQuery('q')
                ->where('q.wall_id = ?', $wall);
  }
  
  public function getModeratedQuotesForWall($wall)
  {
    return $this->getQuotesQuery($wall)
                ->andWhere('q.is_validated = ?', false)
                ->execute();
  }
  
  public function getPublishedQuotesForWall($wall)
  {
    return $this->getQuotesQuery($wall)
                ->andWhere('q.is_validated = ?', true)
                ->execute();
  }
}