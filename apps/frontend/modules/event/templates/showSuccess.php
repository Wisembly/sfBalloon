<?php if(!$isAllowed): ?>
  <form action="<?php echo url_for('@event?short='.$event->getShort()) ?>" method="POST"> 
    <?php echo $form->renderGlobalErrors();?>  
    <?php echo $form->renderHiddenFields(); ?>
    Mot de passe : 
    <?php foreach($form as $f):?>
      <?php echo $f->renderError();?>
      <?php echo $f; ?>
    <?php endforeach;?>
      <input type="submit" value="Envoyer">  
  </form>
<?php else: ?>

  <div id="place_content">
      <?php if(can($sf_user, 'update', $event)): ?>
      <div class="menu-place">
            <div id="admin_edit_event-bt">
                <div class="img-add"></div>
              <span><?php echo link_to('Ajouter un wall',sprintf('@event_add_wall?short=%s', $event->getShort())); ?></span>
            </div>
            <div id="admin_event_members-bt">
                <div class="img-user"></div>
              <span><?php echo link_to('Gérer les Utilisateurs',sprintf('@invitation?event=%s', $event->getShort())); ?></span>
            </div>
            <div id="admin_edit_event-bt">
                <div class="img-edit"></div>
                <span><?php echo link_to("Modifier l'événement ".$event->getName(),sprintf('@event_edit?short=%s', $event->getShort())); ?></span>
            </div>
      </div>
      <?php endif;?>
      
    <div id="place_1" class="place_edit">
      <h2><?php echo $event->getName(); ?></h2>
    </div>
    <br />
    <div class="description">
        
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Integer tempor, felis non facilisis lacinia, eros leo facilisis mi,
        in interdum ipsum ligula vitae mi. In consectetur, velit a viverra fringilla,
        eros eros tristique elit, sit amet convallis arcu enim et nunc.
    </div>
    <ul id="events">
        <li id="title">
            <div class="green-button"></div>
            <span>Les prochaines sessions </span>
            <div class="clear"></div>
        </li>
        <?php $total_array = count($event->getWalls()); $flag = 1;?>
      <?php foreach($event->getWalls() as $wall):?>
        <?php if($wall->isAvailable()): ?>
        
        <?php if ($total_array == $flag):?>
            <li id="wall" style="border:0px;">
        <?php else:?>
            <li id="wall">
        <?php endif;?>
        
            <div class="admin_buttons_list_wall">
            <?php if(can($sf_user, 'update', $wall)): ?>
                    <div class="stats">
                        <div class="img-stats"></div><a href="#" ><span>Stats (ßeta)</span></a>
                    </div>
                    <div class="edition">
                        <div class="img-edition"></div>
                        <span><?php echo link_to('Editer',sprintf('@wall_edit?event=%s&wall=%s', $event->getShort(), $wall->getShort())); ?></span>
                    </div>
                    <div class="supr">
                        <div class="img-supr"></div><a href="#" ><span>Supprimer</span></a>
                    </div>
                <?php endif;?>
            </div>
            <div class="content_list_wall">
                <div class="label-list-wall">
                    <?php echo link_to($wall->getName(), sprintf('@wall?event=%s&wall=%s', $event->getShort(), $wall->getShort()) ); ?>
                </div>
                <div class="label-description">
                    Lundi 25 avril 2011 au Mercredi 27 avril 2011 à Paris
                </div>
            </div>
                
            
            <div class="clear"></div>
            <?php $flag++;?>
        </li> 
        <?php endif;?>
      <?php endforeach; ?>
    </ul>
    <br />
    
    <?php if(can($sf_user, 'view_archive', $event)): ?>
    <div class="archives">
        <div id="title"><div class="green-button"></div><span>Archives </span><br/></div>
    </div>
    <ul id="past-events">
      <?php foreach($event->getWalls() as $wall):?>
        <?php if(!$wall->isAvailable()): ?>
        <li>
          <?php echo link_to($wall->getName(), sprintf('@wall?event=%s&wall=%s', $event->getShort(), $wall->getShort()) ); ?>  
        </li> 
        <?php endif;?>
      <?php endforeach; ?>
    </ul>
    <?php endif;?>
  </div>  
<?php endif; ?>