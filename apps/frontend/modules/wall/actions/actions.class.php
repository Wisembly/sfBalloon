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
    
    if(!$this->getUser()->getAttribute('isAllowedOn' .$this->eventId)){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }
    $this->wall = Doctrine::getTable('Wall')->findByShort($this->wallId);

    $this->forward404Unless($this->wall);
    
    if(!$this->wall->isAvailable()){
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
  }
  
  /**
   * Executes show action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    $sort = $request->getParameter('sort');
    
    $this->moderatedQuotes  = Doctrine::getTable('Quote')->getModeratedQuotesForWall($this->wall->getId(), $sort);
    $this->publishedQuotes  = Doctrine::getTable('Quote')->getPublishedQuotesForWall($this->wall->getId(), $sort);
    
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