<?php

/**
 * StatWall form base class.
 *
 * @method StatWall getObject() Returns the current form's model object
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStatWallForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'wall_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Wall'), 'add_empty' => false)),
      'total_questions'     => new sfWidgetFormInputText(),
      'validated_questions' => new sfWidgetFormInputText(),
      'total_votes'         => new sfWidgetFormInputText(),
      'max_connceted_users' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'wall_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Wall'))),
      'total_questions'     => new sfValidatorInteger(array('required' => false)),
      'validated_questions' => new sfValidatorInteger(array('required' => false)),
      'total_votes'         => new sfValidatorInteger(array('required' => false)),
      'max_connceted_users' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stat_wall[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatWall';
  }

}
