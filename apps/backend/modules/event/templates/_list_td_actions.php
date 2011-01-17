<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($event, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($event, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <li class="sf_admin_action_show_walls">
      <?php echo link_to(__('Show walls'), '@wall?event='.$event->getId()) ?>
    </li>
    <li class="sf_admin_action_add_wall">
      <?php echo link_to(__('Add wall'), '@wall_new?event='.$event->getId()) ?>
    </li>
  </ul>
</td>
