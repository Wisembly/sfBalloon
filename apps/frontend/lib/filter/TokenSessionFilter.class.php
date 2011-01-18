<?php

class TokenSessionFilter extends sfFilter 
{
	
	public function execute($filterChain){

		if ($this->isFirstCall())
		{
			$user = $this->getContext()->getUser();
			
			$ip = $this->getContext()->getRequest()->getRemoteAddress();
			$info = $this->getContext()->getRequest()->getPathInfoArray();
			$agent = $info['HTTP_USER_AGENT'];
			
			if(!$user->hasToken()){
			  $user->setToken(sha1($ip.$agent.time().uniqid())); 
			}
		}

		$filterChain->execute();
	}
	
}