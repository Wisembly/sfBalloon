<?php

/**
 * StatUser filter form base class.
 *
 * @package    balloon
 * @subpackage filter
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseStatUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'total_quotes'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'validated_quotes'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total_votes'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'votes_for_quotes'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'answered_questions' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'events_used'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'walls_used'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'total_quotes'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'validated_quotes'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total_votes'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'votes_for_quotes'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'answered_questions' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'events_used'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'walls_used'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('stat_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatUser';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'user_id'            => 'ForeignKey',
      'total_quotes'       => 'Number',
      'validated_quotes'   => 'Number',
      'total_votes'        => 'Number',
      'votes_for_quotes'   => 'Number',
      'answered_questions' => 'Number',
      'events_used'        => 'Number',
      'walls_used'         => 'Number',
    );
  }
}
