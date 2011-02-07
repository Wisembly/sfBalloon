<?php

/**
 * Offer filter form base class.
 *
 * @package    balloon
 * @subpackage filter
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseOfferFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price'              => new sfWidgetFormFilterInput(),
      'sms_allowed'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tw_allowed'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'widget_allowed'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'email_allowed'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'moderation_allowed' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'polls_allowed'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'duration_time'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'forms_allowed'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'export_allowed'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'name'               => new sfValidatorPass(array('required' => false)),
      'price'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sms_allowed'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tw_allowed'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'widget_allowed'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'email_allowed'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'moderation_allowed' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'polls_allowed'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'duration_time'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'forms_allowed'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'export_allowed'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('offer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Offer';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'name'               => 'Text',
      'price'              => 'Number',
      'sms_allowed'        => 'Boolean',
      'tw_allowed'         => 'Boolean',
      'widget_allowed'     => 'Boolean',
      'email_allowed'      => 'Boolean',
      'moderation_allowed' => 'Boolean',
      'polls_allowed'      => 'Boolean',
      'duration_time'      => 'Date',
      'forms_allowed'      => 'Boolean',
      'export_allowed'     => 'Boolean',
    );
  }
}
