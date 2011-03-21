<?php

/**
 * aggregator actions.
 *
 * @package    balloon
 * @subpackage aggregator
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class aggregatorActions extends sfActions
{
 /**
  * Executes sms action
  *
  * @param sfRequest $request A request object
  */
 public function executeSms(sfWebRequest $request)
 {
    $from    = $request->getParameter('from');
    $to      = $request->getParameter('to');
    $content = $request->getParameter('content');

    $sms = array(
      'from'    => $from,
      'to'      => $to,
      'content' => $content,
    );
   
    $sg = new SMSGateway(new SMSParser(), new SMSDbManager());
    $sg->setDispatcher($this->dispatcher);

    echo $sg->handle($sms);

    exit;
 }

 public function executeEmail(sfWebRequest $request)
 {
   $from    = $request->getParameter('from');
   $to      = $request->getParameter('to');
   $content = $request->getParameter('text');
   $envelop = $request->getParameter('envelope');
   $subject = $request->getParameter('subject');

   $email = array(
     'from'     => $from,
     'to'       => $to,
     'content'  => $content,
     'envelop'  => $envelop,
     'subject'  => $subject
   );

   $eg = new EmailGateway(new EmailParser(), new EmailDbManager());
   $eg->setDispatcher($this->dispatcher);

   $eg->handle($email);
   exit;
 }
}
