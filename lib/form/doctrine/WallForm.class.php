<?php

/**
 * Wall form.
 *
 * @package    balloon
 * @subpackage form
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class WallForm extends BaseWallForm
{
  public function configure()
  {
    unset($this['last_tweet_id'], $this['created_at'], $this['updated_at']);
    $this->setWidget('event_id', new sfWidgetFormInputHidden());
  }
}
