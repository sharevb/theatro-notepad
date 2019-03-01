<?php
/**
 * The template for displaying pages without date.
 *
 * Template Name: Page without date
 *
 * @package	Anarcho Notepad
 * @since	1.0
 * @author	Arthur "Berserkr" Gareginyan <arthurgareginyan@gmail.com>
 * @copyright 	Copyright (c) 2013-2015, Arthur Gareginyan
 * @link      	http://mycyberuniverse.com/theatro-notepad.html
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
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <h1><?php the_title(); ?></h1>
      <div class="post-inner">

	        <?php the_post_thumbnail(); ?>

		<?php the_content( __( 'Continue reading', 'theatro-notepad' ) ); ?>
      </div>

      <?php theatro_entry_meta(); ?>
    </article>
    <?php comments_template(); ?>
    <?php endwhile; ?>

    <?php else : theatro_not_found(); endif; ?>

  </div>

   <?php get_sidebar(); ?>
	<div class="notebook-right"></div>
	</div>   
</section><br clear="all" />

<?php get_footer(); ?>