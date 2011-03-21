<?php

class EmailGateway
{
  protected $email;
  protected $emailParser;
  protected static $dbManager;
  protected $dispatcher;
  
  public function __construct($emailParser, $dbManager)
  {
    $this->emailParser = $emailParser;
    self::$dbManager = $dbManager;
  }
  
  public function setDispatcher($dispatcher)
  {
    $this->dispatcher = $dispatcher;
  }

  public static function getDbManager()
  {
    return self::$dbManager;
  }
  
  public function handle($emailInfo)
  {
    try{

      $this->perform($emailInfo);
      $this->dispatcher->notify(new sfEvent($this, 'email.log', array("email" => $this->email)));

    }catch(Exception $e){
      $this->dispatcher->notify(
        new sfEvent($this, 'email.log_error', array(
          "email"       => $this->email,
          "message"     => $e->getMessage()
        )));
    }
    
    return new NoResponse();
  }

  protected function perform($email)
  {
    $emailParser = $this->getEmailParser();
    $this->email = $emailParser->parse($email);

    $event = self::getDbManager()->findOneEvent($this->email->getEventCode());
    if (!$event) {
      throw new EventNotFoundException("Aucun event n'a été trouvé");
    }

    $walls = self::getDbManager()->findAvailableWallForEventId($event->getId());
    if(!$walls) {
      throw new WallNotFoundException("Aucun wall trouvé pour l'event ". $event->getName());
    }
      
    if ($walls->count() > 1) {
      throw new TooManyWallFoundException("Il y a plus d'un wall pour l'event ". $event->getName());
    }

    $wall = $walls[0];

    self::getDbManager()->addQuote($this->email->getFrom(), $this->email->getContent(), $wall->getId());
  }
  
  /**
   * Get smsParser
   */
  public function getEmailParser()
  {
    return $this->emailParser;
  }
  
  /**
   * Get sms
   */
  public function getEmail()
  {
    return $this->email;
  }
  
}