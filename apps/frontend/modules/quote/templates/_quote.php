<?php if(!$quote->isSurvey()): ?>
  <?php if($quote->isValidated()): ?>
  <a href="<?php echo url_for(sprintf('@quote_vote?event=%s&wall=%s&quote=%s', 
    $eventId, $wall->getShort(), $quote->getId())); ?>">
    <div class="vote" id="vote">
    <!--<div class="reponse" id="ie_reponse"></div>-->
      <div>
        <span class="num" id="num"><?php echo $quote->getVotesCount()?></span><br>
        <span class="votes" id="votes">votes</span>
      </div>
    </div>
  </a>
  <?php endif; ?>
<?php else:?>
<!--cest in sondage on affiche l'image-->
<div class="sondage"></div>

<?php endif; ?>
<div class="content">
  <div class="head">
  <?php echo link_to($quote->getQuote(), sprintf('@quote_answer?event=%s&wall=%s&quote=%s', 
    $eventId, $wall->getShort(), $quote->getId())); ?>
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
  <div class="date"><?php echo distance_of_time_in_words(strtotime($quote->getCreatedAt())); ?> -
  </div>
      <div class="moderation">
  <?php if(can($sf_user, 'validate_moderating_quote', $wall) && !$quote->isValidated()): ?> 
    <?php echo link_to('Validate', 
                sprintf('@quote_validate?event=%s&wall=%s&quote=%s', 
                  $eventId, 
                  $wall->getShort(), 
                  $quote->getId()))?> -      
  <?php endif; ?>

  <?php if(can($sf_user, 'remove_quote', $wall)): ?> 
    <?php echo link_to('Supprimer',
                sprintf('@quote_remove?event=%s&wall=%s&quote=%s', 
                  $eventId, 
                  $wall->getShort(), 
                  $quote->getId()),
                'class=delete') ?>
                
  <?php endif;?>

  <?php if(can($sf_user, 'update_moderating_quote', $wall) && !$quote->isValidated()): ?> 
    <?php echo link_to('Edit', 
                sprintf('@quote_edit?event=%s&wall=%s&quote=%s', 
                  $eventId, 
                  $wall->getShort(), 
                  $quote->getId())) ?>
  <?php endif;?>
  <?php if(can($sf_user, 'fav_quote', $wall) ): ?> 
    <?php echo link_to((!$quote->getIsFavori())? 'Fav': 'Unfav', 
                sprintf('@quote_favorite?event=%s&wall=%s&quote=%s', 
                  $eventId,
                  $wall->getShort(), 
                  $quote->getId()), array('class' => 'fav')) ?>
  <?php endif;?>
  <?php if(can($sf_user, 'une_quote', $wall) ): ?> 
    <?php echo link_to('A la une', 
                sprintf('@quote_alaune?event=%s&wall=%s&quote=%s', 
                  $eventId,
                  $wall->getShort(), 
                  $quote->getId()), array('class' => 'alaune')) ?>
  <?php endif;?>
  </div>
</div>
