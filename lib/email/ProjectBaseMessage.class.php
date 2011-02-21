<?php
/**
 * Description of ProjectBaseMessage
 *
 * @package    balloon
 * @author     Nicolas PHILIPP <nicolas.philipp@supinfo.com>
 * @version    SVN: $Id$
 */
class ProjectBaseMessage extends Swift_Message
{
    public function __construct($setTo,$subject,$body,$addCc = null, $addBcc = null)
    {
        parent::__construct($subject, $body);

        $this
          ->setContentType('text/html')
          ->setFrom(array('noreply@votrequestion.com' => 'Votre Question.com'))
          ->setTo($setTo)
          ->setReplyTo(array('contact@balloonup.com' => 'Balloon'))
        ;
        // Ajoute Cc si different de NULL
        if($addCc != null)
            $this->addCc($addCC);
        // Ajoute Bcc si different de NULL
        if($addBcc != null)
            $this->addBcc($address);
    }
}
?>
