<?php

/**
 * event actions.
 *
 * @package    balloon
 * @subpackage event
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class eventActions extends sfActions
{
  /**
   * Executes show action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    $eventShort = $request->getParameter('short');
    $this->event = Doctrine::getTable('Event')->findByShort($eventShort);
    
    $this->forward404Unless($this->event); 
    
    if($this->event->getWallCount() == 1){
      $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->event->getShort(), $this->event->Walls[0]->getShort()));
    }
  }
}
