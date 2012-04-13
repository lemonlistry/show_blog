 
  <div class="footer">
   <div class="copyright">Design by <a href="http://www.TMdang.com/">TMdang.com</a><br>&copy; 2011-2012 <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></div>
    <div class="right"><ul><?php wp_list_pages('title_li='); ?></ul><br /><?php $options = get_option('xiaohan_options'); echo($options['copyinfo']); ?>  <?php $options = get_option('xiaohan_options'); if($options['icp']<>'') echo($options['icp']);?>  <?php $options = get_option('xiaohan_options'); if ($options['stat_content']) : ?>  <?php echo($options['stat_content']); ?><?php endif; ?><br /><?php echo get_num_queries(); ?>querys in <?php echo timer_stop(); ?> seconds</div>
    <div class="clear"></div>
  </div>
  <div class="space"></div>
</div>
</body>
</html>