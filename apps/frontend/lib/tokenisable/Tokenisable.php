<?php

/**
 * Tokenisable check for session and cookie token.
 *
 * @package    balloon
 * @subpackage class
 * @author     Clément JOBEILI
 * @version    1.0.0
 */
class Tokenisable extends sfGuardSecurityUser
{
  /**
   * generate an uniq token
   *
   * @param string $ip 
   * @param string $agent 
   * @return string
   * @author Clément JOBEILI
   */
  public static function generate($ip, $agent)
  {
    return sha1($ip.$agent.time().uniqid());
  }
  
  /**
   * set the token for session and cookie
   * 
   * if the user has no session/cookie token, then we set this for him
   * if the user has no session token, we check the cookie 
   * and load the cookie token into the session 
   * 
   * if the user has session but no cookie, we set the cookie
   * @param string $token 
   * @param sfWebResponse $response 
   * @param sfWebRequest $request 
   * @return void
   * @author Clément JOBEILI
   */
  public function setToken($token)
  {
    $request      = sfContext::getInstance()->getRequest();
    $response     = sfContext::getInstance()->getResponse(); // WHERE IS THE F*** DIC :(
    
    $cookieToken  = $this->getCookieToken($request);
    $sessionToken = $this->getSessionToken();
    
    if(!$sessionToken && !$cookieToken){
      $this->setBothToken($token, $response);
    }
    
    if($sessionToken && !$cookieToken){
      $this->setCookieToken($token, $response);
    }
    
    if(!$sessionToken && $cookieToken){
      $this->setSessionToken($cookieToken);
    }
  }
  
  /**
   * if the user has a session token
   *
   * @return true|false
   * @author Clément JOBEILI
   */
  public function hasToken()
  {
    return $this->getSessionToken() ? true : false;
  }
  
  /**
   * set the session token
   *
   * @param string $token 
   * @return void
   * @author Clément JOBEILI
   */
  public function setSessionToken($token)
  {
    $this->setAttribute('token', $token);
  }
  
  /**
   * the the cookie token
   *
   * @param sfWebResponse $response 
   * @param string $token 
   * @return void
   * @author Clément JOBEILI
   */
  public function setCookieToken($token, sfWebResponse $response)
  {
    $response->setCookie('token', $token);
  }
  
  /**
   * Alias for setCookieToken and setSessionToken
   *
   * @param string $token 
   * @param sfWebResponse $response 
   * @return void
   * @author Clément JOBEILI
   */
  public function setBothToken($token, sfWebResponse $response)
  {
    $this->setSessionToken($token);
    $this->setCookieToken($token, $response);
  }
  
  /**
   * get the session token
   *
   * @return string
   * @author Clément JOBEILI
   */
  public function getSessionToken()
  {
    return $this->getAttribute('token');
  }
  
  /**
   * get the cookie token
   *
   * @param sfWebRequest $request 
   * @return void
   * @author Clément JOBEILI
   */
  public function getCookieToken(sfWebRequest $request)
  {
    return $request->getCookie('token');
  }
  
  /**
   * Alias for getSessionToken
   *
   * @return string the session token
   * @author Clément JOBEILI
   */
  public function getToken()
  {
    return $this->getSessionToken();
  }

}