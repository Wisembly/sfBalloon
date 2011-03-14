<div class="conteneur_header">
  <?php include_partial('poster', 
    array('wallId' => $wallId, 'eventId' => $eventId, 'form' => $form, 'menu' => $menu)) ?>
</div>
<div id="wall">
  <?php if($quotes->count()): ?>
  <div class="entete">
    <h3>Quotes avec une réponse</h3>
  </div>
  <ul>
    <?php foreach($quotes as $quote): ?>
    <li>
      <div class="item_wall">
        <?php include_partial('quote/quote', array(
            'votes'   => $currentUserVotes,
            'wall' => $wall, 
            'quote' => $quote, 
            'eventId' => $eventId
          ) + $cans->getRawValue()); ?>
      </div>
        <div class="clear"></div>
      <div class="answers">
        <ul>
          <?php foreach($quote->getAnswers() as $answer): ?>
          <li>
              <div class="label-reponse">
                  <p><?php echo $answer->getAnswer() ?></p>
              </div>
              <div class="posted-by">
              Posté par <b><?php echo $answer->getUser()->getUsername()?></b> le <i><?php echo $answer->getCreatedAt() ?></i>
              </div>
          </li>
          <?php endforeach;?>
        <ul>
      </div>
      <div class="separation"></div>
    </li>
    <?php endforeach;?>
  </ul>
  <?php else: ?>
    <div id="newquotes">Pas encore de question répondues.</div>
  <?php endif;?>
</div>