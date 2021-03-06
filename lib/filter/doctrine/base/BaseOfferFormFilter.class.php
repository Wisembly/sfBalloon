<?php

/**
 * Offer filter form base class.
 *
 * @package    balloon
 * @subpackage filter
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
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
      'duration_time'      => new sfWidgetFormFilterInput(),
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
      'duration_time'      => new sfValidatorPass(array('required' => false)),
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
      'duration_time'      => 'Text',
      'forms_allowed'      => 'Boolean',
      'export_allowed'     => 'Boolean',
    );
  }
}
