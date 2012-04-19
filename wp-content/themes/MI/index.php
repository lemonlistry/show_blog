<?php get_header(); ?>
<div class="content">
<div class="listtop">
	
</div>
<?php $sticky = get_option( 'sticky_posts' ); 
				/* 对这些文章排序, 日期最新的在最上 */
					rsort( $sticky ); /* 获取1篇最新置顶文章 */
					$sticky = array_slice( $sticky, 0, 6 );
	$i = 0;
	foreach($sticky as $post_id):
		$post = get_post($post_id);
		setup_postdata($post);
		if($i == 0){
			$class = 'red';
		}elseif($i == 1){
			$class = 'bule';
		}elseif($i == 2){
			$class = 'bule';
		}elseif($i == 3){
			$class = 'hei';
		}elseif($i == 4){
			$class = 'hei';
		}elseif($i == 5){
			$class = 'hei';
		}
		?>
      <div class="lists">
        <div class="ding">置顶</div>
        <div class="lists_m">
          <div class="box">
            <div class="title <?php echo $class;?>">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('猛击查看 %s 的详细内容', 'kubrick'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
            </div>
            <div class="read_total"><?php if(function_exists('the_views')) { the_views(); } ?>&nbsp;&nbsp;<?php the_tags(); ?>&nbsp;<?php edit_post_link(编辑, '','&raquo;'); ?></div>
          </div>
          <div class="lists_r">   
            <div class="info"> <?php the_author() ?><br><?php the_time(__('Y/m/d')) ?></div>
            <span><?php the_category(',') ?></span><span><a href="<?php the_permalink(); ?>#pll-comment-here" target=_blank><?php comments_number('0个评论', '1个评论', '%个评论'); ?></a>
            </span>
          </div>
        </div>
        <div style="clear:both"></div>
      </div><?php $i++;endforeach; ?>
				<?php if (have_posts()) : 
						
						$args = array(	'ignore_sticky_posts' => 1,//忽略sticky_posts，不置顶，但是输出置顶文章
							'post__not_in' => $sticky,//排除置顶文章，不输出
							'paged' => $paged
						);
						query_posts( $args );
					while (have_posts()) : the_post(); ?>
      <div class="lists">
        <div class="lists_l"><?php echo get_avatar( get_the_author_email(), 48 ); ?></div>
        <div class="lists_m">
          <div class="box">
            <div class="title">
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('猛击查看 %s 的详细内容', 'kubrick'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
            </div>
            <div class="read_total"><?php if(function_exists('the_views')) { the_views(); } ?>&nbsp;&nbsp;<?php the_tags(); ?>&nbsp;<?php edit_post_link(编辑, '','&raquo;'); ?></div>
          </div>
          <div class="lists_r">   
            <div class="info"> <?php the_author() ?><br><?php the_time(__('Y/m/d')) ?></div>
            <span><?php the_category(',') ?></span><span><a href="<?php the_permalink(); ?>#pll-comment-here" target=_blank><?php comments_number('0个评论', '1个评论', '%个评论'); ?></a>
            </span>
          </div>
        </div>
        <div style="clear:both"></div>
      </div>
       <?php endwhile; ?><?php endif;  wp_reset_query(); ?>
      
    </div>
    
    <?php get_sidebar(); ?>
	
   <div class="clear"></div>
   <div class="pages"><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?></div>
   
<?php get_footer(); ?>