<?php

/**
 * PollChoice form.
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class PollChoiceForm extends BasePollChoiceForm
{
  public function configure()
  {
    $this->useFields(array('choice_value'));
    
    $this->setValidator('choice_value', new sfValidatorString(array('max_length' => 150, 'required' => false)));
    
  }
}
