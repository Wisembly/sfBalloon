<?php

/**
 * PollAnswer form base class.
 *
 * @method PollAnswer getObject() Returns the current form's model object
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePollAnswerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'choice_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Choice'), 'add_empty' => false)),
      'quote_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quote'), 'add_empty' => false)),
      'source_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => true)),
      'user_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'token'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'choice_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Choice'))),
      'quote_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Quote'))),
      'source_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'required' => false)),
      'user_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'token'     => new sfValidatorString(array('max_length' => 40)),
    ));

    $this->widgetSchema->setNameFormat('poll_answer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PollAnswer';
  }

}
