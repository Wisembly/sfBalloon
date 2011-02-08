<?php use_helper('I18N') ?>
<h1>Inviter des personnes à gérer l'événement</h1>

<p>
  Vous pouvez inviter n'importe qui à gérer votre évènement avec vous, tout en lui allouant les rôles que vous voulez.
</p>

<form action="<?php echo url_for(sprintf('@invitation_create?event=%s', $eventId)) ?>" method="post">
  <table>
    <?php echo $form ?>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" name="register" value="<?php echo __('Inviter', null, 'sf_guard') ?>" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>