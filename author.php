<?php
/**
 * The template for displaying Author page.
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
	<?php theatro_breadcrumbs(); ?>

	<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<?php endwhile; ?>
	<?php else : theatro_not_found(); endif; ?>
  </div>

  <?php get_sidebar(); ?>
     	<div class="notebook-right"></div>
	</div>   
</section><br clear="all" />

<?php get_footer(); ?>