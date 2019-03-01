<?php
/**
 * The template for displaying Author bios.
 *
 * @package	In Theatro Veritas Notepad
 * @since	1.0
 * @author	ShareVB based on Anarcho Notepad from Arthur "Berserkr" Gareginyan <arthurgareginyan@gmail.com>
 * @copyright 	Copyright © 2015, ShareVB - Copyright © 2013-2015, Arthur Gareginyan
 * @link      	http://sharevb.net
 * @license   	http://www.gnu.org/licenses/gpl-3.0.html
 */
?>

<div class="author-info">
	<div class="author-avatar" >
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'theatro-notepad_author_bio_avatar_size', 80 ) ); ?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h2 class="author-title" ><?php _e( 'About the Author', 'theatro-notepad' ); ?></h2>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->