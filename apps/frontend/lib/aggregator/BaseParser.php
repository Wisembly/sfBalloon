<?php

class BaseParser
{
  protected function normalizeText($text)
  {
    return str_replace(array("\n", "\t", "\x0B", "\0"), '', $text);
  }

  protected function findContent($text)
  {
    return trim(strstr($text, ' '));
  }
}