<?php

class SMSGateway
{
  protected $sms;
  protected $smsParser;
  protected static $dbManager;
  protected $dispatcher;
  
  public function __construct($smsParser, $dbManager)
  {
    $this->smsParser = $smsParser;
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
  
  public function handle($smsInfo)
  {
    $status = "ok";
    try{

      $this->perform($smsInfo);
      $this->dispatcher->notify(new sfEvent($this, 'sms.log', array("sms" => $this->sms)));

    }catch(Exception $e){

      $this->dispatcher->notify(
        new sfEvent($this, 'sms.log_error', array(
          "sms"         => $this->sms,
          "message"     => $e->getMessage()
        )));
        
      $status = "notok";
    }
    
    return new SMSResponse($status);
  }

  protected function perform($sms)
  {
    $smsParser = $this->getSmsParser();
    $this->sms = $smsParser->parse($sms);
    $event = SMSGateway::getDbManager()->findOneEvent($this->sms->getEventCode());
    
    if ($event) {
      $walls = SMSGateway::getDbManager()->findAvailableWallForEventId($event->getId());
      if(!$walls) {
        throw new WallNotFoundException("Aucun wall trouvé pour l'event ". $event->getName());
      }
      
      if ($walls->count() > 1) {
        throw new TooManyWallFoundException("Il y a plus d'un wall pour l'event ". $event->getName());
      }
      
      $wall = $walls[0];
      
      if ($this->sms->isVoteToSurvey()) {
        $surveys = SMSGateway::getDbManager()->findAvailableSurvey($wall->getId());

        if ($surveys->count() > 1) {
          throw new TooManySurveyFoundException("Il y a plus d'un sondage pour le wall ". $wall->getName());
        }

        if ($surveys->count() == 0) {
          throw new NoSurveyAvailableException("Aucun sondage trouvé pour le wall ". $wall->getName());
        }

        $survey = $surveys[0];
        $alreadyVote = SMSGateway::getDbManager()->userHasAlreadyVote($this->sms->getFrom(), $survey->getId());
        
        if ($alreadyVote) {
          throw new UserHasAlreadyVoteOnThisSurveyException(
            sprintf("L'utilisateur %s à déjà voté sur la quote %s", 
              $this->sms->getFrom(),
              $survey->getQuote()
            )
          );
        }

        if (null === $this->sms->getVote()) {
          throw new SMSIsNotAVoteException("Le message est trop cours pour être un vote");
        }

        SMSGateway::getDbManager()->voteOnQuote(
          $this->sms->getFrom(), 
          $this->sms->getVote(), 
          $survey
        );

      }else{
        // Add the quote.
        SMSGateway::getDbManager()->addQuote($this->sms->getFrom(), $this->sms->getContent(), $wall->getId());
      }

      /*
      @todo : Vérifier si on est dans quote ou sondage, voir si le vote sondage est dispo (durée etc)
      Si on a un seul sondage : test si l'user a déjà voté, si pas voté, on récupére le sondage, on vote suivant ce que l'utilisateur a mis
      si quote, on ajoute la quote.
      */
    }else{
      throw new EventNotFoundException("Aucun event n'a été trouvé");
    }
  }
  
  /**
   * Get smsParser
   */
  public function getSmsParser()
  {
    return $this->smsParser;
  }
  
  /**
   * Get sms
   */
  public function getSms()
  {
    return $this->sms;
  }
  
}