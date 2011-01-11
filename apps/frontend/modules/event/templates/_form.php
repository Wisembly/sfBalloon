<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('event/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('event/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'event/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
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
        <th><?php echo $form['short']->renderLabel() ?></th>
        <td>
          <?php echo $form['short']->renderError() ?>
          <?php echo $form['short'] ?>
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
        <th><?php echo $form['landing_html']->renderLabel() ?></th>
        <td>
          <?php echo $form['landing_html']->renderError() ?>
          <?php echo $form['landing_html'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['logo']->renderLabel() ?></th>
        <td>
          <?php echo $form['logo']->renderError() ?>
          <?php echo $form['logo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['password']->renderLabel() ?></th>
        <td>
          <?php echo $form['password']->renderError() ?>
          <?php echo $form['password'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['redirect']->renderLabel() ?></th>
        <td>
          <?php echo $form['redirect']->renderError() ?>
          <?php echo $form['redirect'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['has_custom_css']->renderLabel() ?></th>
        <td>
          <?php echo $form['has_custom_css']->renderError() ?>
          <?php echo $form['has_custom_css'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['deleted_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['deleted_at']->renderError() ?>
          <?php echo $form['deleted_at'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
