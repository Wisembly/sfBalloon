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
    $this->plans = Doctrine::getTable('Offer')->findAll();
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated()) {
      $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
      $this->redirect('@homepage');
    }

    $email = $request->getParameter('email');
    $this->plan = $request->getParameter('plan');
    
    $this->form = $this->createForm($email, $this->plan);
        
    if ($request->isMethod('post')) {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid()) {
        $user = $this->form->save();

        //On envoye un email de confirmation
        $setTo = array($user->getEmailAddress() => $user->getName() );
        $token = sha1($user->getName().$user->getEmailAddress());

        $html = $this->getPartial('sfGuardRegister/confirmation', array('token' => $token));

        //On envoye le mail
        $this->getMailer()->send(new ConfirmationMessage($setTo, '[VotreQuestion.com] Bienvenue', $html));
        
        $invited = Doctrine::getTable('Invitation')->findInvitedByEmail($user->getEmailAddress());
        
        if ($invited) {
          $event = $invited->getEvent();
          $user->addAuth($event, $invited->getGroupId());
          $user->save();
          $invited->delete(); // Delete the invitation.
        }

        if ($this->plan) {
          $this->prepareSave($user, $this->form, $this->plan);
          // Todo : redirect to paypal
        }
        
        $user->setIsActive(false);
        $user->setToken($token);
        $user->save();
        $this->redirect('@homepage');
      }
    }
  }

  protected function createForm($email, $plan = null)
  {
    $form = new RegisterForm();

    $invited= Doctrine::getTable('Invitation')->findInvitedByEmail($email);
    if ($invited) {
        $user = new sfGuardUser();
        $user->setEmailAddress($email);
        $form = new RegisterForm($user);
    }

    if ($plan) {
      $form = new ProRegisterForm();
    }

    return $form;
  }
  
  /**
   * this method will aim to prepare the form,
   * 
   * for example, put the tw_code (strtolower of short) or the start stop date in function of the offer
   *
   * @return void
   * @author Clément JOBEILI
   */
  protected function prepareSave($user, $form, $plan)
  {
    $eventForm = $form->getEmbeddedForm('event');
    $event = $eventForm->getObject();
    $wall = $eventForm->getEmbeddedForm('wall')->getObject();

    $wall->setTwHashtag($event->getShort());
    $wall->setSmsHashtag($event->getShort());
    
    $offer = Doctrine::getTable('Offer')->findOneByName($plan);
    
    $real   = new Datetime($wall->getRealStartDate());
    $real->sub(date_interval_create_from_date_string($offer->getDurationTime().' hours'));
    $wall->setStart($real->format('Y-m-d H:i:s'));
    $real->add(date_interval_create_from_date_string(($offer->getDurationTime()*2).' hours'));
    $wall->setStop($real->format('Y-m-d H:i:s'));
    
    $wall->save();
    $event->setWallCount($event->getWallCount() + 1);
    $event->save();

    $user->addSubscription($offer, $event, $wall);
    $user->addAuth($event); // Administrateur car créateur de l'event
  }

  /**
   *
   * @param <type> $token
   * @return void
   * @author Nicolas PHILIPP
   */
  public function executeConfirm(sfWebRequest $request)
  {
    //Todo : ajouter un champ token dans la base de données
    $token= $request->getParameter('token');
    if(!$token){
        $this->redirect('@homepage');
    }
    $user = Doctrine::getTable("sfGuardUser")->findOneByToken($token);
    if($user){
        $user->setIsActive(true);
        $user->setToken(null);
        $user->save();
        $this->getUser()->signIn($user);
        $this->getUser()->setFlash('notice', 'Votre compte a bien été activé !');
    }
    $this->redirect('@homepage');
  }
}