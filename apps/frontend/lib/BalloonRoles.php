<?php

/**
 * Les roles
 * 
 * Un root peut tout modifier, changer etc
 * Un admin peut modifier les events qu'il a (gestion de l'id)
 * 
 * $user->can('edit', $event)
 * 
 */
class BalloonRoles
{
  public static $roles = array(
    'event' => array(
      'update' => array(
        'admin' => true,
        'modo'  => false,
        'anim'  => false
      ),
      'update_wall' => array(
        'admin' => true,
        'modo'  => true,
        'anim'  => false
      ),
      'remove_wall' => array(
        'admin' => true,
        'modo'  => false,
        'anim'  => false
      ),
      'add_wall' => array(
        'admin' => true,
        'modo'  => false,
        'anim'  => false
      ),
      'add_user' => array(
        'admin' => true,
        'modo'  => false,
        'anim'  => false
      )
    ),
    'wall'  => array(
      'fav_quote' => array(
        'admin' => true,
        'modo'  => true,
        'anim'  => true
      ),
      'une_quote' => array(
        'admin' => true,
        'modo'  => true,
        'anim'  => true
      ),
      'add_survey' => array(
        'admin' => true,
        'modo'  => true,
        'anim'  => true
      ),
      'answer_quote' => array(
        'admin' => true,
        'modo'  => true,
        'anim'  => true
      ),
      'show_moderating_quotes' => array(
        'admin' => true,
        'modo'  => true,
        'anim'  => false
      ),
      'update_moderating_quote' => array(
        'admin' => true,
        'modo'  => true,
        'anim'  => false
      ),
      'validate_moderating_quote' => array(
        'admin' => true,
        'modo'  => true,
        'anim'  => false
      ),
      'remove_quote' => array(
        'admin' => true,
        'modo'  => true,
        'anim'  => false
      ),
    )
  );
  
  public static function can($instance, $action, $role)
  {
    $roles = self::$roles;
    if(isset($roles[$instance]) 
      && isset($roles[$instance][$action])
      && isset($roles[$instance][$action][$role])){
        return self::$roles[$instance][$action][$role];
    }else{
      return false;
    }
    
  }
}