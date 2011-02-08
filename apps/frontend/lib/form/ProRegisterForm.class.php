<?php

/**
 * ProRegisterForm for registering new users
 *
 * @package    balloon
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class ProRegisterForm extends sfGuardRegisterForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    unset($this['deleted_at'], $this['is_root']);
    
    $eventForm  = new RegisterEventForm();
    $this->embedForm('event', $eventForm);
  }
}