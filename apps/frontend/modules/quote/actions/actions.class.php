<?php

/**
 * quote actions.
 *
 * @package    balloon
 * @subpackage quote
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class quoteActions extends sfActions
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
    
    $quote = Doctrine::getTable('Quote')->find($this->quoteId);
    
    $this->forward404Unless($quote);
    
    $this->getUser()->vote($quote);
    $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->eventId, $this->wallId));
  }
  
  /**
   * Executes create action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->event  = $request->getParameter('event');
    $this->wall   = $request->getParameter('wall');
    $user = $this->getUser();
    
    $wall = Doctrine::getTable('Wall')->findByShort($this->wall);
    $quote = new Quote();
    
    if($user->isAuthenticated()){
      $quote->setUser($user->getGuardUser());
    }else{
      $quote->setToken($user->getToken());
    }
    
    //$quote->setSource(Source::find($request));
    
    if(!$wall->isModerated()){
      $quote->setIsValidated(true);
    }
    
    $quote->setWall($wall);
    
    $form = new SimpleQuoteForm($quote);
    
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    
    if ($form->isValid()){
      $quote = $form->save();
      $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->event, $this->wall));
    }
    
    $this->form = $form;
    $this->setTemplate('show', 'wall');
  }
  
  /**
   * Executes validated action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeValidate(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $this->wallId   = $request->getParameter('wall');
    $this->quoteId   = $request->getParameter('quote');
    
    $quote  = Doctrine::getTable('Quote')->find($this->quoteId);
    $wall   = Doctrine::getTable('Wall')->findByShort($this->wallId);

    $this->forward404Unless($quote && $this->getUser()->can('validate_moderating_quote', $wall));

    $quote->validate();
    $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->eventId, $this->wallId));
  }
  
  /**
   * Executes delete action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeDelete(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $this->wallId   = $request->getParameter('wall');
    $this->quoteId   = $request->getParameter('quote');
    
    $quote  = Doctrine::getTable('Quote')->find($this->quoteId);
    $wall   = Doctrine::getTable('Wall')->findByShort($this->wallId);

    $this->forward404Unless($quote && $this->getUser()->can('remove_quote', $wall));

    $quote->delete();
    $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->eventId, $this->wallId));
  }
}
