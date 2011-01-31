<?php

/**
 * Quote filter form base class.
 *
 * @package    balloon
 * @subpackage filter
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseQuoteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'wall_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Wall'), 'add_empty' => true)),
      'user_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'source_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => true)),
      'tw_username'    => new sfWidgetFormFilterInput(),
      'quote'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'votes_count'    => new sfWidgetFormFilterInput(),
      'has_answer'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_validated'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_poll'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'token'          => new sfWidgetFormFilterInput(),
      'tweet_id'       => new sfWidgetFormFilterInput(),
      'is_favori'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'poll_duration'  => new sfWidgetFormFilterInput(),
      'is_poll_active' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'wall_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Wall'), 'column' => 'id')),
      'user_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'source_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Source'), 'column' => 'id')),
      'tw_username'    => new sfValidatorPass(array('required' => false)),
      'quote'          => new sfValidatorPass(array('required' => false)),
      'votes_count'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'has_answer'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_validated'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_poll'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'token'          => new sfValidatorPass(array('required' => false)),
      'tweet_id'       => new sfValidatorPass(array('required' => false)),
      'is_favori'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'poll_duration'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_poll_active' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('quote_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Quote';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'wall_id'        => 'ForeignKey',
      'user_id'        => 'ForeignKey',
      'source_id'      => 'ForeignKey',
      'tw_username'    => 'Text',
      'quote'          => 'Text',
      'votes_count'    => 'Number',
      'has_answer'     => 'Boolean',
      'is_validated'   => 'Boolean',
      'is_poll'        => 'Boolean',
      'token'          => 'Text',
      'tweet_id'       => 'Text',
      'is_favori'      => 'Boolean',
      'poll_duration'  => 'Number',
      'is_poll_active' => 'Boolean',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'deleted_at'     => 'Date',
    );
  }
}
