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
    $this->event  = $request->getParameter('event');
    $this->wall   = $request->getParameter('wall');
    
    $wall = Doctrine::getTable('Wall')->findByShort($this->wall);
    $quote = new Quote();
    // $quote->setUser($this->getUser()->getGuardUser())
    $quote->setWall($wall);
    $this->form   = new SimpleQuoteForm($quote);
    
    $this->quotes = Doctrine::getTable('Quote')->findAllByWall($wall->getId()); // Peut être passer par Wall::findByShort
  }
}