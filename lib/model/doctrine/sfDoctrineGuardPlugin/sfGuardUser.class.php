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
	  $action = strtolower($action);
	  $instance = strtolower(get_class($object));
	  $role = strtolower($this->getRoleByRessource($object));
	  
    return BalloonRoles::can($instance, $action, $role);
	  
	}
	
	/**
	 * Get the role for a ressource (wall/event)
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
}
