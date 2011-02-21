<?php

/**
 * StatUser form base class.
 *
 * @method StatUser getObject() Returns the current form's model object
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStatUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'total_quotes'       => new sfWidgetFormInputText(),
      'validated_quotes'   => new sfWidgetFormInputText(),
      'total_votes'        => new sfWidgetFormInputText(),
      'votes_for_quotes'   => new sfWidgetFormInputText(),
      'answered_questions' => new sfWidgetFormInputText(),
      'events_used'        => new sfWidgetFormInputText(),
      'walls_used'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'total_quotes'       => new sfValidatorInteger(array('required' => false)),
      'validated_quotes'   => new sfValidatorInteger(array('required' => false)),
      'total_votes'        => new sfValidatorInteger(array('required' => false)),
      'votes_for_quotes'   => new sfValidatorInteger(array('required' => false)),
      'answered_questions' => new sfValidatorInteger(array('required' => false)),
      'events_used'        => new sfValidatorInteger(array('required' => false)),
      'walls_used'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stat_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'StatUser';
  }

}
