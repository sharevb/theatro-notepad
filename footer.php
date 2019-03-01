<?php
/**
 * The template for displaying the footer.
 *
 * @package	In Theatro Veritas Notepad
 * @since	1.0
 * @author	ShareVB based on Anarcho Notepad from Arthur "Berserkr" Gareginyan <arthurgareginyan@gmail.com>
 * @copyright 	Copyright © 2015, ShareVB - Copyright © 2013-2015, Arthur Gareginyan
 * @link      	http://sharevb.net
 * @license   	http://www.gnu.org/licenses/gpl-3.0.html
 */
?>

<footer id="footer" role="contentinfo">

	<div class="notebook-bottom">
		<div class="notebook-bottom-row">
			<span class="notebook-bottom-left"></span>
			<span class="notebook-bottom-middle"></span>
			<span class="notebook-bottom-sidebar"></span>
			<span class="notebook-bottom-right"></span>
		</div>
	</div>

  <div class="site-info">

	<div id="footer-widgets">
		<span><?php dynamic_sidebar( 'footer-1' ); ?></span>
		<span><?php dynamic_sidebar( 'footer-2' ); ?></span>
		<span><?php dynamic_sidebar( 'footer-3' ); ?></span>
	</div>
	<br clear="all">

	<?php echo get_theme_mod('site-info'); ?>
  </div>

  <div class="footer">
	<?php wp_footer(); ?>
  </div>

</footer>
</body>
</html>