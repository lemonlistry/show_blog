	<div class="clear"></div>
	<div id="footer">
		<p><?php if(stripslashes(get_option('iphoto_copyright'))!=''){echo stripslashes(get_option('iphoto_copyright'));}else{echo 'Copyright &copy; '.date("Y").' '.'<a href="'.home_url( '/' ).'" title="'.esc_attr( get_bloginfo( 'name') ).'">'.esc_attr( get_bloginfo( 'name') ).'</a> All rights reserved';}?></p><p>Powered by <a href="http://wordpress.org/" title="Wordpress">WordPress <?php bloginfo('version');?></a>  |  Written by <a href="http://mufeng.me" title="MuFeng">MuFeng</a> </p>
	</div><!--end footer-->
</div><!--end wrapper-->
<?php wp_footer(); ?>
<?php if (is_singular()){ ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/comments-ajax.js"></script>
<?php if(get_option('iphoto_phzoom')!="") : ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/phzoom.js"></script>
<?php endif; ?>
<?php }?>
<?php if (get_option('iphoto_analytics')!="") {?>
<div id="iphotoAnalytics"><?php echo stripslashes(get_option('iphoto_analytics')); ?></div>
<?php }?>
</body>
</html>
