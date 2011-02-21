<?php
/**
 * The confirmation email
 *
 * @package    balloon
 * @author     Nicolas PHILIPP <nicolas.philipp@supinfo.com>
 * @version    SVN: $Id$
 */
class ConfirmationMessage extends Swift_Message
{
    public function __construct($setTo, $subject, $body)
    {
        parent::__construct($subject, $body);

        $this
          ->setFrom(array('noreply@votrequestion.com' => 'noreply@votrequestion.com'))
          ->setTo($setTo)
          ->setReplyTo(array('contact@balloonup.com' => 'Balloon'))
          ->setBody($body)
          ->setContentType('text/html');
    }
}
?>
