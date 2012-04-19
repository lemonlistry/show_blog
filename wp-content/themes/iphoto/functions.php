<?php
//lemon  add 
add_filter( 'the_content', 'auto_player_urls' );
function auto_player_urls($c) {
    $s = array('/^<p>(http:\/\/.*\.mp3)< \/p>$/mi' => '</p><p><embed name="mpl" class="mp3_player" wmode="opaque" src="'.get_bloginfo("template_url").'/mp3player.swf?audio_file=$1&amp;color=fafafa" style="border: 1px solid #DDD;" width="240" height="32" type="application/x-shockwave-flash"></embed></p>');
    foreach($s as $p => $r){
        $c = preg_replace($p,$r,$c);
    }
    return $c;
}
// lemon add end
define('THEME_NAME','iphoto');
load_theme_textdomain( THEME_NAME,TEMPLATEPATH .'/languages');
add_custom_background();
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array( 'video'));
if ( function_exists('register_nav_menus') ) {
	register_nav_menus(array('primary' => 'header'));
}
if ( function_exists('register_sidebar') ){
    register_sidebar(array(
		'name'=>'sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
function post_thumbnail($a){
global $post;
$post_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is ',$post->post_content,$matches ,PREG_SET_ORDER);
$post_img_src = $matches [0][1];
$cnt = count( $matches );
if($cnt>0){
$post_img = '<img src="'.get_bloginfo('template_url').'/timthumb.php?src='.$post_img_src.'&amp;w=265&amp;zc=1" />';
}else{
$cnt=0;
}
if($a==1){
return $post_img;
}else{
	return $cnt;
}
}
function ajax_post(){
	if( isset($_GET['action'])&& $_GET['action'] == 'ajax_post'){
		if(isset($_GET['cat'])){
			query_posts("category_name=" . $_GET['cat']."&paged=".$_GET['pag']);
		}else if(isset($_GET['pag'])){
			query_posts("paged=" . $_GET['pag']);
		}
		if(have_posts()){while (have_posts()):the_post();?>
					<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile;}
		die();
		}else{return;}
}
add_action('init', 'ajax_post');
function pagenavi( $p = 2 ) {
if ( is_singular() ) return;
global $wp_query,$paged;
$max_page = $wp_query->max_num_pages;
if ( $max_page == 1 ){
echo '<span id="post-current">1</span> / <span id="post-count">1</span>';
 return;
}
if ( empty( $paged ) ) $paged = 1;
if ( $paged >1 ) echo "<a id='prev' title='Prev' href='",esc_html( get_pagenum_link( $paged -1 ) ),"'>&lt;&lt;</a> ";
echo '<span id="post-current">'.$paged .'</span> / <span id="post-count">'.$max_page .'</span>';
if ( $paged <$max_page  ) echo "<a id='next' title='Next' href='",esc_html( get_pagenum_link( $paged +1) ),"'>&gt;&gt;</a> ";
}
function iphoto_comment($comment,$args,$depth) {
$GLOBALS['comment'] = $comment;
;echo '	<li ';comment_class();;echo ' id="li-comment-';comment_ID() ;echo '" >
		<div id="comment-';comment_ID();;echo '" class="comment-body">
			<div class="commentmeta">';echo get_avatar( $comment->comment_author_email,$size = '48');;echo '</div>
				';if ($comment->comment_approved == '0') : ;echo '				<em>';_e('Your comment is awaiting moderation.') ;echo '</em><br />
				';endif;;echo '			<div class="commentmetadata">&nbsp;-&nbsp;';printf(__('%1$s %2$s'),get_comment_date('Y.n.d'),get_comment_time('G:i'));;echo '</div>
			<div class="reply">';comment_reply_link(array_merge( $args,array('depth'=>$depth,'max_depth'=>$args['max_depth'],'reply_text'=>__('Reply')))) ;echo '</div>
			<div class="vcard">';printf(__('%s'),get_comment_author_link()) ;echo '</div>
			';comment_text() ;echo '		</div>
';
}

if(is_admin()){
	require_once(TEMPLATEPATH . '/includes/iphoto-update.php');
}
add_action('admin_init', 'iphoto_init');
function iphoto_init() {
	if (isset($_GET['page']) && $_GET['page'] == 'functions.php') {
		$dir = get_bloginfo('template_directory');
		wp_enqueue_script('adminjquery', $dir . '/includes/admin.js', false, '1.0.0', false);
		wp_enqueue_style('admincss', $dir . '/includes/admin.css', false, '1.0.0', 'screen');
	}
}
add_action('admin_menu','iphoto_page');
function iphoto_page (){
if ( count($_POST) >0 &&isset($_POST['iphoto_settings']) ){
$options = array ('keywords','description','analytics','lib','views','easing','animate','phzoom','ajax','copyright');
foreach ( $options as $opt ){
delete_option ( 'iphoto_'.$opt,$_POST[$opt] );
add_option ( 'iphoto_'.$opt,$_POST[$opt] );
}
}
add_theme_page('iPhoto '.__('Theme Options',THEME_NAME),__('Theme Options',THEME_NAME),'edit_themes',basename(__FILE__),'iphoto_settings');
}
function iphoto_settings(){?>
<div class="wrap">
<div>
<h2><?php _e( 'iPhoto Theme Options<span>Version: ',THEME_NAME);?><?php $theme_data=get_theme_data(TEMPLATEPATH . '/style.css'); echo $theme_data['Version'];?></span></h2>
</div>
<div class="clear"></div>
<form method="post" action="">
	<div id="theme-Option">
		<div id="theme-menu">
			<span class="m1"><?php _e( 'jQuery Effect',THEME_NAME);?></span>
			<span class="m2"><?php _e( 'Relative Plugins',THEME_NAME);?></span>
			<span class="m3"><?php _e( 'Website Information',THEME_NAME);?></span>
			<span class="m4"><?php _e( 'Analytics Code',THEME_NAME);?></span>
			<span class="m5"><?php _e( 'Footer Copyright',THEME_NAME);?></span>
			<span class="m6"><?php _e( 'iPhoto Theme Declare',THEME_NAME);?></span>
			<div class="clear"></div>
		</div>
		<div id="theme-content">
			<ul>
				<li>
				<tr><td>
					<em><?php _e( 'iPhoto use jquery 1.4.4 which contained in this theme, you can also use the Google one instead.',THEME_NAME);?></em><br/>
					<label><input name="lib" type="checkbox" id="lib" value="1" <?php if (get_option('iphoto_lib')!='') echo 'checked="checked"' ;?>/><?php _e( 'Load the jQuery Library supported by Google',THEME_NAME);?></label><br/><br/>
				</td></tr>
				<tr><td>
					<em><?php _e( '<strong>Animation of relayout elements</strong>',THEME_NAME);?></em><br />
					<input name="animate" type="checkbox" id="animate" value="1" <?php if (get_option('iphoto_animate')!='') echo 'checked="checked"';?>/><?php _e( 'Activate animation, Animation effect',THEME_NAME);?>
					<?php $iphoto_easing = get_option('iphoto_easing');if($iphoto_easing == '') $iphoto_easing = 'swing';?>
					<select name="easing">
					<option value ="swing" <?php echo ($iphoto_easing=='swing') ? 'selected="selected"' : ''; ?>>swing</option>
					<option value ="linear" <?php echo ($iphoto_easing=='linear') ? 'selected="selected"' : ''; ?>>linear</option>
					<option value ="easeInQuad" <?php echo ($iphoto_easing=='easeInQuad') ? 'selected="selected"' : ''; ?>>easeInQuad</option>
					<option value ="easeOutQuad" <?php echo ($iphoto_easing=='easeOutQuad') ? 'selected="selected"' : ''; ?>>easeOutQuad</option>
					<option value ="easeInOutQuad" <?php echo ($iphoto_easing=='easeInOutQuad') ? 'selected="selected"' : ''; ?>>easeInOutQuad</option>
					<option value ="easeInCubic" <?php echo ($iphoto_easing=='easeInCubic') ? 'selected="selected"' : ''; ?>>easeInCubic</option>
					<option value ="easeOutCubic" <?php echo ($iphoto_easing=='easeOutCubic') ? 'selected="selected"' : ''; ?>>easeOutCubic</option>
					<option value ="easeInOutCubic" <?php echo ($iphoto_easing=='easeInOutCubic') ? 'selected="selected"' : ''; ?>>easeInOutCubic</option>
					<option value ="easeInQuart" <?php echo ($iphoto_easing=='easeInQuart') ? 'selected="selected"' : ''; ?>>easeInQuart</option>
					<option value ="easeOutQuart" <?php echo ($iphoto_easing=='easeOutQuart') ? 'selected="selected"' : ''; ?>>easeOutQuart</option>
					<option value ="easeInOutQuart" <?php echo ($iphoto_easing=='easeInOutQuart') ? 'selected="selected"' : ''; ?>>easeInOutQuart</option>
					<option value ="easeInSine" <?php echo ($iphoto_easing=='easeInSine') ? 'selected="selected"' : ''; ?>>easeInSine</option>
					<option value ="easeOutSine" <?php echo ($iphoto_easing=='easeOutSine') ? 'selected="selected"' : ''; ?>>easeOutSine</option>
					<option value ="easeInOutSine" <?php echo ($iphoto_easing=='easeInOutSine') ? 'selected="selected"' : ''; ?>>easeInOutSine</option>
					<option value ="easeInExpo" <?php echo ($iphoto_easing=='easeInExpo') ? 'selected="selected"' : ''; ?>>easeInExpo</option>
					<option value ="easeOutExpo" <?php echo ($iphoto_easing=='easeOutExpo') ? 'selected="selected"' : ''; ?>>easeOutExpo</option>
					<option value ="easeInOutExpo" <?php echo ($iphoto_easing=='easeInOutExpo') ? 'selected="selected"' : ''; ?>>easeInOutExpo</option>
					<option value ="easeInCirc" <?php echo ($iphoto_easing=='easeInCirc') ? 'selected="selected"' : ''; ?>>easeInCirc</option>
					<option value ="easeOutCirc" <?php echo ($iphoto_easing=='easeOutCirc') ? 'selected="selected"' : ''; ?>>easeOutCirc</option>
					<option value ="easeInOutCirc" <?php echo ($iphoto_easing=='easeInOutCirc') ? 'selected="selected"' : ''; ?>>easeInOutCirc</option>
					<option value ="easeInElastic" <?php echo ($iphoto_easing=='easeInElastic') ? 'selected="selected"' : ''; ?>>easeInElastic</option>
					<option value ="easeOutElastic" <?php echo ($iphoto_easing=='easeOutElastic') ? 'selected="selected"' : ''; ?>>easeOutElastic</option>
					<option value ="easeInOutElastic" <?php echo ($iphoto_easing=='easeInOutElastic') ? 'selected="selected"' : ''; ?>>easeInOutElastic</option>
					<option value ="easeInBack" <?php echo ($iphoto_easing=='easeInBack') ? 'selected="selected"' : ''; ?>>easeInBack</option>
					<option value ="easeOutBack" <?php echo ($iphoto_easing=='easeOutBack') ? 'selected="selected"' : ''; ?>>easeOutBack</option>
					<option value ="easeInOutBack" <?php echo ($iphoto_easing=='easeInOutBack') ? 'selected="selected"' : ''; ?>>easeInOutBack</option>
					<option value ="easeInBounce" <?php echo ($iphoto_easing=='easeInBounce') ? 'selected="selected"' : ''; ?>>easeInBounce</option>
					<option value ="easeOutBounce" <?php echo ($iphoto_easing=='easeOutBounce') ? 'selected="selected"' : ''; ?>>easeOutBounce</option>
					<option value ="easeInOutBounce" <?php echo ($iphoto_easing=='easeInOutBounce') ? 'selected="selected"' : ''; ?>>easeInOutBounce</option>
					</select>
				</td></tr>
				</li>
				<li>
				<tr><td>
					<em><?php _e( 'WP-PostViews, Enables you to display how many times a post/page had been viewed.',THEME_NAME);?></em><br/>
					<label><input name="views" type="checkbox" id="views" value="1" <?php if (get_option('iphoto_views')!='') echo 'checked="checked"' ?>/><?php _e( 'Activate WP-PostViews',THEME_NAME);?></label><br/><br/>
				</td></tr>
				<tr><td>
					<em><?php _e( 'iPhoto has already containered <b>phZoom slide effect</b>, you may want to try it, and you should close relative plugins',THEME_NAME);?></em><br/>
					<label><input name="phzoom" type="checkbox" id="phzoom" value="1" <?php if (get_option('iphoto_phzoom')!='') echo 'checked="checked"'; ?>/><?php _e( 'Activate phZoom slide effect',THEME_NAME);?></label><br/><br/>
				</td></tr>
				</li>
				<li>
							<tr><td>
				<?php _e( '<em>Keywords, separate by English commas. like MuFeng, Computer, Software</em>',THEME_NAME);?><br/>
				<textarea name="keywords" id="keywords" rows="1" cols="70" style="font-size:11px;width:100%;"><?php echo get_option('iphoto_keywords');?></textarea><br/>	
			</td></tr>
			<tr><td>
				<?php _e( '<em>Description, explain what\'s this site about. like MuFeng, Breathing the wind</em>',THEME_NAME);?><br/>
				<textarea name="description" id="description" rows="3" cols="70" style="font-size:11px;width:100%;"><?php echo get_option('iphoto_description');?></textarea>		
			</td></tr>
				</li>
				<li>
							<tr><td>
				<?php _e( 'You can get your Google Analytics code <a target="_blank" href="https://www.google.com/analytics/settings/check_status_profile_handler">here</a>.',THEME_NAME);?></label><br>
				<textarea name="analytics" id="analytics" rows="5" cols="70" style="font-size:11px;width:100%;"><?php echo stripslashes(get_option('iphoto_analytics'));?></textarea>
			</td></tr>
				</li>
				<li>
							<tr><td>
				<textarea name="copyright" id="copyright" rows="5" cols="70" style="font-size:11px;width:100%;"><?php if(stripslashes(get_option('iphoto_copyright'))!=''){echo stripslashes(get_option('iphoto_copyright'));}else{echo 'Copyright &copy; '.date('Y').' '.'<a href="'.home_url( '/').'" title="'.esc_attr( get_bloginfo( 'name') ).'">'.esc_attr( get_bloginfo( 'name') ).'</a> All rights reserved'; };?></textarea>
				<br/><em><?php _e( '<b>Preview</b>',THEME_NAME);?><span> : </span><span><?php if(stripslashes(get_option('iphoto_copyright'))!=''){echo stripslashes(get_option('iphoto_copyright'));}else{echo 'Copyright &copy; '.date('Y').' '.'<a href="'.home_url( '/').'" title="'.esc_attr( get_bloginfo( 'name') ).'">'.esc_attr( get_bloginfo( 'name') ).'</a> All rights reserved'; };?></span></em>
			</td></tr>
				</li>
				<li>
							<tr><td>
			<p><?php _e('iPhoto is created, developed and maintained by <a href="http://mufeng.me/">MuFeng</a>.  If you like iPhoto,  please donate.  It will help in developing new features and versions.',THEME_NAME);?><?php _e('Alipay',THEME_NAME);?>:</strong> <a href="http://www.alipay.com" target="_blank" title="Alipay">afcold@gmail.com</a></p>
			<h3 style="color:#333" id="introduce"><?php _e( 'Introduction',THEME_NAME);?></h3>
			<p style="text-indent: 2em;margin:10px 0;"><?php _e( 'iPhoto is evolved from one theme of Tumblr and turned it into a photo theme which can be used at wordpress.',THEME_NAME);?></p>
			<h3 style="color:#333"><?php _e( 'Published Address',THEME_NAME);?></h3>
			<p  id="release" style="text-indent: 2em;margin:10px 0;"><a href="http://mufeng.me/wordpress-theme-iphoto.html" target="_blank">http://mufeng.me/wordpress-theme-iphoto.html</a></p>

			<h3 style="color:#333"><?php _e( 'Preview Address',THEME_NAME);?></h3>
			<p  id="preview" style="text-indent: 2em;margin:10px 0;"><a href="http://mufeng.me/photo/" target="_blank">http://mufeng.me/photo/</a></p>

			<h3 style="color:#333" id="bug"><?php _e( 'Report Bugs',THEME_NAME);?></h3>
			<p style="text-indent: 2em;margin:10px 0;"><?php _e( 'Weibo <a href="http://weibo.com/meapo" target="_blank">@mufeng.me</a> or leave a message at <a href="http://mufeng.me" target="_blank">http://mufeng.me</a>。',THEME_NAME);?></p>
			</td></tr>
				</li>
			</ul>
		</div>
	</div>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Options',THEME_NAME);?>" />
		<input type="hidden" name="iphoto_settings" value="save" style="display:none;" />
	</p>
</form>
</div>
<?php
}
?>
