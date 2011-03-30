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
    
    $this->getContext()->getConfiguration()->loadHelpers('Partial');
    
    $news  = array();
    
    $cans = array(
      'can_fav_quote' => $this->getUser('fav_quote', $this->wall),
      'can_validate_moderating_quote' => $this->getUser('validate_moderating_quote', $this->wall),
      'can_remove_quote' => $this->getUser('remove_quote', $this->wall),
      'can_update_moderating_quote' => $this->getUser('update_moderating_quote', $this->wall),
      'can_une_quote'  => $this->getUser('une_quote', $this->wall),
      'can_view_vote_quote' => $this->getUser('view_quote_nb_vote', $this->wall),
      'can_answer_quote'    => $this->getUser('answer_quote', $this->wall)
    );
    
    foreach($data['news'] as $quote){
      $currentUserVotes = $this->getUser()->getVotesOnWall($quote->getId());
      $news[] = get_partial('quote/quote', array(
        'votes'   => $currentUserVotes,
        'wall'    => $quote->getWall(), 
        'quote'   => $quote, 
        'eventId' => $quote->getWall()->getEvent()->getShort()
        ) + $cans);
    }
    
    $data['news'] = $news;
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
