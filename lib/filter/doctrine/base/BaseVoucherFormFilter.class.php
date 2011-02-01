<?php

/**
 * Voucher filter form base class.
 *
 * @package    balloon
 * @subpackage filter
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseVoucherFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'offer_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Offer'), 'add_empty' => true)),
      'type'       => new sfWidgetFormFilterInput(),
      'value'      => new sfWidgetFormFilterInput(),
      'expired_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'max_uses'   => new sfWidgetFormFilterInput(),
      'uses_count' => new sfWidgetFormFilterInput(),
      'active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'user_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'offer_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Offer'), 'column' => 'id')),
      'type'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'value'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'expired_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'max_uses'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'uses_count' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('voucher_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Voucher';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'user_id'    => 'ForeignKey',
      'offer_id'   => 'ForeignKey',
      'type'       => 'Number',
      'value'      => 'Number',
      'expired_at' => 'Date',
      'max_uses'   => 'Number',
      'uses_count' => 'Number',
      'active'     => 'Boolean',
    );
  }
}
