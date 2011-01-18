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
   * Executes create action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->event  = $request->getParameter('event');
    $this->wall   = $request->getParameter('wall');
    $user = $this->getUser();
    
    $wall = Doctrine::getTable('Wall')->findByShort($this->wall);
    $quote = new Quote();
    
    if($user->isAuthenticated()){
      $quote->setUser($user->getGuardUser());
    }else{
      $quote->setToken($user->getToken());
    }
    
    //$quote->setSource(Source::find($request));
    $quote->setWall($wall);
    
    $form = new SimpleQuoteForm($quote);
    
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    
    if ($form->isValid()){
      $quote = $form->save();
      $this->redirect(sprintf('@wall?event=%s&wall=%s', $this->event, $this->wall));
    }
    
    $this->form = $form;
    $this->setTemplate('show', 'wall');
  }
}
