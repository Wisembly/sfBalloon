<div class="entete">
    <h1><?php echo $quote->getQuote(); ?></h1>
</div>

<?php if(can($sf_user, 'answer_quote', $wall)): ?>
<div class="tab-center"><h4>Ajouter une réponse</h4></div>
<br/>
<form action="<?php echo url_for(sprintf("@answer_create?event=%s&wall=%s&quote=%s", $eventId, $wallId, $quoteId)); ?>" method="post">
<div class="sign_table">
    <div class="col-25">&nbsp;</div>
    <div class="col-75">
        <?php foreach ($form as $field): ?>
            <?php if(!$field->isHidden()):?>
                <div class="col-100">
                    <div id="label"><?php echo $field->renderLabel(); ?></div>
                    <div id="field"><?php echo $field->render(); ?></div>
                    <div id="error"><?php echo $field->renderError(); ?></div>
                </div>
            <?php else: ?>
                <?php echo $field->render(); ?>
            <?php endif ?>
        <?php endforeach ?>
    </div>
    <div class="clear"></div>
    <div class="tab-center">
    <input class="add_answer" type="submit" value="Ajouter cette réponse">
    </div>
</div>
</form>

<?php endif;?>
<br/>
<div class="tab-center"><h4>Liste des réponses</h4>
<?php if($quote->getAnswers() != ''):?>
    <em>aucunes réponses</em>
<?php endif;?>
<ul>
<?php foreach($quote->getAnswers() as $answer): ?>
  <li>
    <?php echo $answer->getAnswer()?> - 
    <?php echo link_to('Delete', sprintf('@answer_delete?event=%s&wall=%s&quote=%s&answer=%d', $eventId, $wallId, $quoteId, $answer->getId()), array('method' => 'delete', 'confirm' => 'Are you sure')); ?> - 
    <?php echo link_to('Edit', sprintf('@answer_edit?event=%s&wall=%s&quote=%s&answer=%d', $eventId, $wallId, $quoteId, $answer->getId())); ?>
  </li>
<?php endforeach; ?>
</ul>
</div>
<br/>