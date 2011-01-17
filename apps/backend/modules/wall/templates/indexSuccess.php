<div id="sf_admin_container">
	<h1>Gestion des walls pour <?php echo $event->getName()?></h1>
	<div id="sf_admin_content">
		<table>
		  <thead>
		    <tr>
		      <th>Nom</th>
		      <th>Hashtag Twitter</th>
		      <th>SMS Hashtag</th>
		      <th>Commence le</th>
		      <th>Finis le</th>
		      <th>A lieu le</th>
					<th>Actions</th>
		    </tr>
		  </thead>
		  <tbody>
			<?php $walls = $pager->getResults(); ?>
		    <?php foreach ($walls as $wall): ?>
		    <tr>
		      <td width='170px'><?php echo $wall->getName() ?></td>
		      <td><?php echo $wall->getTwHashtag() ?></td>
		      <td><?php echo $wall->getSmsHashtag() ?></td>
		      <td><?php echo $wall->getStart() ?></td>
		      <td><?php echo $wall->getStop() ?></td>
		      <td><?php echo $wall->getRealStartDate() ?></td>
					<td>
						<ul class="sf_admin_td_actions">
							<li class="sf_admin_action_edit">
								<a href="<?php echo url_for('@wall_edit?id='.$wall->getId().'&event='.$event->getId()) ?>">Edit</a>
							</li>
							<li class="sf_admin_action_delete">
								<?php echo link_to('Delete', '@wall_delete?id='.$wall->getId().'&event='.$event->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
							</li>
						</ul>
					</td>
		    </tr>
		    <?php endforeach; ?>
		  </tbody>
		</table>
		<ul class="sf_admin_actions">
  		<li class="sf_admin_action_new"><a href="<?php echo url_for('@wall_new?event='.$event->getId()) ?>">New</a></li>
  		<li class="sf_admin_action_list"><a href="<?php echo url_for('@event') ?>">Back to events </a></li>
		</ul>
	</div>
</div>