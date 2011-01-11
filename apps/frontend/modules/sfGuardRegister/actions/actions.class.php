<?php

require_once dirname(__FILE__).'/../lib/BasesfGuardRegisterActions.class.php';

/**
 * sfGuardRegister actions.
 *
 * @package    guard
 * @subpackage sfGuardRegister
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z jwage $
 */
class sfGuardRegisterActions extends BasesfGuardRegisterActions
{
  
  /**
   * Executes plans action
   *
   * @param sfWebRequest $request A request object
   */
  public function executePlans(sfWebRequest $request)
  {
    
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
      $this->redirect('@homepage');
    }
    
    $this->form = new RegisterForm();
    if($request->getParameter('plan')){
      $this->form = new ProRegisterForm();
    }
    
  
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $user = $this->form->save();
        //Hack ! put is_root=true
        $user->setIsRoot(true);die();
        $user->save();
        $this->getUser()->signIn($user);
  
        $this->redirect('@homepage');
      }
    }
  }
}