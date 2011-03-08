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
    
    if($this->event->isProtected() && !$this->getUser()->can('view', $this->event)){
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
  
  /**
   * Executes edit action
   *
   * @param sfRequest $request A request object
   */
  public function executeEdit(sfWebRequest $request)
  {
    $eventShort = $request->getParameter('short');
    $this->event = Doctrine::getTable('Event')->findByShort($eventShort);

    $this->forward404Unless($this->event);
      
    if(!$this->getUser()->can('update', $this->event)){
      $this->redirect('@event?short='.$eventShort);
    }
    
    $form = new SimpleEventForm($this->event);
    
    if($request->getMethod() == "POST"){
      $form->bind($request->getPostParameter($form->getName()), $request->getFiles($form->getName()));

      if ($form->isValid()){
        $event = $form->save();
        $this->redirect('@event?short='.$eventShort);
      }
    }
    
    $this->form = $form;
  }

  /**
   * Executes wall action
   *
   * @param sfRequest $request A request object
   */
  public function executeWall(sfWebRequest $request)
  {
    $eventShort = $request->getParameter('short');
    $this->event = Doctrine::getTable('Event')->findByShort($eventShort);

    $form = new AddWallForm();

    if(!$this->getUser()->can('add_wall', $this->event)){
      $this->redirect('@event?short='.$eventShort);
    }
    if($request->getMethod() == "POST"){
      $form->bind($request->getPostParameter($form->getName()), $request->getFiles($form->getName()));

      if($form->isValid()){
        $values = $form->getValues();
        $offer = Doctrine::getTable('Offer')->find($values['offer']);
        $wall = new Wall();
        $wall->setName($values['wall']['name']);
        $wall->setRealStartDate($values['wall']['real_start_date']);
        $wall->save();
        $this->getUser()->getGuardUser()->addSubscription($offer, $this->event, $wall);
        $this->redirect('@event?short='.$eventShort);
      }
    }
    $this->form = $form;
  }
}
