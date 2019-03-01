<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package	In Theatro Veritas Notepad
 * @since	1.0
 * @author	ShareVB based on Anarcho Notepad from Arthur "Berserkr" Gareginyan <arthurgareginyan@gmail.com>
 * @copyright 	Copyright © 2015, ShareVB - Copyright © 2013-2015, Arthur Gareginyan
 * @link      	http://sharevb.net
 * @license   	http://www.gnu.org/licenses/gpl-3.0.html
 */
?>

<?php get_header(); ?>

<section id="content" role="main">
<div class="content-row">
	<div class="notebook-left"></div>
	<div class="col01">
		<div id="mobilemenu"></div>

    <!-- YOU CAN EDIT FROM HERE -->

    <h1><?php _e('Page Not Found', 'theatro-notepad'); ?></h1>
    <p><?php _e('We\'re very sorry, but the page you requested has not been found! It may have been moved or deleted.', 'theatro-notepad'); ?></p>
    <p><?php _e('I\'m not blaming you, but have you checked your address bar? There might be a typo in the URL.', 'theatro-notepad'); ?></p>
    <p><?php _e('If there isn\'t, you could try searching my website for the content you were looking for:', 'theatro-notepad'); ?></p>
    <?php get_search_form(); ?>

    <!-- YOU CAN EDIT UP TO HERE -->

  </div>

  <?php get_sidebar(); ?>
	<div class="notebook-right"></div>
	</div>  
</section><br clear="all" />

<?php get_footer(); ?>