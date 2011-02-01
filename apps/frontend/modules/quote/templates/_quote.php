<div class="sondage"></div>
<div class="content">
<div class="head">
<?php echo link_to($quote->getQuote(), sprintf('@quote_answer?event=%s&wall=%s&quote=%s', 
  $eventId, $wall->getShort(), $quote->getId())); 
?>
</div>
<?php if($quote->isSurvey()): ?>
  <?php if(!$sf_user->hasAlreadyVote($quote->getRawValue(), true) && $quote->isActive()): ?>
  <form action="<?php echo url_for(sprintf("@choice_vote?event=%s&wall=%s&quote=%s", $eventId, $wall->getShort(), $quote->getId())); ?>" method="post">
    <ul>
      <?php $isActive = $quote->isActive(); ?>
      <?php foreach($quote->getPollChoices() as $key => $choice): ?>
        <li>
          <input type="radio" name="choice_<?php echo $quote->getId(); ?>" value="<?php echo $choice->getId(); ?>" />
          <?php if($isActive): ?>
            <?php echo chr($key + 65); ?> - 
          <?php endif; ?>
          <?php echo $choice->getChoiceValue(); ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <p><input type="submit" value="Voter !"></p>
  </form>
  <?php else:?>
    <!--<h4>Résultat</h4>-->
    <div class="reponses">
    <ul>
      <?php $totalVotes = $quote->getTotalPollAnswer()?>
      <?php foreach($quote->getPollChoices() as $key => $choice): ?>
        <li>
            <?php echo chr($key + 65); ?> - 
            <?php echo $choice->getChoiceValue(); ?> - 
            <?php echo $choice->getFormattedPercent($totalVotes);?>
        </li>
      <?php endforeach; ?>
    </ul>
    </div>
  <?php endif;?>
<?php endif; ?>

<p>
  <div class="date"><?php echo distance_of_time_in_words(strtotime($quote->getCreatedAt())); ?> -
  <?php if(!$quote->isSurvey()): ?>
    <?php if($quote->isValidated()): ?>
      <?php echo link_to('Vote', sprintf('@quote_vote?event=%s&wall=%s&quote=%s', $eventId, $wall->getShort(), $quote->getId()))?> 
      (<?php echo $quote->getVotesCount()?>)
      -
    <?php endif; ?>
  <?php endif; ?>
  <?php if(can($sf_user, 'validate_moderating_quote', $wall) && !$quote->isValidated()): ?> 
    <?php echo link_to('Validate', 
                sprintf('@quote_validate?event=%s&wall=%s&quote=%s', 
                  $eventId, 
                  $wall->getShort(), 
                  $quote->getId()))?> -      
  <?php endif; ?>

  <?php if(can($sf_user, 'remove_quote', $wall)): ?> 
    <?php echo link_to('Delete', 
                sprintf('@quote_remove?event=%s&wall=%s&quote=%s', 
                  $eventId, 
                  $wall->getShort(), 
                  $quote->getId())) ?> -
  <?php endif;?>

  <?php if(can($sf_user, 'update_moderating_quote', $wall) && !$quote->isValidated()): ?> 
    <?php echo link_to('Edit', 
                sprintf('@quote_edit?event=%s&wall=%s&quote=%s', 
                  $eventId, 
                  $wall->getShort(), 
                  $quote->getId())) ?> -
  <?php endif;?>
  </div>
</p>
</div>
