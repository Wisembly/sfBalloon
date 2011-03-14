<?php

/**
 * wall actions.
 *
 * @package    balloon
 * @subpackage wall
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class wallActions extends sfActions
{
  
  public function preExecute()
  {
    $this->eventId  = $this->getRequest()->getParameter('event');
    $this->wallId   = $this->getRequest()->getParameter('wall');
    
    $this->event = Doctrine::getTable('Event')->findByShort($this->eventId);
    $this->forward404Unless($this->event);
    
    if($this->event->isProtected() && !$this->getUser()->getAttribute('isAllowedOn' .$this->eventId)){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }
    
    $this->wall = Doctrine::getTable('Wall')->findByShort($this->wallId);

    $this->forward404Unless($this->wall);
    
    if(!$this->wall->isAvailable() && !$this->getUser()->can('view_archive', $this->event)){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }
    
    $this->menu = new WallTabMenu(array('event' => $this->eventId, 'wall' => $this->wallId));

    $quote = new Quote();
    $quote->setWall($this->wall);
    
    if($this->getUser()->can('add_survey', $this->wall) 
      && $this->wall->supports('poll') 
      && $this->wall->getSurveyActived()){
        $this->form = new SimpleSurveyForm($quote);  
    }else{
        $this->form = new SimpleQuoteForm($quote);
    }
    
    // roles
    
    $this->cans = array(
      'can_fav_quote' => $this->getUser('fav_quote', $this->wall),
      'can_validate_moderating_quote' => $this->getUser('validate_moderating_quote', $this->wall),
      'can_remove_quote' => $this->getUser('remove_quote', $this->wall),
      'can_update_moderating_quote' => $this->getUser('update_moderating_quote', $this->wall),
      'can_une_quote'  => $this->getUser('une_quote', $this->wall),
      'can_view_vote_quote' => $this->getUser('view_quote_nb_vote', $this->wall),
      'can_answer_quote'    => $this->getUser('answer_quote', $this->wall)
    );
    
    /*
    Afin de récupérer les votes de l'utilsateur courant, nous devons récupérer les id des quotes sur le wall.
    Nous cherchons ensuite si il a coté pour ces quotes 
    Et pour ses surveys.
    */
    
    $quotesId = Doctrine::getTable('Quote')
        ->getPublishedQuotesForWallQuery($this->wall->getId())->execute(array(), 'id');
    
    $this->currentUserVotes = $this->getUser()->getVotesOnWall($quotesId);
  }
  
  /**
   * Executes show action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    $sort = $request->getParameter('sort');
    
    $nbQuotes = sfConfig::get('app_quotes_number_per_page', 20);
    $numPage = $request->getParameter('page', 1);
    
    $this->pager = new sfDoctrinePager('Quote', $nbQuotes);

    $publishedQuotesQuery  = Doctrine::getTable('Quote')->getPublishedQuotesForWallQuery($this->wall->getId(), $sort);
    
    $this->pager->setQuery($publishedQuotesQuery);
    $this->pager->setPage($numPage);
    $this->pager->init();
    
    $this->moderatedQuotes  = Doctrine::getTable('Quote')->getModeratedQuotesForWall($this->wall->getId(), $sort);
  }

  /**
   * Executes edit action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeEdit(sfWebRequest $request)
  {
    $form = new SimpleWallForm($this->wall);
    if ("POST" === $request->getMethod()) {
      $form->bind($request->getPostParameter($form->getName()), $request->getFiles($form->getName()));

      if ($form->isValid()){
        $event = $form->save();
        $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->eventId, $this->wallId));
      }
    }

    $this->form = $form;

  }
  
  /**
   * Executes answers action
   *
   * @param sfRequest $request A request object
   */
  public function executeAnswers(sfWebRequest $request)
  {
    $this->quotes = Doctrine::getTable('Quote')->getAnsweredQuotesForWall($this->wall->getId());
  }
  
  /**
   * Executes favoris action
   *
   * @param sfRequest $request A request object
   */
  public function executeFavoris(sfWebRequest $request)
  {
    $this->quotes = Doctrine::getTable('Quote')->getFavoriteQuoteForWall($this->wall->getId());
  }
}