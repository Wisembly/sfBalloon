<?php

/**
 * Event form.
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class EventForm extends BaseEventForm
{
  public function configure()
  {
    unset($this['updated_at'], $this['created_at'], $this['deleted_at'], $this['redirect'], $this['wall_count']);
    
    $this->setWidget('landing_html', new sfWidgetFormTextarea());
  }
}
