<?php

class myUser extends Tokenisable
{
	
	public function can($action, $object)
	{
	  if(!$this->isAuthenticated()){
	    return false;
	  }
	  
	  return $this->getGuardUser()->can($action, $object);
	}
	
  public function vote(Quote $quote)
  {
    if($this->hasAlreadyVote($quote)){
      return false;
    }
    
    $vote = new Vote();
    if($this->isAuthenticated()){
      $vote->setUser($this->getGuardUser());
    }else{
      $vote->setToken($this->getToken());
    }

    $vote->setQuote($quote);
    $vote->save();
  }
  
  /**
   * getVotesOnWall get a list of quoteIds voted by an user on a wall 
   *
   * @param Quotes, a list a quotesId 
   * @return array
   * @author Clément JOBEILI
   */
  public function getVotesOnWall($quotes)
  {
    $userOrToken = $this->getToken();
    if($this->isAuthenticated()){
      $userOrToken = $this->getGuardUser()->getId();
    }
    
    $quoteModels = array('PollAnswer', 'Vote');
    $votes = array();
    
    foreach($quoteModels as $model){
      $votes = array_merge($votes, Doctrine::getTable($model)->findVotesByWallAndUser($quotes, $userOrToken));
    }
    return $votes;
  }
  
  public function hasAlreadyVote(Quote $quote, $isPoll = false)
  {
    $userOrToken = $this->getToken();
    if($this->isAuthenticated()){
      $userOrToken = $this->getGuardUser()->getId();
    }
    
    $model = ($isPoll) ? 'PollAnswer' : 'Vote';
    
    return (Doctrine::getTable($model)->existsByQuoteAndUserOrToken($quote->getId(), $userOrToken));
  }
}
