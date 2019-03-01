<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * @package	In Theatro Veritas Notepad
 * @since	1.0
 * @author	ShareVB based on Anarcho Notepad from Arthur "Berserkr" Gareginyan <arthurgareginyan@gmail.com>
 * @copyright 	Copyright © 2015, ShareVB - Copyright © 2013-2015, Arthur Gareginyan
 * @link      	http://sharevb.net
 * @license   	http://www.gnu.org/licenses/gpl-3.0.html
 */
?>

<div class="sidebar-cell">
<aside id="sidebar" role="complementary">
<div class="mobile-head"></div>
<div class="sidebar-inner">
<!--PAGES (MENU)-->
<nav class="pages">
    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
</nav>
<div class="pages-bottom"></div>
<!--END-PAGES (MENU)-->

<!--FOLLOW-->
<?php if(get_theme_mod('disable_rss_icon') !== '1') {  ?>
  <div class="follow">
     <a href="<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow" >
        <img src="<?php echo get_template_directory_uri(); ?>/images/follow.png" alt="RSS" />
     </a>
  </div>
<?php }  ?>
<!--END-FOLLOW-->

<?php dynamic_sidebar( 'sidebar-1' ); ?>

<!--ABOUT BOX-->
<?php if(get_theme_mod('disable_about_box') !== '1') {  ?>
<div class="about-box">
  <p>
    <?php echo sanitize_text_field(get_theme_mod('about_box')); ?>
  </p>
</div>
<?php }  ?>
<!--END-ABOUT BOX-->

<?php dynamic_sidebar( 'sidebar-2' ); ?>

<!--LINKS BOX-->
<?php if(get_theme_mod('disable_links_box') !== '1') {  ?>
<div class="links-box">
  <p>
    <ul>
	<?php wp_list_bookmarks('categorize=0&title_li='); ?>
    </ul>
  </p>
</div>
<?php }  ?>
<!--END-LINKS BOX-->

<?php dynamic_sidebar( 'sidebar-3' ); ?>

<!--RECENT POSTS-->
<?php if(get_theme_mod('disable_recent_sticker') !== '1') {  ?>
<div class="recent-posts-upper"></div>
 <nav class="recent-posts">
    <?php $num_recent_post = get_theme_mod('num_recent_post'); ?>
    <?php $query = new WP_Query( array( 'posts_per_page' => $num_recent_post ) ); ?>
    <?php while ($query->have_posts()): $query->the_post(); ?>
    <ul>
       <li>
            <a href="<?php the_permalink(); ?>"><i class="fa fa-asterisk"></i>&nbsp;&nbsp;<?php the_title(); ?></a>
       </li>
    </ul>
    <?php endwhile; ?>
 </nav>
<div class="recent-posts-bottom"></div>
<?php }  ?>
<!--END-RECENT POSTS-->

<?php dynamic_sidebar( 'sidebar-4' ); ?>
</div>
</aside><!--<br clear="all" />-->
</div>