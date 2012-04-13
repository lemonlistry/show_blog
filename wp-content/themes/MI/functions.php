<?php


//关了顶部工具栏
	add_filter( 'show_admin_bar', '__return_false' );
	require_once(TEMPLATEPATH . '/setting.php');
# WIDGET: Sidebar
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => '边栏',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
		'before_widget' => '<div class="title">',
        'after_widget' => '</div><div class="space"></div>',
    ));
/*** 首页分页页码调用  ，调用代码<?php wp_pagenavi() ? >****/

	function
	wp_pagenavi(
	$before = '', 
	$after = '', 
	$prelabel = '', 
	$nxtlabel = '', 
	$pages_to_show = 5, 
	$always_show = false
	) {
global $request, $posts_per_page, $wpdb, $paged;
if(empty($prelabel)) { $prelabel = '上一页';
} if(empty($nxtlabel)) {
$nxtlabel = '下一页';
} $half_pages_to_show = round($pages_to_show/2);
if (!is_single()) {
if(!is_category()) {
preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches); } else {
preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches); }
$fromwhere = $matches[1];
$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
$max_page = ceil($numposts /$posts_per_page);
if(empty($paged)) {
$paged = 1;
}
if($max_page > 1 || $always_show) {
echo "$before <span class=extend>当前第 $paged / $max_page 页 : </span>"; if ($paged >= ($pages_to_show-1)) {
echo '<a href="'.get_pagenum_link().'">&laquo; 首页</a>'; }
previous_posts_link($prelabel);
for($i = $paged - $half_pages_to_show; $i <= $paged + $half_pages_to_show; $i++) { if ($i >= 1 && $i <= $max_page) { if($i == $paged) {
echo "<strong class=now-page>$i</strong>";
} else {
echo '<a href="'.get_pagenum_link($i).'">'.$i.'</a>'; }
}
}
next_posts_link($nxtlabel, $max_page);
if (($paged+$half_pages_to_show) < ($max_page)) {
echo '<a href="'.get_pagenum_link($max_page).'">尾页 &raquo;</a>'; }
echo " $after";
}
}
}
?>