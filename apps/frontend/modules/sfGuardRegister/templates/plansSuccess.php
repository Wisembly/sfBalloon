<h2>Plans and Pricing</h2>

<ul>
  <?php foreach($plans as $plan): ?>
  <li><?php echo link_to($plan->getName(), "@sf_guard_register?plan=".$plan->getName())?></li>
  <?php endforeach; ?>
</ul>