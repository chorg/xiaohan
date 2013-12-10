<div class="clear"></div>
<div id="footer">
    <div class="foot">
    	<a id="gotop" href="javascript:void(0);" onclick="MGJS.goTop();return false;"><?php _e('Top', 'xiaohan'); ?></a>
		<a id="powered" href="http://wordpress.org/">WordPress</a>
    	<div class="copy"><p><?php _e('Copyright &copy; ', 'xiaohan');?> 2013 <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> <?php $options = get_option('xiaohan_options'); if ($options['stat_content']) : ?>  <?php echo($options['stat_content']); ?><?php endif; ?><br />
 Valid <a href="http://validator.w3.org/check?uri=referer">XHTML 1.1</a> and <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">CSS 3</a>  <?php echo get_num_queries(); ?>querys in <?php echo timer_stop(); ?> seconds.<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F7b53ce4af14f96067e59385be2fee2e4' type='text/javascript'%3E%3C/script%3E"));
</script>｜<script type="text/javascript" src="http://tajs.qq.com/stats?sId=25553603" charset="UTF-8"></script>
</p></div>
		<?php wp_footer(); ?>
	</div>
</div>
</div>
</body>
</html>