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
    $event = $this->getRequest()->getParameter('event');
    $this->forward404Unless($event);
    
    $this->event = Doctrine::getTable('Event')->find($event);
    $this->forward404Unless($this->event);
  }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $query = Doctrine::getTable('Wall')->findByEventQuery($this->event->getId());
    
    $this->pager = new sfDoctrinePager('Wall', 10);
    $this->pager->setQuery($query);
		$this->pager->setPage($request->getParameter('page', 1));
		$this->pager->init();
  }
  
  /**
   * Executes new action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeNew(sfWebRequest $request)
  {
    $wall = new Wall();
    $wall->setEvent($this->event);
    $this->form = new WallForm($wall);
  }
  
  /**
   * Executes create action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new WallForm();
    $this->processForm($request, $this->form);
    
    $this->setTemplate('new');
  }
  
  /**
   * Executes update action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->wall = Doctrine::getTable('Wall')->find($request->getParameter('id'));
    $this->form = new WallForm($this->wall);
    $this->processForm($request, $this->form);
    
    $this->setTemplate('edit');
  }
  
  /**
   * Executes edit action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->wall = Doctrine::getTable('Wall')->find($request->getParameter('id'));
    $this->form = new WallForm($this->wall);
  }  
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $wall = Doctrine::getTable('Wall')->find($request->getParameter('id'));
    $wall->delete();
    $this->redirect('@wall?event='.$this->event->getId());
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $wall = $form->save();

      $this->redirect('@wall_edit?event='.$this->event->getId().'&id='.$wall->getId());
    }
  }
}
