<?php

/**
 * user actions.
 *
 * @package    balloon
 * @subpackage user
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
  /**
   * Executes edit action
   *
   * @param sfRequest $request A request object
   */
  public function executeEdit(sfWebRequest $request)
  {
    $user = $this->getUser()->getGuardUser();
    $form = new SimpleUserForm($user);
    
    if("POST" == $request->getMethod()){
      $form->bind($request->getPostParameter($form->getName()), $request->getFiles($form->getName()));
      if($form->isValid()){
        $form->save();
        $this->redirect('@user_edit');
      }
    }
    $this->form = $form;
  }
}
