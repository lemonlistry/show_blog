<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title>
	<?php if (is_home () ) { bloginfo('name'); echo " - "; bloginfo('description'); } elseif ( is_category() ) { single_cat_title();
	echo " - "; bloginfo('name');  echo " - "; bloginfo('description'); } elseif (is_single() || is_page() ) { single_post_title(); echo " - "; bloginfo('name');  echo " - "; bloginfo('description'); }
	elseif (is_search() ) { bloginfo('name');  echo " - "; bloginfo('description'); echo " － 搜索结果: "; echo
	wp_specialchars($s); } else { wp_title('',true); } ?>
    </title>
		<?php if (is_home()){ 
	$options = get_option('xiaohan_options');
	$description = ($options['indexdescription']);
	$keywords = ($options['indexkeyword']);
} elseif (is_single()){    
	if ($post->post_excerpt) { 
          $description  = $post->post_excerpt; 
      } else { 
     if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){ 
      $post_content = $result['1']; 
     } else { 
      $post_content_r = explode("\n",trim(strip_tags($post->post_content))); 
      $post_content = $post_content_r['0']; 
     } 
           $description = substr($post_content,0,220);     
   } 
    $keywords = "";        
	$tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ",";
    }
} 
?>
<meta name="description" content="<?=$description?>" />
<meta name="keywords" content="<?=$keywords?>,<?php bloginfo('name'); ?>" />
	<meta name="author" content="TMdang.com" />
	<meta name="copyright" content="Design by TMdang.com" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
    <!-- <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.lazyload.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script> -->
</head>
<body>
<div class="warp">
  <div class="space"></div>
  <div class="header">
    <div class="logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>"/></a></div>
    <div class="right"><a href="<?php bloginfo('url'); ?>/guestbook">留下足迹</a></div>
    <div class="right rss"><a title="RSS订阅" href="<?php bloginfo('rss2_url'); ?>">订阅本站</a></div>
    <div class="clear"></div>
  </div>
  <div class="space"></div>
  <div class="nav">
    <ul>
      <li <?php if(is_home()){echo 'class="current-cat"';}?>><a title="首 页" href="<?php echo get_option('home'); ?>/">首 页</a></li>
		<?php
        if(is_single()){
            $parent = get_the_category();
            $parent = $parent[0];
            $id = $parent->term_id;
        }
        ?>
        <?php wp_list_categories('title_li=&current_category='.$id); ?>
    </ul>
	<span class="navr"><ul><?php wp_meta(); ?><?php wp_register(); ?><li><?php wp_loginout(); ?></li></ul></span>
    <div class="clear"></div>
  </div>
  <div class="search">
    <div class="box">
      <form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
        <input name="s" id="s" class="text" type="text"  onblur="if (this.value =='') this.value='搜索本站内容...'" onfocus="this.value=''" onclick="if (this.value=='搜索本站内容...') this.value=''" value="搜索本站内容..." />
        <input name="ok" class="submit" type="submit" value="搜索" />
      </form>
    </div>
	<div class="info"><b>标签：</b><?php wp_tag_cloud('unit=px&smallest=12&largest=12&number=6&separator=   '); ?></div>
    <div class="clear"></div>
  </div>
  <div id="pt" class="bm cl">
<div class="z">
<?php if ( is_single() ) { ?>
<a href="<?php bloginfo('url'); ?>/" class="nvhm" title="首页"><?php bloginfo('name'); ?></a><em></em> &gt;&gt; <?php the_category(',') ?> &gt;&gt; <?php the_title(); ?>
<?php } else{  ?>
<a href="<?php bloginfo('url'); ?>/" class="nvhm" title="首页"><?php bloginfo('name'); ?></a><em></em>
&nbsp;&nbsp;&nbsp;运行: <?php echo floor((time()-strtotime("2012-01-01"))/86400);?>天 | 文章：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish; ?> 篇 | 评论：<?php $total_comments = get_comment_count(); echo $total_comments['approved'];?> 条 | 最后更新：<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y年n月j日', strtotime($last[0]->MAX_m));echo $last; ?>
<?php } ?>
</div>
</div>
