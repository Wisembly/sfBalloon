<?php
class SMSResponse extends NoResponse
{
  public function __toString()
  {
    $xml = new DOMDocument ("1.0", "UTF-8");
    $receive = $xml->createElement("receivesms");
    $newreceive = $xml->appendChild($receive);
    $status = $xml->createElement("status", $this->status);
    $newreceive->appendChild($status);
    return $xml->saveXML();
  }
}