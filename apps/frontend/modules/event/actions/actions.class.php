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
    $this->isAllowed = true;
    $this->form = null;
    
    if($this->event->isProtected()){
      $this->isAllowed = $this->getUser()->getAttribute('isAllowedOn' .$this->event->getShort());
      if(!$this->isAllowed){
        $this->form = new EventPasswordCheckerForm(null, array('event_password' => $this->event->getPassword()));
        if($request->isMethod('post')) {
          $this->form->bind($request->getParameter('password'));
        	if($this->form->isValid()) {
        	  $this->getUser()->setAttribute('isAllowedOn' .$this->event->getShort(), true);
        	  $this->isAllowed = true;
      		}
        }
      }
    }
    
    if($this->event->getWallCount() == 1){
      $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->event->getShort(), $this->event->Walls[0]->getShort()));
    }
  }
}