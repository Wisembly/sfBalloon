<?php

/**
 * wall actions.
 *
 * @package    balloon
 * @subpackage wall
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class wallActions extends sfActions
{
  /**
   * Executes show action
   *
   * @param sfWebRequest $request A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    $event = $request->getParameter('event');
    $wall = $request->getParameter('wall');
  }
}
