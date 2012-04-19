<div id="post-<?php the_ID(); ?>" class="post-home">
		<div class="post-thumbnail">
			<?php if(post_thumbnail(0)>0) : ?>
				<?php echo '<a href="';echo the_permalink();echo'" title="';echo the_title();echo '">';echo post_thumbnail(1);echo '</a>';?>
			<?php else : ?>
				<div class="post-noimg">
				<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
				<?php echo '<p>';echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 500,"..."); echo '</p>';?>
				</div>
			<?php endif; ?>
		</div><!--end .post-thumbnail -->
		<div class="post-info">
			<div><?php if(function_exists('the_views')) {echo '<span>'; echo the_views();echo '</span>';echo 'Views';} ?></div>
			<div><span><?php echo post_thumbnail(0);?></span>Photos</div>
			<div><span><?php comments_popup_link('0', '1', '%'); ?></span>Comments</div>
		</div><!--end .post-info -->
</div><!--end .post-home -->