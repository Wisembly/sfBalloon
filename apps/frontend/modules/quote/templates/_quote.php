<?php echo link_to($quote->getQuote(), sprintf('@quote_answer?event=%s&wall=%s&quote=%s', $eventId, $wall->getShort(), $quote->getId()))?>
 - 
<?php echo distance_of_time_in_words(strtotime($quote->getCreatedAt())); ?> -

<?php if($quote->isValidated()): ?>
  <?php echo link_to('Vote', sprintf('@quote_vote?event=%s&wall=%s&quote=%s', $eventId, $wall->getShort(), $quote->getId()))?> 
  (<?php echo $quote->getVotesCount()?>)
  -
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
