<?php

/**
 * PollChoice form base class.
 *
 * @method PollChoice getObject() Returns the current form's model object
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePollChoiceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'quote_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quote'), 'add_empty' => false)),
      'choice_value' => new sfWidgetFormInputText(),
      'votes_count'  => new sfWidgetFormInputText(),
      'deleted_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'quote_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Quote'))),
      'choice_value' => new sfValidatorString(array('max_length' => 150)),
      'votes_count'  => new sfValidatorInteger(array('required' => false)),
      'deleted_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('poll_choice[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PollChoice';
  }

}
