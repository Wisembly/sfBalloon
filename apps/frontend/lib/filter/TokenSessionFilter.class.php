<?php

class TokenSessionFilter extends sfFilter 
{
  public function execute($filterChain)
  {
    if ($this->isFirstCall()){
      $user = $this->getContext()->getUser();
      
      $ip = $this->getContext()->getRequest()->getRemoteAddress();
      $info = $this->getContext()->getRequest()->getPathInfoArray();
      $agent = $info['HTTP_USER_AGENT'];
      
      $token = Tokenisable::generate($ip, $agent);
      $user->setToken($token, $this->getContext()->getResponse(), $this->getContext()->getRequest());
    }
    
    $filterChain->execute();
  }
  
}