	<div class="pagination">
	<ul>
	<?php if ($first_page !== FALSE): ?>
		<li><a href="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first" class="tablebutton"><?php echo __('First') ?></a></li>
	<?php else: ?>
		 <li class="disabled"><a href="#"><?php echo __('First') ?></a></li>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<li><a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev" class="tablebutton"><?php echo __('Previous') ?></a></li>
	<?php else: ?>
		 <li class="disabled"><a href="#"><?php echo __('Previous') ?></a></li>
	<?php endif ?>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			 <li class="disabled"><a href="#"><strong><?php echo $i ?></strong></a></li>
		<?php else: ?>
			<li><a href="<?php echo HTML::chars($page->url($i)) ?>" class="tablebtnumber"><?php echo $i ?></a></li>
		<?php endif ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
		<li><a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next" class="tablebutton"><?php echo __('Next') ?></a></li>
	<?php else: ?>
		 <li class="disabled"><a href="#"><?php echo __('Next') ?></a></li>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<li><a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last" class="tablebutton"><?php echo __('Last') ?></a></li>
	<?php else: ?>
		 <li class="disabled"><a href="#"><?php echo __('Last') ?></a></li>
	<?php endif ?>
</ul>
</div>
<!-- .pagination -->