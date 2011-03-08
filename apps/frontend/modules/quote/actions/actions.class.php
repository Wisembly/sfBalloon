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
    $this->event = Doctrine::getTable('Event')->findByShort($this->eventId);
    
    if(!$wall->isAvailable()){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }
    
    $quote = new Quote();
    
    $this->menu = new WallTabMenu(array('event' => $this->eventId, 'wall' => $this->wallId));
    
    if($user->isAuthenticated()){
      $quote->setUser($user->getGuardUser());
    }else{
      $quote->setToken($user->getToken());
    }
    
    $this->moderatedQuotes  = Doctrine::getTable('Quote')->getModeratedQuotesForWall($wall->getId());
    
    $nbQuotes = sfConfig::get('app_quotes_number_per_page', 20);
    $numPage = $request->getParameter('page', 1);
    
    $this->pager = new sfDoctrinePager('Quote', $nbQuotes);
    
    $sort = $request->getParameter('sort');

    $publishedQuotesQuery  = Doctrine::getTable('Quote')->getPublishedQuotesForWallQuery($wall->getId(), $sort);
    $this->pager->setQuery($publishedQuotesQuery);
    $this->pager->setPage($numPage);
    $this->pager->init();
    
    /*
    Afin de récupérer les votes de l'utilsateur courant, nous devons récupérer les id des quotes sur le wall.
    Nous cherchons ensuite si il a coté pour ces quotes 
    Et pour ses surveys.
    */
    $quotesId = Doctrine::getTable('Quote')
        ->getPublishedQuotesForWallQuery($wall->getId(), $sort)->execute(array(), 'id');
    
    $this->currentUserVotes = $this->getUser()->getVotesOnWall($quotesId);
    
    //$quote->setSource(Source::find($request));
    
    if(!$wall->isModerated() && $wall->supports('moderation')){
      $quote->setIsValidated(true);
    }
    
    if($this->getUser()->can('add_survey', $wall)){
      $quote->setIsValidated(true);
    }
    
    $quote->setWall($wall);
    
    if($this->getUser()->can('add_survey', $this->wall) 
      && $wall->supports('poll') 
      && $wall->getSurveyActived()){
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
    
    $this->cans = array(
      'can_fav_quote' => $this->getUser('fav_quote', $this->wall),
      'can_validate_moderating_quote' => $this->getUser('validate_moderating_quote', $this->wall),
      'can_remove_quote' => $this->getUser('remove_quote', $this->wall),
      'can_update_moderating_quote' => $this->getUser('update_moderating_quote', $this->wall),
      'can_une_quote'  => $this->getUser('une_quote', $this->wall),
      'can_view_vote_quote' => $this->getUser('view_quote_nb_vote', $this->wall),
      'can_answer_quote'    => $this->getUser('answer_quote', $this->wall)
    );
    
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
