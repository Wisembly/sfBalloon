<?php
class QuoteChoiceCollectionForm extends sfForm
{
  public function configure()
  {
    if (!$quote = $this->getOption('quote')) {
      throw new InvalidArgumentException('You must provide a quote object.');
    }
 
    for ($i = 0; $i < $this->getOption('size', 5); $i++) {
      $choice = new PollChoice();
      $choice->setQuote($quote);
 
      $form = new PollChoiceForm($choice);
 
      $this->embedForm($i, $form);
    }

	  $this->mergePostValidator(new QuoteChoiceValidatorSchema());
  }
}