<?php


class QuoteTable extends Doctrine_Table
{
  
  protected function sanitizeSort($sort)
  {
    if($sort == "top"){
      return "votes_count";
    }
    return "created_at";
  }

  public function getQuotesQuery($wall, $sort)
  {

    return $this->createQuery('q')
                ->orderBy('q.' . $this->sanitizeSort($sort) . ' DESC')
                ->leftJoin('q.User u')
                ->leftJoin('q.PollChoices pc')
                ->where('q.wall_id = ?', $wall);
  }
  
  public function getModeratedQuotesForWall($wall, $sort)
  {
    return $this->getQuotesQuery($wall, $sort)
                ->andWhere('q.is_validated = ?', false)
                ->execute();
  }
  
  public function getPublishedQuotesForWall($wall, $sort)
  {
    return $this->getQuotesQuery($wall, $sort)
                ->leftJoin('pc.Answers a')
                ->andWhere('q.is_validated = ?', true)
                ->execute();
  }
}