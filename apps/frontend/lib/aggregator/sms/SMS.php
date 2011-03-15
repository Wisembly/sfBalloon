<?php
class SMS
{
  protected $eventCode;
  protected $content;
  protected $to;
  protected $from;
  protected $type;
  protected $vote;

  public function __construct($eventCode, $content, $from, $to, $type, $vote = null)
  {
    $this->eventCode  = $eventCode;
    $this->content    = $content;
    $this->from       = $from;
    $this->to         = $to;
    $this->type       = $type;
    $this->vote       = $vote;
  }

  public function isNewQuote()
  {
    return ($this->type === "quote");
  }
  
  public function isVoteToSurvey()
  {
    return ($this->type === "survey");
  }
  
  /**
   * Get eventCode
   */
  public function getEventCode()
  {
    return $this->eventCode;
  }

  /**
   * Get vote
   */
  public function getVote()
  {
    return $this->vote;
  }

  /**
   * Get content
   */
  public function getContent()
  {
    return $this->content;
  }
  
  /**
   * Get to
   */
  public function getTo()
  {
    return $this->to;
  }
  
  /**
   * Get from
   */
  public function getFrom()
  {
    return $this->from;
  }
  
  
}