<?php

class EmailParser extends BaseParser implements ObjectParser
{
  public function parse($object)
  {
    $env = $this->parseEnvelop($object['envelop']);
    $eventCode = $this->findEvent($object['subject'], $env['to']);

    $content = $this->normalizeText($object['content']);

    return new Email($eventCode, $content, $env['from'], $env['to']);
  }

  private function findEvent($subject, $to)
  {
    if ($to === "question@votrequestion.com") {
      return addslashes(htmlspecialchars($subject));
    }
    return strstr($to, '@', true);
  }

  private function parseEnvelop($text)
  {
    return json_decode(stripslashes(utf8_encode(str_replace(array('[', ']'), '', $text))), true);    
  }
}