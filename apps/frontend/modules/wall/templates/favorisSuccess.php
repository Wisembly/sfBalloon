<div class="conteneur_header">
  <?php include_partial('poster', 
    array('wallId' => $wallId, 'eventId' => $eventId, 'form' => $form, 'menu' => $menu)) ?>
</div>
<div id="wall">
  <?php if($quotes->count()): ?>
  <div class="entete">
    <h3>Quotes en favori</h3>
  </div>
  <ul>
    <?php foreach($quotes as $quote): ?>
    <li>
      <div class="item_wall">
        <?php include_partial('quote/quote', array(
            'wall' => $wall, 
            'quote' => $quote, 
            'eventId' => $eventId
          ) + $cans->getRawValue()); ?>
      </div>
      <div class="separation"></div>
    </li>
    <?php endforeach;?>
  </ul>
  <?php else: ?>
    <div id="newquotes">Pas encore de question en favori.</div>
  <?php endif;?>
</div>