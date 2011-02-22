<?php

/**
 * invitation actions.
 *
 * @package    balloon
 * @subpackage invitation
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class invitationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

    $this->eventId  = $request->getParameter('event');
    $event = Doctrine::getTable('Event')->findByShort($this->eventId);
    if (!$this->getUser()->can('add_user', $event)) {
      $this->redirect('@event?short='. $this->eventId);
    }
    $invitation = new Invitation();
    $invitation->setEvent($event);
    $this->form = new SimpleInvitationForm($invitation);  
    
  }
  
  /**
   * Executes create action
   *
   * @param sfRequest $request A request object
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->eventId  = $request->getParameter('event');
    $event = Doctrine::getTable('Event')->findByShort($this->eventId);

    if (!$this->getUser()->can('add_user', $event)) {
      $this->redirect('@event?short='. $this->eventId);
    }

    $form = new SimpleInvitationForm();
    $params = $request->getParameter($form->getName());

    $html = $this->getPartial('invitation/confirmation', array('email' => $params['email']));

    //On envoye le mail
    $this->getMailer()->send(new ConfirmationMessage($params['email'], '[VotreQuestion.com] Bienvenue', $html));
    
    $user = Doctrine::getTable('sfGuardUser')->retrieveByUsernameOrEmailAddress($params['email']);
    if($user){
      $user->addAuth($event, $params['group_id']);
      $this->redirect(sprintf('@invitation?event=%s', $this->eventId));
    }else{
      $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
      if ($form->isValid()){
        $invitation = $form->save();
        // SEND EMAIL !!!!!!!!!! !!!! !!!!! !!!
        $this->redirect(sprintf('@invitation?event=%s', $this->eventId));
      }
    }
    
    $this->form = $form;
    $this->setTemplate('index');
  }
}
