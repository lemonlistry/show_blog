<?php get_header(); ?>
<div class="content">
<div class="listtop">
	
</div>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="lists">
        <div class="lists_l"><?php the_category(',') ?></div>
        <div class="lists_m">
          <div class="box">
            <div class="title">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('猛击查看 %s 的详细内容', 'kubrick'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
            </div>
            <div class="read_total"><?php if(function_exists('the_views')) { the_views(); } ?>&nbsp;&nbsp;<a href="<?php the_permalink(); ?>#pll-comment-here" target=_blank><?php comments_number('0个评论', '1个评论', '%个评论'); ?></a>&nbsp;<?php edit_post_link(编辑, '','&raquo;'); ?></div>
          </div>
          <div class="lists_r">   
            <div class="info"> <?php the_author() ?><br><?php the_time(__('Y/m/d')) ?></div>
            <ul>
              <?php the_tags('<li>','</li><li>','</li>'); ?>
            </ul>
          </div>
        </div>
        <div style="clear:both"></div>
        <div class="space"></div>
      </div>
      <div class="space"></div>
      <?php endwhile; ?>
      <?php else : ?>
	  <p class="center">哦，你找的文章好像不在哦。</p>
	  <?php endif; ?>
      
    </div>
    
    <?php get_sidebar(); ?>
	
   <div class="clear"></div>
   <div class="pages"><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?></div>
   
<?php get_footer(); ?>
