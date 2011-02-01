<?php

/**
 * Voucher form base class.
 *
 * @method Voucher getObject() Returns the current form's model object
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseVoucherForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'offer_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Offer'), 'add_empty' => true)),
      'type'       => new sfWidgetFormInputText(),
      'value'      => new sfWidgetFormInputText(),
      'expired_at' => new sfWidgetFormDateTime(),
      'max_uses'   => new sfWidgetFormInputText(),
      'uses_count' => new sfWidgetFormInputText(),
      'active'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'offer_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Offer'), 'required' => false)),
      'type'       => new sfValidatorInteger(array('required' => false)),
      'value'      => new sfValidatorNumber(array('required' => false)),
      'expired_at' => new sfValidatorDateTime(array('required' => false)),
      'max_uses'   => new sfValidatorInteger(array('required' => false)),
      'uses_count' => new sfValidatorInteger(array('required' => false)),
      'active'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('voucher[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Voucher';
  }

}
