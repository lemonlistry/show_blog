<?php get_header(); ?>
    <!-- <div class="more"><b>标签：</b><?php wp_tag_cloud('unit=px&smallest=12&largest=12&number=25&separator=, '); ?></div>
    <div class="total"><a href="http://eyson.cn/tags">更多 &raquo;</a></div>
    <div class="clear"></div>
  </div>
  <div class="space"></div> -->
<div class="content">

	  <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        
      <div class="lists">
        <div class="lists_l"><?php echo get_avatar( get_the_author_email(), 48 ); ?></div>
        <div class="lists_m">
          <div class="box2">
            <div class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('猛击查看 %s 的详细内容', 'kubrick'), the_title_attribute('echo=0')); ?>"><b><?php the_title(); ?></b></a></div>
            <div class="read_total2"><div class="span"><?php the_author() ?>发表于<?php the_time(__('Y/m/d')) ?> &nbsp;131231<?php if(function_exists('the_views')) { the_views(); } ?>&nbsp;<?php the_tags(); ?>&nbsp;<?php edit_post_link(编辑, '','&raquo;'); ?>
            </div>
			</div>
          </div>
          <div class="lists_r2">   
            <span><?php the_category(',') ?></span><span><a href="<?php the_permalink(); ?>#pll-comment-here" target=_blank><?php comments_number('0个评论', '1个评论', '%个评论'); ?></a>
            </span>
          </div>
        </div>
        <div style="clear:both"></div>
      </div>
      
      <div class="post_content">
      <?php the_content(); ?>
      </div>

      <div class="post_rss">
          <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
          // Both Comments and Pings are open ?>
          你可以<a href="#respond">发表评论</a>、<a href="<?php trackback_url(); ?>" rel="trackback">引用</a>到你的网站或博客，或通过<?php post_comments_feed_link('RSS 2.0'); ?>订阅这个日志的所有评论。
          <?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
          // Only Pings are Open ?>
          留言已关闭，但你可以将这个日志<a href="<?php trackback_url(); ?> " rel="trackback">引用</a>到你的网站或博客。
          <?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
          // Comments are open, Pings are not ?>
          通告目前不可用，你可以至底部留下评论。
          <?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
          // Neither Comments, nor Pings are open ?>
          评论已关闭。
          <?php } ?>
      </div>

      <div class="post_nav">
        <div><?php previous_post_link('<b>上一篇：</b>%link') ?></div>
        <div><?php next_post_link('<b>下一篇：</b>%link') ?></div>
      </div>

      <div class="space"></div>
      <?php comments_template(); ?> 
      <?php endwhile; ?>
      <?php else : ?>
	  <p class="center">哦，你找的文章好像不在哦。</p>
	  <?php endif; ?>
      
    </div>
    
    <?php get_sidebar(); ?>
	
   <div class="clear"></div>
<div class="space"></div><div class="space"></div>
   
<?php get_footer(); ?>
