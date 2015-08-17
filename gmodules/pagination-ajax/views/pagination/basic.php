<script>
$(document).ready(function () 
{
	 $(".pagination #page1").click(function() {
		 $.ajax({
				type: "GET",
				url: $(this).attr("url"),
				cache: false,
				success: function(html){$("#mypage").html(html);}
		  });
	});
});
</script>
<div class="pagination">
	<ul>
	<?php if ($first_page !== FALSE): ?>
		<li><a id="page1" href="#" url="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first"><?php echo __('First') ?></a></li>
	<?php else: ?>
		<li class="disabled"><a href="#"><?php echo __('First') ?></a></li>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<li><a id="page1" href="#" url="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev"><?php echo __('Previous') ?></a></li>
	<?php else: ?>
		<li class="disabled"><a href="#"><?php echo __('Previous') ?></a></li>
	<?php endif ?>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			<li class="disabled"><a href="#"><strong><?php echo $i ?></strong></a></li>
		<?php else: ?>
			<li><a id="page1" href="#" url="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a></li>
		<?php endif ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
		<li><a id="page1" href="#" url="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next"><?php echo __('Next') ?></a></li>
	<?php else: ?>
		<li class="disabled"><a href="#"><?php echo __('Next') ?></a></li>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<li><a id="page1" href="#" url="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last"><?php echo __('Last') ?></a></li>
	<?php else: ?>
		<li class="disabled"><a href="#"><?php echo __('Last') ?></a></li>
	<?php endif ?>
</ul>
</div><!-- .pagination -->