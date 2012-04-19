<?php get_header(); ?>
	<div id="post-single">
		<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post-content">
				<h2><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h2>
				<p id="post-msg"><?php if(function_exists('the_views')) {echo '<span>'; echo the_views();echo 'Views</span>';} ?>
				<span><?php echo post_thumbnail(0);?> Photos</span>
				<span><?php comments_popup_link('0', '1', '%'); ?> Comments</span></p>
				<?php the_content(); ?>
			</div><!--end post-content -->
		<?php endwhile; endif; ?>
		<div id="comments">
			<?php comments_template('', true); ?>
		</div><!--end comments-->
	</div><!--end single-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>