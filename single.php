<?php
get_header(); ?>
	<div id="container" class="article">
    	<div class="content">
        	<?php 
				$options = get_option('xiaohan_options');
				$wbid=$options['notice_content'];
				if ($options['notice'] && $options['notice_content'] && in_category($wbid)) {
				?>
            <div class="place">
				<a title="<?php _e('Go to homepage', 'xiaohan'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'xiaohan'); ?></a> &gt; <?php the_category(', '); ?> &gt; <?php the_title(); ?>
            </div>
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="wblist" id="post-<?php the_ID(); ?>">
            	<div class="ava_img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 48 ) ); ?></div>
                <div class="wbinfo">
                	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                    <div class="intro">
						<?php the_content(); ?>
					</div>
                    <div class="info">
                    	<div class="date"><?php the_time(__('n'));?>月<?php the_time(__('j'))?>日 <?php the_time(__(' h:s')) ?></div>
                        <div class="comm"><?php comments_popup_link('评论（<em>0</em>）', '评论（<em>1</em>）', '评论（<em>%</em>）', '评论关闭'); ?></div>
					</div>
                </div>
            </div>
            <?php endwhile;endif; ?>    
			
			<?php }else{ ?>
        	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="place">
				<a title="<?php _e('Go to homepage', 'xiaohan'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'xiaohan'); ?></a> &gt; <?php the_category(', '); ?> &gt; <?php the_title(); ?>
			</div>
            <div class="post" id="post-<?php the_ID(); ?>">
            	<div class="date"><span><?php the_time(__('Y')) ?></span><span class="f"><?php the_time(__('m')) ?>月<?php the_time(__('j')) ?></span></div>
            	<h2><a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="info">
					<span class="author"><?php the_author_posts_link(); ?></span>
                    <span>分类：<?php the_category(','); ?> | </span>
                    <span>标签：<?php the_tags('', ', ', ''); ?> | </span>		
                    <span>浏览：<?php if(function_exists('the_views')) { the_views(); } ?></span>
                    <?php edit_post_link(__('Edit', 'xiaohan'), '','&raquo;'); ?>	
                    <span class="comments"><?php comments_popup_link('<em>0</em> ', '<em>1</em> ', '<em>%</em> ', 'Comments off'); ?></span>
                    <?php if ($comments || comments_open()) : ?>
					<span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'xiaohan'); ?></a></span>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
				<div class="con" id="a<?php the_ID(); ?>">
					<?php the_content(); ?>
                    <div style="margin-bottom:10px">
                <!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<a class="bds_qzone">QQ空间</a>
<a class="bds_tsina">新浪微博</a>
<a class="bds_tqq">腾讯微博</a>
<a class="bds_sqq">QQ好友</a>
<a class="bds_tqf">腾讯朋友</a>
<a class="bds_renren">人人网</a>
<a class="bds_t163">网易微博</a>
<a class="bds_copy">复制网址</a>
<span class="bds_more">更多</span>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=15373" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END --></div>
					<div class="clear"></div>
				</div>
                <div class="under">
					<p>文章作者：<a href="<?php echo get_option('home'); ?>/"><?php the_author(); ?></a><br />本文地址：<a href="<?php the_permalink() ?>"><?php the_permalink() ?></a><br />版权所有 &copy; 转载时必须以链接形式注明作者和原始出处！</p>
				</div>
            </div>
            <div id="postnavi">
				<span class="prev">&laquo; <?php next_post_link('%link') ?></span>
				<span class="next"><?php previous_post_link('%link') ?> &raquo;</span>
				<div class="clear"></div>
			</div>
            <div class="like">
            	<?php
$backup = $post;
$tags = wp_get_post_tags($post->ID);
$tagIDs = array();
if ($tags) {
echo '<h4>或许你会感兴趣的文章</h4>';
echo '<ul>';
$tagcount = count($tags);
for ($i = 0; $i < $tagcount; $i++) {
$tagIDs[$i] = $tags[$i]->term_id;
}
$args=array(
'tag__in' => $tagIDs,
'post__not_in' => array($post->ID),
'showposts'=>8, // 显示相关日志篇数 
'caller_get_posts'=>1
);
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
while ($my_query->have_posts()) : $my_query->the_post(); ?>
<li><span><?php the_time(__('Y-m-d')) ?></span><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endwhile;
echo '</ul>';
} else { ?>
<ul>
<?php
query_posts(array('orderby' => 'rand', 'showposts' => 8)); //显示随机日志篇数
if (have_posts()) :
while (have_posts()) : the_post();?>
<li><span><?php the_time(__('Y-m-d')) ?></span><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php endwhile;endif; ?>
</ul>
<?php }
}
$post = $backup;
wp_reset_query();
?>

            </div>
            <?php endwhile;else : ?>
            <div class="errorbox">
            	<?php _e('Sorry, no posts matched your criteria.', 'xiaohan'); ?>
			</div>
            <?php endif; ?>           
            <?php }?>
            <div class="comment_box">
            	<?php
	if (function_exists('wp_list_comments')) {
		comments_template('', true);
	} else {
		comments_template();
	}
?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>