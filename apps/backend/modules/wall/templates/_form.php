<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('@wall_'.($form->getObject()->isNew() ? 'create' : 'update').'?event='.$event->getId().(!$form->getObject()->isNew() ? '&id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
					<ul class="sf_admin_actions">
					  	<?php if (!$form->getObject()->isNew()): ?>
		            <li class="sf_admin_action_delete">
		            &nbsp;<?php echo link_to('Delete', '@wall_delete?id='.$form->getObject()->getId().'&event='.$event->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
		            </li>
		          <?php endif; ?>
						<li class="sf_admin_action_list"><a href="<?php echo url_for('@wall?event='.$event->getId()) ?>">Back to list</a></li>
						<li class="sf_admin_action_save"><input type="submit" value="Save"></li>
					</ul>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['tw_hashtag']->renderLabel() ?></th>
        <td>
          <?php echo $form['tw_hashtag']->renderError() ?>
          <?php echo $form['tw_hashtag'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sms_hashtag']->renderLabel() ?></th>
        <td>
          <?php echo $form['sms_hashtag']->renderError() ?>
          <?php echo $form['sms_hashtag'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['lang']->renderLabel() ?></th>
        <td>
          <?php echo $form['lang']->renderError() ?>
          <?php echo $form['lang'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['short_description']->renderLabel() ?></th>
        <td>
          <?php echo $form['short_description']->renderError() ?>
          <?php echo $form['short_description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['start']->renderLabel() ?></th>
        <td>
          <?php echo $form['start']->renderError() ?>
          <?php echo $form['start'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['stop']->renderLabel() ?></th>
        <td>
          <?php echo $form['stop']->renderError() ?>
          <?php echo $form['stop'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['real_start_date']->renderLabel() ?></th>
        <td>
          <?php echo $form['real_start_date']->renderError() ?>
          <?php echo $form['real_start_date'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['has_custom_css']->renderLabel() ?></th>
        <td>
          <?php echo $form['has_custom_css']->renderError() ?>
          <?php echo $form['has_custom_css'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>

