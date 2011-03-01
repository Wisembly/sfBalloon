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
  /**
   * Executes show action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $this->wallId   = $request->getParameter('wall');
    
    $this->wall = Doctrine::getTable('Wall')->findByShort($this->wallId);

    $this->forward404Unless($this->wall);
    
    if(!$this->wall->isAvailable()){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }
    
    $sort = $request->getParameter('sort');
    
    $this->moderatedQuotes  = Doctrine::getTable('Quote')->getModeratedQuotesForWall($this->wall->getId(), $sort);
    $this->publishedQuotes  = Doctrine::getTable('Quote')->getPublishedQuotesForWall($this->wall->getId(), $sort);
    
    $this->menu = new WallTabMenu(array('event' => $this->eventId, 'wall' => $this->wallId));

    $quote = new Quote();
    $quote->setWall($this->wall);
    
    if($this->getUser()->can('add_survey', $this->wall) && $this->wall->supports('poll')){
        $this->form = new SimpleSurveyForm($quote);  
    }else{
        $this->form = new SimpleQuoteForm($quote);
    }
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

    $this->wall = Doctrine::getTable('Wall')->findByShort($this->wallId);
    
    $this->forward404Unless($this->wall);
    
    if(!$this->wall->isAvailable() || !$this->getUser()->can('update', $this->wall)){
      $this->redirect(sprintf('@event?short=%s', $this->eventId));
    }

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
}