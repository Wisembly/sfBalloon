<?php
/**
 * 
 * 
 * @todo : pas de gestion de virgule pour le moment
 *
 * @package default
 * @author Clément JOBEILI
 */
class SMSParser implements ObjectParser
{
  
  public function parse($object)
  {
    $content = $this->normalizeText($object['content']);
    $eventCode = $this->findEventCode($content);
    
    $realContent = $this->findContent($content);
    $type = $this->findType($realContent);

    $vote = null;
    if ($type === "survey") {
      
    }
    $vote = $this->findVote($realContent);

    return new SMS($eventCode, $realContent, $object['from'], $object['to'], $type, $vote);
  }
  
  private function findEventCode($text)
  {
    return strstr($text, ' ', true);
  }
  
  private function findContent($text)
  {
    return trim(strstr($text, ' '));
  }
  
  private function findType($text)
  {
    return (strlen($text) === 1) ? "survey" : "quote";
  }

  private function findVote($text)
  {
    switch($text) {
      case '1':
      case 'A': 
      case 'a': return 0; break;
      case '2':
      case 'B': 
      case 'b': return 1; break;
      case '3':
      case 'C': 
      case 'c': return 2; break;
      case '4':
      case 'D': 
      case 'd': return 3; break;
      case '5':
      case 'E': 
      case 'e': return 4 ; break;
      default: return null; break;
    }
  }
  
  private function normalizeText($text){
    return str_replace(array("\n", "\t"), '', $text);
  }
}