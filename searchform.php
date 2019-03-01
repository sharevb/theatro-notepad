<?php
/**
 * The template for displaying Searchform (HTML5).
 *
 * @package	In Theatro Veritas Notepad
 * @since	1.0
 * @author	ShareVB based on Anarcho Notepad from Arthur "Berserkr" Gareginyan <arthurgareginyan@gmail.com>
 * @copyright 	Copyright © 2015, ShareVB - Copyright © 2013-2015, Arthur Gareginyan
 * @link      	http://sharevb.net
 * @license   	http://www.gnu.org/licenses/gpl-3.0.html
 */
?>

<div id="search">
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>">
	<label>
		<span class="screen-reader-text"><?php _e('Search for:', 'theatro-notepad'); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Write your search and hit Enter', 'theatro-notepad'); ?>" value="" name="s" title="Search" />
	</label>
	<input type="submit" class="search-submit" value="Search" />
</form>
</div>