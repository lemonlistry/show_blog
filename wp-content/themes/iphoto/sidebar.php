<div id="sidebar">
		<div class="title">
			<ul>
				<li><?php _e( 'Title','iphoto');?>&#58;&nbsp;<?php the_title(); ?></li>
				<li><?php _e( 'Date','iphoto');?>&#58;&nbsp;<span class="date"><?php the_time('Y.m.d'); ?></span><?php if(function_exists('the_views')) {echo '<span class="views">&nbsp;&#44;&nbsp;';echo the_views();echo '</span>';} ?></span></li>
				<li><?php _e( 'Cate','iphoto');?>&#58;&nbsp;<?php the_category(', '); ?></li>
				<li><?php _e( 'Tags','iphoto');?>&#58;&nbsp;<?php the_tags('', ', ', ''); ?></li>
			</ul>
		</div>
		<div class="clear"></div>
		<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('sidebar') ) : ?>
		<?php endif; ?>
		<div class="clear"></div>
</div>