<?php

/**
 * choice actions.
 *
 * @package    balloon
 * @subpackage choice
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class choiceActions extends sfActions
{
  /**
   * Executes vote action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeVote(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $this->wallId   = $request->getParameter('wall');
    $this->quoteId   = $request->getParameter('quote');
    $user = $this->getUser();
    
    $quote = Doctrine::getTable('Quote')->find($this->quoteId);
    
    $this->forward404Unless($quote);
    
    if($request->isMethod("post")){
      if(!$user->hasAlreadyVote($quote, true)){
        $choiceId = $request->getPostParameter('choice_'.$this->quoteId);
        $choice = Doctrine::getTable('PollChoice')->find($choiceId);

        $pollAnswer = new PollAnswer();
        $pollAnswer->setQuote($quote);
        $pollAnswer->setChoice($choice);
        //$pollAnswer->setSource();

        if($user->isAuthenticated()){
          $pollAnswer->setUser($user->getGuardUser());
        }else{
          $pollAnswer->setToken($user->getToken());
        }

        $pollAnswer->save();
      }
      
    }
    $this->redirect(sprintf("@wall?event=%s&wall=%s", $this->eventId, $this->wallId));
  }
}
