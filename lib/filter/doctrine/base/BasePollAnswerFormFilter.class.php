<?php

/**
 * PollAnswer filter form base class.
 *
 * @package    balloon
 * @subpackage filter
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePollAnswerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'choice_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Choice'), 'add_empty' => true)),
      'quote_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quote'), 'add_empty' => true)),
      'source_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => true)),
      'user_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'token'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'choice_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Choice'), 'column' => 'id')),
      'quote_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Quote'), 'column' => 'id')),
      'source_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Source'), 'column' => 'id')),
      'user_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'token'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('poll_answer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PollAnswer';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'choice_id' => 'ForeignKey',
      'quote_id'  => 'ForeignKey',
      'source_id' => 'ForeignKey',
      'user_id'   => 'ForeignKey',
      'token'     => 'Text',
    );
  }
}
