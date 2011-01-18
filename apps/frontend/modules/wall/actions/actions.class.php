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
    
    $this->wall = Doctrine::getTable('Wall')->findByShortWithQuotes($this->wallId);
    $quote = new Quote();
    $quote->setWall($this->wall);
    $this->form   = new SimpleQuoteForm($quote);
  }
  
  /**
   * Executes vote action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeVote(sfWebRequest $request)
  {
    
  }
}