<?php

/**
 * sync actions.
 *
 * @package    balloon
 * @subpackage sync
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class syncActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeSync(sfWebRequest $request)
  {
    $date = $request->getParameter('timestamp');
    $wall = Doctrine::getTable('Wall')->findByShort($request->getParameter('wall'));
    
    if($wall instanceof Wall){
      $data = $this->getSynchronizer()->synchronize($wall, $date);
    }
    
    echo json_encode($data);
    exit();
  }
  
  /**
   * get the instance of Synchronizer
   *
   * @return Synchronizer
   * @author Clément JOBEILI
   */
  public function getSynchronizer()
  {
    return new Synchronizer(new ClientUpdater(), new HttpPush(10, 0.25));
  }
}
