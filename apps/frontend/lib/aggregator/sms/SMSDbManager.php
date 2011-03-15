<?php

class SMSDbManager
{
  public function findOneEvent($eventCode)
  {
    return Doctrine::getTable('Event')->findByShort(strtolower($eventCode));
  }
  
  public function findAvailableWallForEventId($eventId)
  {
    $today = new DateTime();
    $today = $today->format('Y-m-d h:i:s');
    
    return Doctrine::getTable('Wall')->findByEventQuery($eventId)
            ->andWhere('w.start <= ?', $today)
            ->andWhere('w.stop > ?', $today)
            ->execute();
  }

  public function addQuote($from, $content, $wall)
  {
    $quote = new Quote();
    $quote->setQuote($content);
    $quote->setSourceId(Source::$SMS);
    $quote->setToken($from);
    $quote->setWallId($wall);
    $quote->save();
  }

  public function findAvailableSurvey($wall)
  {
    return Doctrine::getTable('Quote')->getAvailableSurveys($wall);
  }

  public function userHasAlreadyVote($user, $quote)
  {
    return Doctrine::getTable('PollAnswer')->existsByQuoteAndUserOrToken($quote, $user);
  }

  public function voteOnQuote($user, $choice, $quote)
  {
    $choices = $quote->getPollChoices();
    $trueChoice = $choices->get($choice);

    $pollAnswer = new PollAnswer();
    $pollAnswer->setQuote($quote);
    $pollAnswer->setChoice($trueChoice);
    $pollAnswer->setToken($user);
    $pollAnswer->setSourceId(Source::$SMS);
    $pollAnswer->save();
  }
}