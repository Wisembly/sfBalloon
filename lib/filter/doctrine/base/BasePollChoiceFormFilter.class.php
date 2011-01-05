<?php

/**
 * PollChoice filter form base class.
 *
 * @package    balloon
 * @subpackage filter
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
abstract class BasePollChoiceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'quote_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quote'), 'add_empty' => true)),
      'choice_value' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'votes_count'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'quote_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Quote'), 'column' => 'id')),
      'choice_value' => new sfValidatorPass(array('required' => false)),
      'votes_count'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('poll_choice_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PollChoice';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'quote_id'     => 'ForeignKey',
      'choice_value' => 'Text',
      'votes_count'  => 'Number',
    );
  }
}
