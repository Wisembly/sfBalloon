<?php

/**
 * sfGuardUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    balloon
 * @subpackage model
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class sfGuardUser extends PluginsfGuardUser
{
  /**
   * Get the role of the user
   * 
   * @todo does not handle the event 
   * @return string
   */
  public function getRole()
  {
    return $this->getAuth()->getGroup()->getName();
	}
	
	/**
	 * Check if the user is root
	 *
	 * @return boolean
	 */ 
	public function isRoot()
	{
	  return $this->getIsRoot();
	}
	
	/**
	 * Can access a ressource
	 * 
	 * $event = Doctrine::getTable('Event')->find($id);
	 * if($user->can('edit', $event)){
	 *  // ...
	 * }
	 *
	 * @param string $action 
	 * @param object $object (for the moment only Event/Wall)
	 * @return boolean
	 */
	public function can($action, $object)
	{
	  if($this->isRoot()){
	    return true;
	  }
	  
	  $action = strtolower($action);
	  $instance = strtolower(get_class($object));
	  $role = strtolower($this->getRoleByRessource($object));
	  
	  return BalloonRoles::can($instance, $action, $role);
	  
	}
	
	/**
	 * Get the role for a ressou  rce (wall/event)
	 * 
	 * the model (wall/event) must have a getAuth() method witch return the auth of the object.
	 *
	 * @param string $object 
	 * @return false or the role
	 */
	public function getRoleByRessource($object)
	{
	  if(!is_callable(array($object, 'getAuth'))){
	    return false;
	  }
	  foreach ($object->getAuth() as $auth) {
	    if($auth->getUser() === $this){
	      return $auth->getGroup()->getName();
	    }
	  }
	  return false;
	}
	
	/**
	 * add a subscription to an user,
	 * 
	 * this is a factory method, so you have to passe the offer.
	 * If you passe an already existed event, it's just add a new wall to the event, with the offer
	 * and if event is newelly created, it will add a new event and a new wall with the offer
	 * 
	 * @param Offer $offer
	 * @param Event $event
	 * @param Wall $wall
	 * @param Voucher/null $voucher
	 * @param boolean $isPayed
	 * 
	 * @return Subscription $subscription
	 */ 
	public function addSubscription($offer, $event, $wall, $voucher = null, $isPayed = false)
	{
	  $event->Walls[] = $wall;
	  $event->save();
	  
	  $subscription = new Subscription();
	  $subscription->setWall($wall);
	  $subscription->setEvent($event);
	  $subscription->setOffer($offer);
	  if ($voucher) {
	    $subscription->setVoucher($voucher);
	  }
	  $subscription->setIsPayed($isPayed);
	  $subscription->save();
	  return $subscription;
	}
	
	/**
	 * Get all the rights of events of an user
	 *
	 * like array('admin' => arrayofevents, 'modo' => arrayofevents ...)
	 * @return void
	 */
	public function getRights()
	{
	  // ... 
	}
}
