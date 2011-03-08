<?php echo link_to('First', url_for($route).'?page=1') ?>
 
<?php echo link_to('Previous', url_for($route).'?page='.$pager->getPreviousPage()) ?>
 
<?php foreach ($pager->getLinks() as $page): ?>
    <?php if ($pager->getPage() == $page): ?>
        <?php echo $page ?>
    <?php else: ?>
        <?php echo link_to($page, url_for($route)."?page=$page") ?>
    <?php endif; ?>
<?php endforeach; ?>
 
<?php echo link_to('Next', url_for($route).'?page='.$pager->getNextPage()) ?>
 
<?php echo link_to('Last', url_for($route).'?page='.$pager->getLastPage()) ?>