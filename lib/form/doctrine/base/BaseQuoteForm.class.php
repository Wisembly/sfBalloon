<?php

/**
 * Quote form base class.
 *
 * @method Quote getObject() Returns the current form's model object
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BaseQuoteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'wall_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Wall'), 'add_empty' => true)),
      'user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'source_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => true)),
      'tw_username'  => new sfWidgetFormInputText(),
      'quote'        => new sfWidgetFormInputText(),
      'votes_count'  => new sfWidgetFormInputText(),
      'has_answer'   => new sfWidgetFormInputCheckbox(),
      'is_validated' => new sfWidgetFormInputCheckbox(),
      'is_poll'      => new sfWidgetFormInputCheckbox(),
      'token'        => new sfWidgetFormInputText(),
      'tweet_id'     => new sfWidgetFormInputText(),
      'is_favori'    => new sfWidgetFormInputCheckbox(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'deleted_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'wall_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Wall'), 'required' => false)),
      'user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'source_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'required' => false)),
      'tw_username'  => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'quote'        => new sfValidatorString(array('max_length' => 255)),
      'votes_count'  => new sfValidatorInteger(array('required' => false)),
      'has_answer'   => new sfValidatorBoolean(array('required' => false)),
      'is_validated' => new sfValidatorBoolean(array('required' => false)),
      'is_poll'      => new sfValidatorBoolean(array('required' => false)),
      'token'        => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'tweet_id'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'is_favori'    => new sfValidatorBoolean(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'deleted_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('quote[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Quote';
  }

}
