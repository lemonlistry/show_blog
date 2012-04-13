<?php

class xiaohanOptions {

	function getOptions() {
		$options = get_option('xiaohan_options');
		if (!is_array($options)) {
			$options['indextitle'] = '';
			$options['indexkeyword'] = '';
			$options['indexdescription'] = '';
			$options['icp'] = '';
			$options['copyinfo'] = '';
			$options['notice'] = false;
			$options['notice_content'] = '';
			$options['submenu'] = false;
			$options['showcase_caption'] = false;
			$options['showcase_title'] = '';
			$options['showcase_content'] = '';
			$options['ctrlentry'] = false;
			$options['stat'] = false;
			$options['stat_content'] = '';
			$options['feed'] = false;
			$options['feed_url'] = '';
			$options['feed_email'] = false;
			$options['feed_url_email'] = '';
			$options['banner_link'] = '';
			$options['banner_link_target'] = '';
			$options['banner_link_xfn'] = '';
			update_option('xiaohan_options', $options);
		}
		return $options;
	}

	function add() {
		if(isset($_POST['xiaohan_save'])) {
			$options = xiaohanOptions::getOptions();
			
			$options['indextitle'] = stripslashes($_POST['indextitle']);
			$options['indexkeyword'] = stripslashes($_POST['indexkeyword']);
			$options['indexdescription'] = stripslashes($_POST['indexdescription']);
			$options['icp'] = stripslashes($_POST['icp']);
			$options['copyinfo'] = stripslashes($_POST['copyinfo']);
			// notice
			if ($_POST['notice']) {
				$options['notice'] = (bool)true;
			} else {
				$options['notice'] = (bool)false;
			}
			$options['notice_content'] = stripslashes($_POST['notice_content']);
			
			if ($_POST['submenu']) {
				$options['submenu'] = (bool)true;
			} else {
				$options['submenu'] = (bool)false;
			}
			// showcase
			if ($_POST['showcase_caption']) {
				$options['showcase_caption'] = (bool)true;
			} else {
				$options['showcase_caption'] = (bool)false;
			}
			$options['showcase_title'] = stripslashes($_POST['showcase_title']);
			$options['showcase_content'] = stripslashes($_POST['showcase_content']);
			
			// stat
			if ($_POST['stat']) {
				$options['stat'] = (bool)true;
			} else {
				$options['stat'] = (bool)false;
			}
			$options['stat_content'] = stripslashes($_POST['stat_content']);

			// feed
			if ($_POST['feed']) {
				$options['feed'] = (bool)true;
			} else {
				$options['feed'] = (bool)false;
			}
			$options['feed_url'] = stripslashes($_POST['feed_url']);
			if ($_POST['feed_email']) {
				$options['feed_email'] = (bool)true;
			} else {
				$options['feed_email'] = (bool)false;
			}
			$options['feed_url_email'] = stripslashes($_POST['feed_url_email']);
			
			$options['banner_link'] = stripslashes($_POST['banner_link']);
			$options['banner_link_target'] = stripslashes($_POST['banner_link_target']);
			$options['banner_link_xfn'] = stripslashes($_POST['banner_link_xfn']);

			update_option('xiaohan_options', $options);

		} else {
			xiaohanOptions::getOptions();
		}

		add_theme_page(__('主题设置', 'xiaohan'), __('主题设置', 'xiaohan'), 'edit_themes', basename(__FILE__), array('xiaohanOptions', 'display'));
	}

	function display() {
		$options = xiaohanOptions::getOptions();
?>
<style>
.wrap{margin-left:20px;}
.wrap h2{border-bottom:1px #ddd solid;margin-bottom:15px;}
.wrap h3{background:#EE6932;border-radius: 8px 8px 8px 8px;color:#fff;font-size:14px;height:30px;line-height:30px;width:120px;text-indent:10px;margin:0;}
.form-table th{width:100px;color:#00F}
.form-table {border-collapse:collapse;width:720px;margin-bottom:15px;}
.form-table td,.form-table th {border:#e0e1e1 solid 1px; font-size:12px;color:#565656; height:35px;line-height:35px;background:#fff;} 
</style>
<form action="#" method="post" enctype="multipart/form-data" name="xiaohan_form" id="xiaohan_form">
	<div class="wrap">
		<h2><?php _e('Xiaohan Theme 主题设置', 'xiaohan'); ?></h2>
        <h3>全局设置</h3>
        <table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('首页关键词', 'xiaohan'); ?>
					</th>
					<td>
						<label>
                        	<input name="indexkeyword" id="indexkeyword" size="60" class="code" value="<?php echo($options['indexkeyword']); ?>" />
						</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<?php _e('首页描述', 'xiaohan'); ?>
					</th>
					<td>
						<label>
							<textarea name="indexdescription" id="indexdescription" cols="50" rows="2" style="width:550px;font-size:12px;" class="code"><?php echo($options['indexdescription']); ?></textarea>
						</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<?php _e('ICP备案号', 'xiaohan'); ?>
					</th>
					<td>
						<label>
							<input name="icp" id="icp" size="60" class="code" value="<?php echo($options['icp']); ?>" />
						</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<?php _e('底部版权信息', 'xiaohan'); ?>
					</th>
					<td>
						<label>
							<textarea name="copyinfo" id="copyinfo" cols="50" rows="2" style="width:550px;font-size:12px;" class="code"><?php echo($options['copyinfo']); ?></textarea>
						</label>
					</td>
				</tr>
                <tr valign="top">
					<th scope="row">
						<?php _e('统计代码', 'xiaohan'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'xiaohan'); ?></small>
					</th>
					<td>
						<label>
							<input name="stat" type="checkbox" value="checkbox" <?php if($options['stat']) echo "checked='checked'"; ?> />
						</label><?php _e('底部添加统计代码', 'xiaohan'); ?>
						<br/>
						<label>
							<textarea name="stat_content" id="stat_content" cols="50" rows="5" style="width:550px;font-size:12px;" class="code"><?php echo($options['stat_content']); ?></textarea>
						</label>
						<!-- showcase END -->
					</td>
				</tr>

			</tbody>
		</table>

        
        <table class="form-table">
			<tbody>
				
			</tbody>
		</table>


		<table class="form-table">
			<tbody>
				
			</tbody>
		</table>

		<p class="submit">
			<input class="button-primary" type="submit" name="xiaohan_save" value="<?php _e('Save Changes', 'xiaohan'); ?>" />
		</p>
        <p style="margin-bottom:60px;">本主题由<a href="http://www.tmdang.com/" target="_blank">天猫党</a>开发设计, 支持<a href="http://www.tmdang.com/" target="_blank">天猫党</a>, 获得免费更新和升级服务.</p>
	</div>
</form>
<?php
	}
}

// register functions
add_action('admin_menu', array('xiaohanOptions', 'add'));

load_theme_textdomain( 'xiaohan' );

// add feed links to header
if (function_exists('automatic_feed_links')) {
automatic_feed_links();
} else {
return;
}
// enable threaded comments
function enable_threaded_comments(){
if (!is_admin()) {
if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
wp_enqueue_script('comment-reply');
}
}
add_action('get_header', 'enable_threaded_comments');

// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// custom excerpt length
function custom_excerpt_length($length) {
return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length');

// custom excerpt ellipses for 2.9+
function custom_excerpt_more($more) {
return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

/* custom excerpt ellipses for 2.8-
function custom_excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt);
}
add_filter('wp_trim_excerpt', 'custom_excerpt_more'); 
*/

// no more jumping for read more link
/*
function no_more_jumping($post) {
return '<a href="'.get_permalink($post->ID).'" class="read-more">'.'Continue Reading'.'</a>';
}
add_filter('excerpt_more', 'no_more_jumping');
*/

// add a favicon to your 
function xiaohan_blog_favicon() {
echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
add_action('wp_head', 'xiaohan_blog_favicon');

//PostExcerpt
function xiaohan_strimwidth($str ,$start , $width ,$trimmarker ){
	$output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
	return $output.$trimmarker;
}

function get_first_p($post){
	//如果是使用 Windows Live Writer 这些工具写日志，可能使用<p>和</p>进行分段
	if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$matches)){
		return $matches[1];
	} else {
	//如果直接在 WordPress 写日志，使用换行符（\n）来分段
		$post_content = explode("\n",trim(strip_tags($post->post_content)));
		return $post_content ['0'];
	}
}

// add a favicon for your admin
function xiaohan_admin_favicon() {
echo '<link rel="Shortcut Icon" type="image/x-icon"

href="'.get_bloginfo('stylesheet_directory').'/images/favicon.png" />';
}
add_action('admin_head', 'xiaohan_admin_favicon');

// custom admin login logo
function xiaohan_login_logo() {
echo '<style type="text/css">
h1 a { background:url('.get_bloginfo('template_url').'/images/bg.gif) 0 -385px no-repeat; }
</style>';
}
add_action('login_head', 'xiaohan_login_logo');

// disable all widget areas
/*function disable_all_widgets($sidebars_widgets) {
//if (is_home())
$sidebars_widgets = array(false);
return $sidebars_widgets;
}
add_filter('sidebars_widgets', 'disable_all_widgets');*/

// kill the admin nag
if (!current_user_can('edit_users')) {
add_action('init', create_function('$a',

"remove_action('init', 'wp_version_check');"), 2);
add_filter('pre_option_update_core', create_function('$a', "return null;"));
}

function xiaohan_copyright() {
echo 'Design by <a href="http://www.TMdang.com/">TMdang.com</a><br>';
echo '© 2011-2012 <a href="http://localhost/wp">盖片网</a>';
}
add_action('wp_footer', 'xiaohan_copyright');

// category id in body and post class
function category_id_class($classes) {
global $post;
foreach((get_the_category($post->ID)) as $category)
$classes [] = 'cat-' . $category->cat_ID . '-id';
return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');

// get the first category id
function get_first_category_ID() {
$category = get_the_category();
return $category[0]->cat_ID;
}


function xiaohan_pagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;
$next = $paged + 1;
$range = 4; // only edit this if you want to show more page-links
$showitems = ($range * 2)+1;

$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
echo "<div class='pagination'>";
echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<a href='".get_pagenum_link(1)."'>最前</a>":"";
echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."'>上一页</a>":"";

for ($i=1; $i <= $pages; $i++){
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
}
}

echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."'>下一页</a>" :"";
echo ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."'>最后</a>":"";
echo "</div>\n";
}
}
 

/** Comments */
if (function_exists('wp_list_comments')) {
	// comment count
	function comment_count( $commentcount ) {
		global $id;
		$_comments = get_comments('status=approve&post_id=' . $id);
		$comments_by_type = &separate_comments($_comments);
		return count($comments_by_type['comment']);
	}
}

// custom comments
function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}

?>
<li id="comment-<?php comment_ID() ?>" class="comment">
			<div class="cheader <?php if($comment->comment_author_email == get_the_author_email()) {echo 'adminheader';} else { echo 'regularheader';} ?>">
				<?php
					$author_class = '';
					if (function_exists('get_avatar') && get_option('show_avatars')) {
						$author_class = 'with_avatar';
						echo get_avatar($comment, 32);
					}
				?>
                <div class="item">
                	<span class="lou"><a href="#comment-<?php comment_ID() ?>"><?php printf('#%1$s', ++$commentcount); ?></a></span>
					<span class="cauthor <?php echo $author_class; ?>">

					<?php if (get_comment_author_url()) : ?>
						<a id="commentauthor-<?php comment_ID() ?>" href="<?php comment_author_url() ?>" rel="external nofollow" title="<?php comment_author(); ?>" target="_blank">
					<?php else : ?>
						<span id="commentauthor-<?php comment_ID() ?>" title="<?php comment_author(); ?>">
					<?php endif; ?>

						<?php comment_author(); ?>

					<?php if (get_comment_author_url()) : ?>
						</a>
					<?php else : ?>
						</span>
					<?php endif; ?>

					</span>
					<span class="items">
					<?php if (!get_option('thread_comments')) : ?>
						<a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('Reply', 'xiaohan'); ?></a> | 
					<?php else : ?>
						<?php comment_reply_link(array('depth' => $depth, 'max_depth'=> $args['max_depth'], 'reply_text' => __('Reply', 'xiaohan'), 'after' => ' | '));?>
					<?php endif; ?>
					<a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'commentbody-<?php comment_ID() ?>', 'comment');"><?php _e('Quote', 'xiaohan'); ?></a>
					<?php edit_comment_link(__('Edit', 'xiaohan'), ' | ', ''); ?>
					</span>
					<span class="cdate">
					Post:<?php printf( __('%1$s at %2$s', 'xiaohan'), get_comment_date(__('Y-m-d', 'xiaohan')),  get_comment_time(__(' H:i', 'xiaohan')) ); ?>
					</span>
					<div class="clear"></div>
                </div>
			</div>
			<div class="cbody" id="commentbody-<?php comment_ID() ?>">
				<?php comment_text(); ?>
			</div>
			<div class="clear"></div>

<?php
}

function the_author_posts_link_with_avatar($deprecated = '') {
	global $authordata;
	printf(
		'<a href="%1$s" title="%2$s">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		sprintf( __( 'Posts by %s' ), attribute_escape( get_the_author() ) ),
		get_avatar(get_the_author_email(), 32)
	);
}
 
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run xiaohan_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'xiaohan_setup' );

if ( ! function_exists( 'xiaohan_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override xiaohan_setup() in a child theme, add your own xiaohan_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function xiaohan_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'xiaohan', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'xiaohan' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to xiaohan_header_image_width and xiaohan_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'xiaohan_header_image_width', 468 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'xiaohan_header_image_height', 60 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See xiaohan_admin_header_style(), below.
	add_custom_image_header( '', 'xiaohan_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/berries.jpg',
			'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Berries', 'xiaohan' )
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/cherryblossoms.jpg',
			'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Cherry Blossoms', 'xiaohan' )
		),
		'concave' => array(
			'url' => '%s/images/headers/concave.jpg',
			'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Concave', 'xiaohan' )
		),
		'fern' => array(
			'url' => '%s/images/headers/fern.jpg',
			'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Fern', 'xiaohan' )
		),
		'forestfloor' => array(
			'url' => '%s/images/headers/forestfloor.jpg',
			'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Forest Floor', 'xiaohan' )
		),
		'inkwell' => array(
			'url' => '%s/images/headers/inkwell.jpg',
			'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Inkwell', 'xiaohan' )
		),
		'path' => array(
			'url' => '%s/images/headers/path.jpg',
			'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'xiaohan' )
		),
		'sunset' => array(
			'url' => '%s/images/headers/sunset.jpg',
			'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Sunset', 'xiaohan' )
		)
	) );
}
endif;

if ( ! function_exists( 'xiaohan_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in xiaohan_setup().
 *
 * @since Twenty Ten 1.0
 */
function xiaohan_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function xiaohan_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'xiaohan_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function xiaohan_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'xiaohan_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function xiaohan_continue_reading_link() {
	return '';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and xiaohan_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function xiaohan_auto_excerpt_more( $more ) {
	return ' &hellip;' . xiaohan_continue_reading_link();
}
add_filter( 'excerpt_more', 'xiaohan_auto_excerpt_more' );

function utf8_CsubStr($str,$start,$len,$suffix='...'){
preg_match_all('#(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+)#s',$str,$array, PREG_PATTERN_ORDER);
$from1 = 0; $len1 = 0; $s = '';
foreach($array[0] as $key => $val){
$n = ord($val) >= 128 ? 2 : 1;
$from1 += $n;
if($from1 > $start){
$len1+=$n;
if($len1 <= $len) $s .= $val;
else return $s.$suffix;
}
}
return $s;
}

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function xiaohan_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= xiaohan_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'xiaohan_custom_excerpt_more' );

add_filter( 'use_default_gallery_style', '__return_false' );
/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
 
function xiaohan_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'xiaohan_remove_gallery_css' );

if ( ! function_exists( 'xiaohan_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own xiaohan_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function xiaohan_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'xiaohan' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'xiaohan' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'xiaohan' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'xiaohan' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'xiaohan' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'xiaohan'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override xiaohan_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function xiaohan_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( '小工具一', 'xiaohan' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'xiaohan' ),
		'before_widget' => '<div id="%1$s" class="block">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( '小工具二', 'xiaohan' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'xiaohan' ),
		'before_widget' => '<div id="%1$s" class="block">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	
}
/** Register sidebars by running xiaohan_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'xiaohan_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function xiaohan_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'xiaohan_remove_recent_comments_style' );

if ( ! function_exists( 'xiaohan_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function xiaohan_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'xiaohan' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'xiaohan' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'xiaohan_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function xiaohan_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'xiaohan' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'xiaohan' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'xiaohan' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;




function cut_word_utf8($str, $len, $etc='')
{
//    Parameters:{
//    str: The string you want to cut.
//    len: The display width of a string you want.(A alpha take one and a Chinese take two).
//    etc: Add a string '...' after the cuted string.
//    Get the display width of the string.
    $i =0;
    $j =0;
    $str_width = 0;
    do{
            if(ord($str[$i]) > 224){
                    $str_width += 2;
                    $i += 3;
                }
            else if(ord($str[$i] > 192)){
                    $str_width += 2;
                    $i += 2;
                }
            else{
                    $str_width++;
                    $i++;
                }
        }while($i<strlen($str));
    //IF the display width is shorter than you want ,return the string.
    if($str_width < $len)
        {
            return $str;
        }
    else{
            $i = 0;
            $j = 0;
            $newword = '';
            do{
                    //If the character is a Chinese
                    if(ord($str[$i]) > 224){
                            $newword .= $str[$i].$str[$i+1].$str[$i+2];
                            $i = $i +3;
                            $j =$j + 2;
                        }
                    //If the character is a symble
                    else if(ord($str[$i] > 192)){
                            $newword .= $str[$i].$str[$i+1];
                            $i = $i + 2;
                            $j = $j + 2;
                        }
                    //If the character is a alpha
                    else{
                            $newword .= $str[$i];
                            $i++;
                            $j++;
                        }
                }while($j<$len);
            return $newword . $etc;
        }
}

function lpa_replace_content($content)
{
	// Get data from database
	$lpa_post_wordcut = get_option("lpa_post_wordcut");
	
	$lpa_post_letters = get_option("lpa_post_letters");
	$lpa_post_linktext = get_option("lpa_post_linktext");
	$lpa_post_ending = get_option("lpa_post_ending");
	
	$lpa_post_home = get_option("lpa_post_home");
	$lpa_post_category = get_option("lpa_post_category");
	$lpa_post_archive = get_option("lpa_post_archive");
	$lpa_post_search = get_option("lpa_post_search");
	$lpa_striptags = get_option("lpa_striptags");

	// If post letters are not set, default is set to 300
	if ($lpa_post_letters == ""){
		$lpa_post_letters = 300;
	}
	if ( is_home() || is_category() || is_archive() || is_search() ) {
		
			$paragraphcut = explode('</p>', $content);
			global $post;
			$ismoretag = explode('<!--',$post->post_content);
			$ismoretag2 = explode('-->', $ismoretag[1]);
			if ($ismoretag2[0] != "more") {
				echo $paragraphcut[0];
				echo $lpa_post_ending;
				if ($lpa_post_linktext != ""){
					//mark080717 echo " <a href='" .get_permalink(). "' rel=\"nofollow\">".utf8_encode($lpa_post_linktext)."</a>";
					echo "<a href='" .get_permalink(). "' rel=\"nofollow\">".$lpa_post_linktext."</a>";
				}
				echo "</p>";
			}
			else {
				return $content;
			}
		}
		else {
			return $content;
		}
	
}
add_filter('the_content','lpa_replace_content');