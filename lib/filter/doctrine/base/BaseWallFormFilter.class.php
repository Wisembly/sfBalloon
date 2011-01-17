<?php

/**
 * Wall filter form base class.
 *
 * @package    balloon
 * @subpackage filter
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseWallFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'event_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'add_empty' => true)),
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tw_hashtag'        => new sfWidgetFormFilterInput(),
      'sms_hashtag'       => new sfWidgetFormFilterInput(),
      'last_tweet_id'     => new sfWidgetFormFilterInput(),
      'lang'              => new sfWidgetFormFilterInput(),
      'short_description' => new sfWidgetFormFilterInput(),
      'start'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'stop'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'real_start_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_moderated'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'alaune_quote_id'   => new sfWidgetFormFilterInput(),
      'survey'            => new sfWidgetFormFilterInput(),
      'feedback'          => new sfWidgetFormFilterInput(),
      'has_custom_css'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'short'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'event_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Event'), 'column' => 'id')),
      'name'              => new sfValidatorPass(array('required' => false)),
      'tw_hashtag'        => new sfValidatorPass(array('required' => false)),
      'sms_hashtag'       => new sfValidatorPass(array('required' => false)),
      'last_tweet_id'     => new sfValidatorPass(array('required' => false)),
      'lang'              => new sfValidatorPass(array('required' => false)),
      'short_description' => new sfValidatorPass(array('required' => false)),
      'start'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'stop'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'real_start_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'is_moderated'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'alaune_quote_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'survey'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'feedback'          => new sfValidatorPass(array('required' => false)),
      'has_custom_css'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'short'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wall_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wall';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'event_id'          => 'ForeignKey',
      'name'              => 'Text',
      'tw_hashtag'        => 'Text',
      'sms_hashtag'       => 'Text',
      'last_tweet_id'     => 'Text',
      'lang'              => 'Text',
      'short_description' => 'Text',
      'start'             => 'Date',
      'stop'              => 'Date',
      'real_start_date'   => 'Date',
      'is_moderated'      => 'Boolean',
      'alaune_quote_id'   => 'Number',
      'survey'            => 'Number',
      'feedback'          => 'Text',
      'has_custom_css'    => 'Boolean',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'deleted_at'        => 'Date',
      'short'             => 'Text',
    );
  }
}
