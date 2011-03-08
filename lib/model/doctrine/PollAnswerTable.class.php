<?php


class PollAnswerTable extends Doctrine_Table
{
  public function findVotesByWallAndUser($quotes, $userOrToken)
  {
    
    return $this->createQuery('pa')
                ->select('pa.quote_id')
                ->where('pa.user_id = ? OR pa.token = ?', array($userOrToken, $userOrToken))
                ->andWhereNotIn('pa.quote_id', $quotes)
                ->execute(array(), 'id');
  }
  
  public function existsByQuoteAndUserOrToken($quote, $userOrToken)
  {
    return $this->createQuery('pa')
                ->where('pa.user_id = ? OR pa.token = ?', array($userOrToken, $userOrToken))
                ->andWhere('pa.quote_id= ?', $quote)
                ->fetchOne();
  }
}