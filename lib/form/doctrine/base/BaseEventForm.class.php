<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'short'             => new sfWidgetFormInputText(),
      'short_description' => new sfWidgetFormInputText(),
      'landing_html'      => new sfWidgetFormInputText(),
      'logo'              => new sfWidgetFormInputText(),
      'password'          => new sfWidgetFormInputText(),
      'lang'              => new sfWidgetFormInputText(),
      'redirect'          => new sfWidgetFormInputCheckbox(),
      'has_custom_css'    => new sfWidgetFormInputCheckbox(),
      'wall_count'        => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'deleted_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 150)),
      'short'             => new sfValidatorString(array('max_length' => 20)),
      'short_description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'landing_html'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'logo'              => new sfValidatorString(array('max_length' => 255)),
      'password'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lang'              => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'redirect'          => new sfValidatorBoolean(array('required' => false)),
      'has_custom_css'    => new sfValidatorBoolean(array('required' => false)),
      'wall_count'        => new sfValidatorInteger(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'deleted_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Event', 'column' => array('short')))
    );

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

}
