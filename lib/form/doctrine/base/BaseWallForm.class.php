<?php

/**
 * Wall form base class.
 *
 * @method Wall getObject() Returns the current form's model object
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWallForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'event_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'add_empty' => true)),
      'name'              => new sfWidgetFormInputText(),
      'tw_hashtag'        => new sfWidgetFormInputText(),
      'sms_hashtag'       => new sfWidgetFormInputText(),
      'last_tweet_id'     => new sfWidgetFormInputText(),
      'lang'              => new sfWidgetFormInputText(),
      'short_description' => new sfWidgetFormInputText(),
      'start'             => new sfWidgetFormDateTime(),
      'stop'              => new sfWidgetFormDateTime(),
      'real_start_date'   => new sfWidgetFormDateTime(),
      'is_moderated'      => new sfWidgetFormInputCheckbox(),
      'alaune_quote_id'   => new sfWidgetFormInputText(),
      'survey_actived'    => new sfWidgetFormInputText(),
      'feedback'          => new sfWidgetFormInputText(),
      'has_custom_css'    => new sfWidgetFormInputCheckbox(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'deleted_at'        => new sfWidgetFormDateTime(),
      'short'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'event_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Event'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 150)),
      'tw_hashtag'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'sms_hashtag'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'last_tweet_id'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'lang'              => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'short_description' => new sfValidatorPass(array('required' => false)),
      'start'             => new sfValidatorDateTime(),
      'stop'              => new sfValidatorDateTime(),
      'real_start_date'   => new sfValidatorDateTime(),
      'is_moderated'      => new sfValidatorBoolean(array('required' => false)),
      'alaune_quote_id'   => new sfValidatorInteger(array('required' => false)),
      'survey_actived'    => new sfValidatorInteger(array('required' => false)),
      'feedback'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'has_custom_css'    => new sfValidatorBoolean(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'deleted_at'        => new sfValidatorDateTime(array('required' => false)),
      'short'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Wall', 'column' => array('short')))
    );

    $this->widgetSchema->setNameFormat('wall[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wall';
  }

}
