<div id="post-<?php the_ID(); ?>" class="post-home video">
		<div class="post-thumbnail">
			<?php the_content(); ?>
		</div><!--end .post-thumbnail -->
		<div class="post-info">
			<div><?php if(function_exists('the_views')) {echo '<span>'; echo the_views();echo '</span>';echo 'Views';} ?></div>
			<div><span><?php echo post_thumbnail(0);?></span>Photos</div>
			<div><span><?php comments_popup_link('0', '1', '%'); ?></span>Comments</div>
		</div><!--end .post-info -->
</div><!--end .post-home -->