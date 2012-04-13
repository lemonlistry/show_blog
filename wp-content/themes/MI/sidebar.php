<div class="sidebar">
<!-- WP小工具窗口化开始 -->
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('边栏') ) : else : ?><?php endif; ?>
      <div class="title"><h2>随机文章</h2>
      <ul>
		<?php $rand_posts = get_posts('numberposts=8&orderby=rand');foreach( $rand_posts as $post ) : ?>
		<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php the_title(); ?></a></li>
		<?php endforeach; ?>
      </ul></div>
      <div class="space"></div>
      <div class="title"><h2>最新评论</h2>
		<?php
        global $wpdb;
        $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
        comment_post_ID, comment_author, comment_date_gmt, comment_approved,
        comment_type,comment_author_url,
        SUBSTRING(comment_content,1,35) AS com_excerpt
        FROM $wpdb->comments
        LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
        $wpdb->posts.ID)
        WHERE comment_approved = '1' AND comment_type = '' AND
        post_password = ''
        ORDER BY comment_date_gmt DESC
        LIMIT 8";
        $comments = $wpdb->get_results($sql);
        $output = $pre_HTML;
        $output .= "\n<ul>";
        foreach ($comments as $comment) {
        $output .= "\n<li>".strip_tags($comment->comment_author)
        ."：" . "<a href=\"" . get_permalink($comment->ID) .
        "#comment-" . $comment->comment_ID . "\" title=\"在 " .
        $comment->post_title . "上的评论" . "\">" . strip_tags($comment->com_excerpt)
        ."</a></li>";
        }
        $output .= "\n</ul>";
        $output .= $post_HTML;
        echo $output;?>	</div>
      <div class="space"></div>
	 <?php if ( is_home() ) { ?>
      <div class="title"><h2>友情连接</h2>
      <?php
	  global $wpdb;
	  $sql = "SELECT * FROM `wp_links` ORDER BY `link_id` ASC LIMIT 10";
	  $links = $wpdb->get_results($sql);
      $output = $pre_HTML;
      $output .= "\n<ul>";
	  foreach ($links as $rs) {
        $output .= "\n<li>" . "<a href='" .strip_tags($rs->link_url) ."' target='_blank' title='" .strip_tags($rs->link_description) . "' >"  . strip_tags($rs->link_name)."</a></li>";
	  }
      $output .= "\n</ul>";
      $output .= $post_HTML;
      echo $output;
	  ?> </div>
	  <?php } ?>
    </div>