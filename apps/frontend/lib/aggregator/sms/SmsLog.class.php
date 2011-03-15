<?php

class SmsLog
{
  
  public function getTemplate()
  {
    return "RECU DE %s VERS %s A %s \n\r%s\n\rCONTENU (%s car(s))\n\r%s\n\rFIN DE RECEPTION\n\r%s\n\r";
  }
  
  public function getErrorTemplate()
  {
    return "Erreur requete \n\rNumeroErreur: %s\n\rContenu sms: %s\n\r%s\n\r Fin Erreur requete \n\r";
  }
  
  public function getErrorFileLog()
  {
    return 'sms_error_log.txt';
  }
  
  public function getFileLog()
  {
    return 'sms_log.txt';
  }
  
}