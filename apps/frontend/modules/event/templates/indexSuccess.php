<h1>Events List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Short</th>
      <th>Short description</th>
      <th>Landing html</th>
      <th>Logo</th>
      <th>Password</th>
      <th>Redirect</th>
      <th>Has custom css</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Deleted at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($events as $event): ?>
    <tr>
      <td><a href="<?php echo url_for('event/edit?id='.$event->getId()) ?>"><?php echo $event->getId() ?></a></td>
      <td><?php echo $event->getName() ?></td>
      <td><?php echo $event->getShort() ?></td>
      <td><?php echo $event->getShortDescription() ?></td>
      <td><?php echo $event->getLandingHtml() ?></td>
      <td><?php echo $event->getLogo() ?></td>
      <td><?php echo $event->getPassword() ?></td>
      <td><?php echo $event->getRedirect() ?></td>
      <td><?php echo $event->getHasCustomCss() ?></td>
      <td><?php echo $event->getCreatedAt() ?></td>
      <td><?php echo $event->getUpdatedAt() ?></td>
      <td><?php echo $event->getDeletedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('event/new') ?>">New</a>
