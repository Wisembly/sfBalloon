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
   * Executes favorite action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeFavorite(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $this->wallId   = $request->getParameter('wall');
    $this->quoteId   = $request->getParameter('quote');
    
    $quote = Doctrine::getTable('Quote')->find($this->quoteId);
    $wall = Doctrine::getTable('Wall')->findByShort($this->wallId);

    $this->forward404Unless($quote);
    if($this->getUser()->can('fav_quote', $wall)){
      $quote->setIsFavori(!$quote->getIsFavori());
      $quote->save();  
    }

    $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->eventId, $this->wallId));
  }

  /**
   * Executes alaune action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeAlaune(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $this->wallId   = $request->getParameter('wall');
    $this->quoteId   = $request->getParameter('quote');
    
    $quote = Doctrine::getTable('Quote')->find($this->quoteId);
    $wall = Doctrine::getTable('Wall')->findByShort($this->wallId);

    $this->forward404Unless($quote && $wall);
    
    if($this->getUser()->can('une_quote', $wall)){
      $wall->setAlauneQuoteId($quote->getId());
      $wall->save();
    }
    
    $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->eventId, $this->wallId));
  }
  
  /**
   * Executes create action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $this->wallId   = $request->getParameter('wall');
    $user = $this->getUser();
    
    $wall = Doctrine::getTable('Wall')->findByShort($this->wallId);
    
    if(!$wall->isAvailable()){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }
    
    $quote = new Quote();
    
    $this->menu = new WallTabMenu();
    $this->menu->setEvent($this->eventId);
    $this->menu->setWall($this->wallId);
    
    if($user->isAuthenticated()){
      $quote->setUser($user->getGuardUser());
    }else{
      $quote->setToken($user->getToken());
    }
    
    $this->moderatedQuotes  = Doctrine::getTable('Quote')->getModeratedQuotesForWall($wall->getId());
    $this->publishedQuotes  = Doctrine::getTable('Quote')->getPublishedQuotesForWall($wall->getId());
    
    //$quote->setSource(Source::find($request));
    
    if(!$wall->isModerated() && $wall->supports('moderation')){
      $quote->setIsValidated(true);
    }
    
    $quote->setWall($wall);
    
    if($this->getUser()->can('add_survey', $wall) && $wall->supports('poll')){
      $quote->setIsPoll(true);
      $form = new SimpleSurveyForm($quote);
    }else{
        $form = new SimpleQuoteForm($quote);
    }
    
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    
    if ($form->isValid()){
      $quote = $form->save();
      if($quote->isSurvey()){ // Si la quote est un sondage.
        $wall->setAlauneQuoteId($quote->getId());
        $wall->save();
      }
      $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->eventId, $this->wallId));
    }
    
    $this->form = $form;
    $this->wall = $wall;
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

    if(!$wall->isAvailable()){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }

    if($wall->supports('moderation')){
      $this->forward404Unless($quote && $this->getUser()->can('validate_moderating_quote', $wall));
      $quote->validate();  
    }
    
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

    if(!$wall->isAvailable()){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }

    $this->forward404Unless($quote && $this->getUser()->can('remove_quote', $wall));

    $quote->delete();
    $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->eventId, $this->wallId));
  }
  
  
  /**
   * Executes edit action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $this->wallId   = $request->getParameter('wall');
    $this->quoteId   = $request->getParameter('quote');
    
    $quote  = Doctrine::getTable('Quote')->find($this->quoteId);
    $wall   = Doctrine::getTable('Wall')->findByShort($this->wallId);
    
    if(!$wall->isAvailable()){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }

    $this->forward404Unless($quote && $this->getUser()->can('update_moderating_quote', $wall));
    
    $form = new SimpleQuoteForm($quote);
    
    if($request->getMethod() == "POST"){
      $form->bind($request->getPostParameter($form->getName()), $request->getFiles($form->getName()));

      if ($form->isValid()){
        $quote = $form->save();
        $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->eventId, $this->wallId));
      }
    }
    
    $this->form = $form;
  }
  
  /**
   * Executes answer action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeAnswer(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $this->wallId   = $request->getParameter('wall');
    $this->quoteId   = $request->getParameter('quote');
    
    $quote  = Doctrine::getTable('Quote')->find($this->quoteId);
    $wall   = Doctrine::getTable('Wall')->findByShort($this->wallId);
    
    if(!$wall->isAvailable()){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }
    
    $this->quote  = $quote;
    $this->wall   = $wall;
    
    $answer = new Answer();
    $answer->setQuote($quote);
    $this->form = new SimpleAnswerForm($answer);
  }
}
