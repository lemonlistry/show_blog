<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>
   <div class="content">
	<?php while(have_posts()) : the_post(); ?>
		<div class="page_title post_rss page_title_color"><h3><?php the_title('',' &raquo;'); ?></h3></div>
		<div class="page_content">
		  <?php
          global $wpdb;
          $sql = "SELECT * FROM `wp_links` ORDER BY `link_id` ASC LIMIT 10";
          $links = $wpdb->get_results($sql);
          $output = $pre_HTML;
          $output .= "\n<ul id='links'>";
          foreach ($links as $rs) {
            $output .= "\n<li>" . "<a href='" .strip_tags($rs->link_url) ."' target='_blank' title='" .strip_tags($rs->link_description) . "' >"  . strip_tags($rs->link_name)."</a></li>";
          }
          $output .= "\n</ul>";
          $output .= $post_HTML;
          echo $output;
          ?>
        </div>
	<?php endwhile; ?>
	      <div class="space"></div>
      <?php comments_template(); ?> 
   </div>
    
   <?php get_sidebar(); ?>
	
   <div class="clear"></div>

   
<?php get_footer(); ?>