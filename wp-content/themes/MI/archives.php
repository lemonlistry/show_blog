<?php
/*
Template Name: Artives
*/
?>

<?php get_header(); ?>

   <div class="content">
	<?php while(have_posts()) : the_post(); ?>
		<div class="page_title post_rss"><h3><?php the_title('',' &raquo;'); ?></h3></div>
		<div class="page_content"><?php the_content(); ?></div>
        <?php comments_template(); ?> 
	<?php endwhile; ?>
   </div>
    
   <?php get_sidebar(); ?>
	
   <div class="clear"></div>

   
<?php get_footer(); ?>
