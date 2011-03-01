<?php

/**
 * PollChoice
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    balloon
 * @subpackage model
 * @author     Clément JOBEILI <clement.jobeili@gmail.com>
 * @version    SVN: $Id$
 */
class PollChoice extends BasePollChoice
{
  private function _percent($totalVotes, $count)
  {
  	if($totalVotes == 0){
  		return 0;
  	}
  	
    return ($count / $totalVotes) * 100;
  }
  
  public function getFormattedPercent($totalVotes, $viewVotes = false)
  {
    $count = $this->getAnswers()->count();
    if(!$viewVotes){
      return sprintf("%1.1f %%", $this->_percent($totalVotes, $count));
    }
    return sprintf("%1.1f %% (%s vote%s)", $this->_percent($totalVotes, $count), $count, (($count > 1) ? "s" : ""));
  }
}
