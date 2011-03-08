<?php


class PollAnswerTable extends Doctrine_Table
{
  
  public function existsByQuoteAndUserOrToken($quote, $userOrToken)
  {
    return $this->createQuery('pa')
                ->where('pa.user_id = ? OR pa.token = ?', array($userOrToken, $userOrToken))
                ->andWhere('pa.quote_id= ?', $quote)
                ->fetchOne();
  }
}