<?php

require __DIR__.'/../../apps/frontend/lib/WallSupport.class.php';

class ImportTweetsTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
    ));
    
    $this->namespace = 'balloon';
    $this->name = 'import-tweets';
    $this->briefDescription = 'Import all tweets from twitter with the hashtags of all the available events';
  }
  
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    
    $walls = Doctrine::getTable('Wall')->findAvailableWalls();
    $url = "http://search.twitter.com/search.json?q=%s+-RT&result_type=recent&rpp=10%s";
    
    foreach ($walls as $wall) {
      $url    = sprintf($url, 
        $wall->getTwHashtag(), 
        ($wall->getLastTweetId()) ? "&since_id=".$wall->getLastTweetId() : null
      );
      $json   = file_get_contents($url, 0, null, null);
      $output = json_decode($json, true);
      
      $lastTweetId = (isset($output["max_id_str"])) ? $output["max_id_str"] : null ;
      
      if ($lastTweetId > $wall->getLastTweetId()) {
        foreach ($output["results"] as $q) {
          $quote = new Quote();
          $quote->setWallId($wall->getId());
          $quote->setSourceId(Source::$TWITTER);
          $quote->setTwUsername($q["from_user"]);
          $quote->setQuote($q["text"]);
          $quote->setToken($q["from_user_id"]);
          
          if(!$wall->isModerated() && $wall->supports('moderation')){
            $quote->setIsValidated(true);
          }
          
          $quote->save();
        }
        
        $wall->setLastTweetId($lastTweetId);

        $wall->save();
      }
    }
    
  }
}