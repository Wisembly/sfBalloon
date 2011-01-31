<?php


class QuoteTable extends Doctrine_Table
{
  
  public function getQuotesQuery($wall)
  {
    return $this->createQuery('q')
                ->orderBy('q.created_at DESC')
                ->leftJoin('q.User u')
                ->leftJoin('q.PollChoices pc')
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