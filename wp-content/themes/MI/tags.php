<?php
/*
Template Name: Tags
*/
?>

<?php get_header(); ?>
   <div class="content">
	<?php while(have_posts()) : the_post(); ?>
		<div class="page_title post_rss page_title_color"><h3><?php the_title('',' &raquo;'); ?></h3></div>
		<div class="page_content">
		<?php wp_tag_cloud('unit=px&smallest=12&largest=24&number=0'); ?>
		</div>
	<?php endwhile; ?>
   </div>
    
   <?php get_sidebar(); ?>
	
   <div class="clear"></div>

   
<?php get_footer(); ?>