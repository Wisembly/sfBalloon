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
      $vote->setUser($this);
    }else{
      $vote->setToken($this->getToken());
    }

    $vote->setQuote($quote);
    $vote->save();
  }
  
  public function hasAlreadyVote(Quote $quote)
  {
    $userOrToken = $this->getToken();
    if($this->isAuthenticated()){
      $userOrToken = $this->getGuardUser()->getId();
    }
    
    return (Doctrine::getTable('Vote')->existsByQuoteAndUserOrToken($quote->getId(), $userOrToken));
  }
}
