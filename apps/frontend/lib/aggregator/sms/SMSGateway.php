<?php

class SMSGateway
{
  protected $sms;
  protected $smsParser;
  protected static $dbManager;
  
  public function __construct($smsParser, $dbManager)
  {
    $this->smsParser = $smsParser;
    self::$dbManager = $dbManager;
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
    }catch(Exception $e){
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
        throw new WallNotFoundException();
      }
      
      if ($walls->count() > 1) {
        throw new TooManyWallFoundException();
      }
      
      $wall = $walls[0];
      
      if ($this->sms->isVoteToSurvey()) {
        $surveys = SMSGateway::getDbManager()->findAvailableSurvey($wall->getId());

        if ($surveys->count() > 1) {
          throw new TooManySurveyFoundException();
        }

        if ($surveys->count() == 0) {
          throw new NoSurveyAvailableException();
        }

        $survey = $surveys[0];
        $alreadyVote = SMSGateway::getDbManager()->userHasAlreadyVote($this->sms->getFrom(), $survey->getId());
        
        if ($alreadyVote) {
          throw new UserHasAlreadyVoteOnThisSurveyException();
        }

        if (null === $this->sms->getVote()) {
          throw new RuntimeException();
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
      throw new EventNotFoundException();
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