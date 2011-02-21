<?php

/**
 * Offer form base class.
 *
 * @method Offer getObject() Returns the current form's model object
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOfferForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'name'               => new sfWidgetFormInputText(),
      'price'              => new sfWidgetFormInputText(),
      'sms_allowed'        => new sfWidgetFormInputCheckbox(),
      'tw_allowed'         => new sfWidgetFormInputCheckbox(),
      'widget_allowed'     => new sfWidgetFormInputCheckbox(),
      'email_allowed'      => new sfWidgetFormInputCheckbox(),
      'moderation_allowed' => new sfWidgetFormInputCheckbox(),
      'polls_allowed'      => new sfWidgetFormInputCheckbox(),
      'duration_time'      => new sfWidgetFormTextarea(),
      'forms_allowed'      => new sfWidgetFormInputCheckbox(),
      'export_allowed'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'               => new sfValidatorString(array('max_length' => 150)),
      'price'              => new sfValidatorNumber(array('required' => false)),
      'sms_allowed'        => new sfValidatorBoolean(array('required' => false)),
      'tw_allowed'         => new sfValidatorBoolean(array('required' => false)),
      'widget_allowed'     => new sfValidatorBoolean(array('required' => false)),
      'email_allowed'      => new sfValidatorBoolean(array('required' => false)),
      'moderation_allowed' => new sfValidatorBoolean(array('required' => false)),
      'polls_allowed'      => new sfValidatorBoolean(array('required' => false)),
      'duration_time'      => new sfValidatorString(array('required' => false)),
      'forms_allowed'      => new sfValidatorBoolean(array('required' => false)),
      'export_allowed'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('offer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Offer';
  }

}
