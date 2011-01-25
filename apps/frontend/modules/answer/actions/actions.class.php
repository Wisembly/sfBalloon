<?php

/**
 * answer actions.
 *
 * @package    balloon
 * @subpackage answer
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class answerActions extends sfActions
{
  /**
   * Executes create action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $this->wallId   = $request->getParameter('wall');
    $this->quoteId   = $request->getParameter('quote');
    
    $quote  = Doctrine::getTable('Quote')->find($this->quoteId);
    $wall   = Doctrine::getTable('Wall')->findByShort($this->wallId);
    
    $this->forward404Unless($quote && $this->getUser()->can('answer_quote', $wall));
    
    $this->quote  = $quote;
    $this->wall   = $wall;
    
    $answer = new Answer();
    $answer->setQuote($quote);
    $answer->setUser($this->getUser()->getGuardUser());
    $form = new SimpleAnswerForm($answer);
    
    if($request->getMethod() == "POST"){
      $form->bind($request->getPostParameter($form->getName()), $request->getFiles($form->getName()));

      if ($form->isValid()){
        $answer = $form->save();
        $this->redirect(sprintf('@quote_answer?event=%s&wall=%s&quote=%s', $this->eventId, $this->wallId, $quote->getId()));
      }
    }
  }
}
