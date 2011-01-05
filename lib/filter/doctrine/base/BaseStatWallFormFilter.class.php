<?php

/**
 * StatWall filter form base class.
 *
 * @package    balloon
 * @subpackage filter
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseStatWallFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'wall_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Wall'), 'add_empty' => true)),
      'total_questions'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'validated_questions' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'total_votes'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'max_connceted_users' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'wall_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Wall'), 'column' => 'id')),
      'total_questions'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'validated_questions' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total_votes'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_connceted_users' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('stat_wall_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatWall';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'wall_id'             => 'ForeignKey',
      'total_questions'     => 'Number',
      'validated_questions' => 'Number',
      'total_votes'         => 'Number',
      'max_connceted_users' => 'Number',
    );
  }
}
