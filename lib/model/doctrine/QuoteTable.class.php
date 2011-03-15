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
                ->leftJoin('q.Answers qa')
                ->leftJoin('q.PollChoices pc')
                ->where('q.wall_id = ?', $wall);
  }

  public function getModeratedQuotesForWallQuery($wall, $sort = null)
  {
    return $this->getQuotesQuery($wall, $sort)
                ->andWhere('q.is_validated = ?', false);
  }
  
  public function getModeratedQuotesForWall($wall, $sort = null)
  {
    return $this->getModeratedQuotesForWallQuery($wall, $sort)->execute();
  }
  
  public function getPublishedQuotesForWallQuery($wall, $sort = null)
  {
    return $this->getQuotesQuery($wall, $sort)
                ->leftJoin('pc.Answers a')
                ->andWhere('q.is_validated = ?', true);
  }
  
  public function getPublishedQuotesForWall($wall, $sort = null)
  {
    return $this->getPublishedQuotesForWallQuery($wall, $sort)->execute();
  }
  
  public function getAnsweredQuotesForWallQuery($wall)
  {
    return $this->getQuotesQuery($wall, null)
                ->leftJoin('q.Answers a')
                  ->leftJoin('a.User us')
                ->andWhere('q.is_validated = ?', true)
                ->andWhere('q.has_answer = ?', true);
  }
  
  public function getAnsweredQuotesForWall($wall)
  {
    return $this->getAnsweredQuotesForWallQuery($wall)->execute();
  }
  
  public function getFavoriteQuoteForWallQuery($wall)
  {
    return $this->getQuotesQuery($wall, null)
                ->andWhere('q.is_validated = ?', true)
                ->andWhere('q.is_favori = ?', true);
  }
  
  public function getFavoriteQuoteForWall($wall)
  {
    return $this->getFavoriteQuoteForWallQuery($wall)->execute();
  }

  public function getAvailableSurveys($wall)
  {
    return $this->createQuery('q')
                ->where('q.wall_id = ?', $wall)
                ->andWhere('q.is_poll = ?', true)
                ->andWhere('(DATE_SUB(NOW(), INTERVAL q.poll_duration MINUTE) < q.created_at) ')
                ->execute();
  }
  
}