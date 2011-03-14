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
<div class="tab-center">
<ul id="reponses">
    <li class='head'><h4>Liste des réponses</h4></li>
<?php $cp = 0;?>
<?php foreach($quote->getAnswers() as $answer): ?>
    <?php if ($cp%2 == 1):?>
    <li class='pair'>
    <?php else: ?>
    <li class='impair'>
    <?php endif ?>
    <div class="admin_buttons_reponse">
        <div class="reponse_txt">
        <?php echo $answer->getAnswer()?>
        </div>
        <div class="bouton_supprimer">
            <?php echo link_to('Delete', sprintf('@answer_delete?event=%s&wall=%s&quote=%s&answer=%d', $eventId, $wallId, $quoteId, $answer->getId(),'class=delete'), array('method' => 'delete', 'confirm' => 'Are you sure')); ?>
        </div>
        <div class="bouton_valider">
            <?php echo link_to('Edit', sprintf('@answer_edit?event=%s&wall=%s&quote=%s&answer=%d', $eventId, $wallId, $quoteId, $answer->getId(),array('class' => 'valider'))); ?>
        </div>
    </div>
    <?php $cp++;?>
  </li>
<?php endforeach; ?>
<?php if($cp == 0):?>
    <li>
        <em>aucunes réponses</em>
    </li>
<?php endif;?>
</ul>
</div>
<br/>