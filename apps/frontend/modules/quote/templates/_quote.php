<?php if(!$quote->isSurvey()): ?>
  <?php if($quote->isValidated()): ?>
    <?php if(!in_array($quote->getId(), $votes->getRawValue())):?>
    <a href="<?php echo url_for(sprintf('@quote_vote?event=%s&wall=%s&quote=%s', 
      $eventId, $wall->getShort(), $quote->getId())); ?>">
      <div class="vote" id="vote">
        <?php if($quote->hasAnswers()): ?>
        <div class="reponse" id="ie_reponse"></div>
        <?php endif;?>
        <div>
          <span class="num" id="num"><?php echo $quote->getVotesCount()?></span><br>
          <span class="votes" id="votes">votes</span>
        </div>
      </div>
    </a>
    <?php else: ?>
    <div class="vote avote" id="vote">
    <!--<div class="reponse" id="ie_reponse"></div>-->
      <div>
        <span class="num" id="num"><?php echo $quote->getVotesCount()?></span><br>
        <span class="votes" id="votes">votes</span>
      </div>
    </div>
  <?php endif; ?>
  <?php endif;?>
<?php else:?>
<!--cest in sondage on affiche l'image-->
<div class="sondage"></div>

<?php endif; ?>
<div class="content">
  <div class="head">
  <?php echo link_to($quote->getQuote(), sprintf('@quote_edit?event=%s&wall=%s&quote=%s',
    $eventId, $wall->getShort(), $quote->getId())); ?>
  </div>
  <?php if($quote->isSurvey()): ?>
  <?php if(!in_array($quote->getId(), $votes->getRawValue()) && $quote->isActive()): ?>
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
          <?php echo $choice->getFormattedPercent($totalVotes, $can_view_vote_quote);?>
      </li>
    <?php endforeach; ?>
  </ul>
  </div>
  <?php endif;?>
<?php endif; ?>
  <div class="date"><?php echo distance_of_time_in_words(strtotime($quote->getCreatedAt())); ?> - </div>
  <div class="admin_buttons">
      
    <!--
    <?php if($can_update_moderating_quote): ?>
    <div class="bouton_edit">
    <?php echo link_to('Edit',
                sprintf('@quote_edit?event=%s&wall=%s&quote=%s',
                  $eventId,
                  $wall->getShort(),
                  $quote->getId()),
                 'class=edit_quote') ?>
    </div>
    <?php endif;?>
    -->
    
    
    <?php if(!isset($moderated)): ?>
    <?php if($can_fav_quote): ?>
      <span class="bouton_fav">
      <?php echo link_to(image_tag((!$quote->getIsFavori()) ? 'star-white32' : 'star-gold32'),
                  sprintf('@quote_favorite?event=%s&wall=%s&quote=%s',
                    $eventId,
                    $wall->getShort(),
                    $quote->getId())); ?>
    </span>
    <?php endif;?>
    
    <?php if($can_answer_quote): ?> 
    <div class="bouton_repondre">
    <?php echo link_to('Répondre', 
                sprintf('@quote_answer?event=%s&wall=%s&quote=%s', 
                  $eventId,
                  $wall->getShort(), 
                  $quote->getId()),
                  array('class' => 'repondre')) ?>
    </div>
    <?php endif;?>
    <?php if($can_une_quote): ?>
    <div class="bouton_alaune">
    <?php echo link_to('A la une',
                sprintf('@quote_alaune?event=%s&wall=%s&quote=%s',
                  $eventId,
                  $wall->getShort(),
                  $quote->getId()), array('class' => 'alaune')) ?>
    </div>
    <?php endif;?>
    <?php endif;?>

    <?php if($can_validate_moderating_quote && !$quote->isValidated()): ?>
      <div class="bouton_valider">
      <?php echo link_to('Validate',
                  sprintf('@quote_validate?event=%s&wall=%s&quote=%s',
                    $eventId,
                    $wall->getShort(),
                    $quote->getId(),
                    array('class' => 'valider')))?>
      </div>
    <?php endif; ?>

      <?php if($can_remove_quote): ?>
    <div class="bouton_supprimer">
    <?php echo link_to('Supprimer',
                sprintf('@quote_remove?event=%s&wall=%s&quote=%s',
                  $eventId,
                  $wall->getShort(),
                  $quote->getId()),
                'class=delete') ?>
    </div>
    <?php endif;?>

      <?php if($can_validate_moderating_quote && !$quote->isValidated()): ?>
      <?php endif;?>

  </div>
</div>
