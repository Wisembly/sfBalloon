<?php


class QuoteTable extends Doctrine_Table
{
  
  protected function sanitizeSort($sort = null)
  {
    if($sort == "top"){
      return "votes_count";
    }
    return "created_at";
  }

  public function getQuotesQuery($wall, $sort = null)
  {

    return $this->createQuery('q')
                ->orderBy('q.' . $this->sanitizeSort($sort) . ' DESC')
                ->leftJoin('q.User u')
                ->leftJoin('q.PollChoices pc')
                ->where('q.wall_id = ?', $wall);
  }

  public function getModeratedQuotesForWall($wall, $sort = null)
  {
    return $this->getQuotesQuery($wall, $sort)
                ->andWhere('q.is_validated = ?', false)
                ->execute();
  }
  
  public function getPublishedQuotesForWall($wall, $sort = null)
  {
    return $this->getQuotesQuery($wall, $sort)
                ->leftJoin('pc.Answers a')
                ->andWhere('q.is_validated = ?', true)
                ->execute();
  }
  
  public function getAnsweredQuotesForWall($wall)
  {
    return $this->getQuotesQuery($wall, null)
                ->leftJoin('q.Answers a')
                  ->leftJoin('a.User us')
                ->andWhere('q.is_validated = ?', true)
                ->andWhere('q.has_answer = ?', true)
                ->execute();
  }
}