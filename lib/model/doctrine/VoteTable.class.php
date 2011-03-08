<?php


class VoteTable extends Doctrine_Table
{
  public function findVotesByWallAndUser($quotes, $userOrToken)
  {
    return $this->createQuery('v')
                ->where('v.user_id = ? OR v.token = ?', array($userOrToken, $userOrToken))
                ->andWhereIn('v.quote_id', $quotes)
                ->execute(array(), 'id');
  }
  
  public function existsByQuoteAndUserOrToken($quote, $userOrToken)
  {
    return $this->createQuery('v')
                ->where('v.user_id = ? OR v.token = ?', array($userOrToken, $userOrToken))
                ->andWhere('v.quote_id= ?', $quote)
                ->fetchOne();
  }
}