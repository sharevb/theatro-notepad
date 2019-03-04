<?php
/**
 * Anarcho Notepad functions and definitions.
 *
 * @package    In Theatro Veritas Notepad
 * @since    1.0
 * @author    ShareVB based on Anarcho Notepad from Arthur "Berserkr" Gareginyan <arthurgareginyan@gmail.com>
 * @copyright    Copyright © 2015, ShareVB - Copyright © 2013-2015, Arthur Gareginyan
 * @link        http://sharevb.net
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 */

/* Ladies and Gentleman, boys and girls let's start our engine */


function theatro_notepad_setup() {
	global $content_width;

	// Localization Init
	load_theme_textdomain( 'theatro-notepad', get_template_directory() . '/languages' );

	// This feature enables Custom Backgrounds.
	add_theme_support( 'custom-background', array(
		'default-image' => get_template_directory_uri() . '/images/background.jpg',
	) );

	// This feature enables Custom Header.
	add_theme_support( 'custom-header', array(
		'flex-width'  => true,
		'width'       => 500,
		'flex-height' => true,
		'height'      => 150,
		//'default-text-color'     => '#e5e5e5',
		'header-text' => true,
		//'default-image' 	   => get_template_directory_uri() . '/images/logotype.jpg',
		'uploads'     => true,
	) );

	// This feature enables Featured Images (also known as post thumbnails).
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 540, 230, ! 1 );

	// This feature enables post and comment RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Add HTML5 elements
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', 'gallery', 'caption', ) );

	// Add Title-tag
	add_theme_support( 'title-tag' );

	// This feature enables menu.
	register_nav_menus( array(
		'primary' => __( 'Primary', 'theatro-notepad' )
	) );

	// This feature enables Link Manager in Admin page.
	add_filter( 'pre_option_link_manager_enabled', '__return_true' );
}

add_action( 'after_setup_theme', 'theatro_notepad_setup' );

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}

add_filter( 'language_attributes', 'add_opengraph_doctype' );

function theatro_summary( $str, $limit = 100, $strip = false ) {
	$str = ( $strip == true ) ? strip_tags( $str ) : $str;
	if ( strlen( $str ) > $limit ) {
		$str = substr( $str, 0, $limit - 3 );

		return ( substr( $str, 0, strrpos( $str, ' ' ) ) . '...' );
	}

	return trim( $str );
}

//Lets add Open Graph Meta Info
function insert_fb_in_head() {
	global $post;
	if ( ! is_singular() ) //if it is not a post or a page
	{
		return;
	}

	$content = $post->post_content;
	$content = theatro_summary( $content, 300, true );
	//$content = str_replace( ']]>', ']]&gt;', $content );

	//echo '<meta property="fb:admins" content="YOUR USER ID"/>';
	echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	echo '<meta property="og:type" content="article"/>';
	echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	echo '<meta property="og:description" content="' . esc_attr( $content ) . '"/>';
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '"/>';
	if ( ! has_post_thumbnail( $post->ID ) ) { //the post does not have featured image, use a default image
		$default_image = get_site_icon_url(); //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . esc_attr( $default_image ) . '"/>';
	} else {
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "
";
}

add_action( 'wp_head', 'insert_fb_in_head', 5 );

function theatro_show_post( $show_post_nav = false, $show_full = false ) {
	global $post;
	?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php theatro_ribbons(); ?>
        <h1><a href="<?php the_permalink() ?>" rel="bookmark"
               title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?> - <?php the_tags_text(); ?></a>
        </h1>
        <div class="post-inner">

            <br clear="all"/>
			<?php $name = get_post_meta( $post->ID, 'ExternalUrl', true );
			if ( $name ) { ?>
                <a href="<?php echo $name; ?>"><?php the_post_thumbnail(); ?></a>
			<?php } else {
				the_post_thumbnail();
			} ?>

            <div class="infos">
				<?php the_terms( $post->ID, 'playwriter', '<p class="author"><span class="author-label">de :</span> ', ', ', '</p>' ); ?>
				<?php the_terms( $post->ID, 'director', '<p class="director"><span class="director-label">mise en scène :</span> ', ', ', '</p>' ); ?>
				<?php the_terms( $post->ID, 'theater', '<p class="theater"><span class="theater-label">lieu :</span> ', ', ', '</p>' ); ?>
				<?php $dates = get_post_meta( $post->ID, 'DateAndHours', true );
				if ( $dates ) {
					echo '<p class="dates"><span class="dates-label">horaires :</span> ' . $dates . '</p>';
				}
				?>
				<?php if ( $name ) { ?>
                    <p><span class="external-url">Voir sur : </span> <a href="<?php echo $name; ?>">site du théatre</a>
                    </p>
				<?php } ?>
				<?php the_terms( $post->ID, 'actor', '<p class="actors"><span class="actors-label">avec :</span> ', ', ', '</p>' ); ?>
            </div>

			<?php
			$previous_link = get_post_meta( $post->ID, 'PreviousUrl', true );
			if ( $previous_link ) {
				echo '<p class="jendisais"><a href="' . esc_url( $previous_link ) . '">Voir mon article précédent</a></p>';
			}
			$show_full ? the_content( __( 'Continue reading', 'theatro-notepad' ) ) : the_excerpt();

			?>
        </div>
		<?php theatro_entry_meta(); ?>
		<?php if ( $show_post_nav ) {
			theatro_post_nav();
		} ?>
    </article>
	<?php
}

function theatro_custom_query_vars( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
		if ( $query->is_category( 4 ) ) {
			$query->set( 'meta_query', array(
				'relation' => 'OR',
				array(
					'key'     => 'EndDate',
					'value'   => date( 'Y-m-d' ),
					'compare' => '>=',
					'type'    => 'DATE',
				),
				array( 'key' => 'EndDate', 'compare' => 'NOT EXISTS' )
			) );
		} else if ( $query->is_category( 172 ) ) {
			$query->set( 'cat', null );
			$query->set( 'category_name', null );
			$query->set( 'category__in', array( 4, 258 ) );
			$query->set( 'meta_query', array(
				array(
					'key'     => 'StartDate',
					'value'   => date( 'Y-m-d' ),
					'compare' => '>',
					'type'    => 'DATE'
				)
			) );
		} else if ( $query->is_category( 257 ) ) {
			$query->set( 'cat', null );
			$query->set( 'category_name', null );
			$query->set( 'category__in', array( 4, 258 ) );
			$query->set( 'meta_query', array(
				'relation' => 'AND',
				array( 'key' => 'EndDate', 'compare' => 'EXISTS' ),
				array(
					'key'     => 'EndDate',
					'value'   => array(
						date( 'Y-m-d' ),
						date( 'Y-m-d', mktime( 0, 0, 0, date( "m" ), date( "d" ) + 15, date( "Y" ) ) )
					),
					'compare' => 'BETWEEN',
					'type'    => 'DATE'
				),
				array(
					'relation' => 'OR',
					array(
						'key'     => 'StartDate',
						'value'   => date( 'Y-m-d' ),
						'compare' => '>',
						'type'    => 'DATE'
					),
					array( 'key' => 'StartDate', 'compare' => 'NOT EXISTS' )
				)
			) );
		}
	}

	return $query;
}

add_action( 'pre_get_posts', 'theatro_custom_query_vars' );

//Adding backwards compatibility for title-tag less than WordPress version 4.1
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theatro_render_title() {
		?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}

	add_action( 'wp_head', 'theatro_render_title' );
}

/* Add Theme Information Page */
require get_template_directory() . '/inc/theme_info.php';

/* Add Theme Customizer functionality */
require get_template_directory() . '/inc/customizer.php';

/* Add IE conditional HTML5 shim to header */
function theatro_add_ie_html5_shim() {
	global $is_IE;
	if ( $is_IE ) {
		echo '<!--[if lt IE 9]>';
	}
	echo '<script src="', get_template_directory_uri() . '/js/html5.js"></script>';
	echo '<![endif]-->';
}

add_action( 'wp_head', 'theatro_add_ie_html5_shim' );

/* This feature enables widgets area in the sidebar */
function theatro_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Area 1', 'theatro-notepad' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Widgets in this area will be shown below "Pages".', 'theatro-notepad' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Area 2', 'theatro-notepad' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Widgets in this area will be shown below "What is this place".', 'theatro-notepad' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Area 3', 'theatro-notepad' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Widgets in this area will be shown below "Friends & Links".', 'theatro-notepad' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Area 4', 'theatro-notepad' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Widgets in this area will be shown below "Recent Posts".', 'theatro-notepad' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'theatro_widgets_init' );

/* This feature enables widgets area in the footer */
function theatro_widgets_footer_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Area 1', 'theatro-notepad' ),
		'id'            => 'footer-1',
		'description'   => __( 'Widgets in this area will be shown left.', 'theatro-notepad' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Area 2', 'theatro-notepad' ),
		'id'            => 'footer-2',
		'description'   => __( 'Widgets in this area will be shown center.', 'theatro-notepad' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Area 3', 'theatro-notepad' ),
		'id'            => 'footer-3',
		'description'   => __( 'Widgets in this area will be shown right.', 'theatro-notepad' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'theatro_widgets_footer_init' );

/* Adds a custom default avatar */
function theatro_avatar( $avatar_defaults ) {
	$myavatar                     = get_stylesheet_directory_uri() . '/images/anarchy-symbol.png';
	$avatar_defaults[ $myavatar ] = 'Anarcho symbol';

	return $avatar_defaults;
}

add_filter( 'avatar_defaults', 'theatro_avatar' );

/* Include Font-Awesome styles */
function theatro_include_font_awesome_styles() {
	wp_register_style( 'font_awesome_styles', get_template_directory_uri() . '/fonts/font-awesome-4.4.0/css/font-awesome.min.css', 'screen' );
	wp_enqueue_style( 'font_awesome_styles' );
}

add_action( 'wp_enqueue_scripts', 'theatro_include_font_awesome_styles' );

/* Enable smoothscroll.js */
function theatro_include_smoothscroll_script() {
	wp_enqueue_script( 'back-top', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), '', true );
}

add_action( 'wp_enqueue_scripts', 'theatro_include_smoothscroll_script' );

/* Display block "About the Author" */
function theatro_author_bio() {
	if ( get_theme_mod( 'disable_about_bio' ) !== '1' ) {
		if ( ( get_the_author_meta( 'description' ) != '' ) ) {
			echo esc_html( get_template_part( 'author-bio' ) );
		}
	}
}

/* Red data ribbons */
function theatro_ribbons() {
	if ( get_theme_mod( 'disable_ribbons' ) !== '1' ) {
		if ( get_theme_mod( 'enable_year_ribbons' ) !== '1' ) {
			if ( is_home() || is_category() || is_archive() || is_search() ) {
				printf( '<a href="%1$s">',
					esc_url( get_permalink() )
				);
			}
			printf( '<div class="date-tab">
                     <span class="month">%1$s</span>
                     <span class="day">%2$s</span>
                 </div><!-- .date-tab -->',
				esc_attr( get_the_date( 'F' ) ),
				esc_attr( get_the_date( 'j' ) )
			);
			if ( is_home() || is_category() || is_archive() || is_search() ) {
				printf( '</a>' );
			}
		} else {
			if ( is_home() || is_category() || is_archive() || is_search() ) {
				printf( '<a href="%1$s">',
					esc_url( get_permalink() )
				);
			}
			printf( '<div class="date-tab">
                     <span class="month">%1$s</span>
                     <span class="day">%2$s</span>
                 </div><!-- .date-tab -->',
				esc_attr( get_the_date( 'F j' ) ),
				esc_attr( get_the_date( 'Y' ) )
			);
			if ( is_home() || is_category() || is_archive() || is_search() ) {
				printf( '</a>' );
			}
		}
	}
}

/* Enable Breadcrumbs */
function theatro_breadcrumbs() {
	if ( get_theme_mod( 'enable_breadcrumbs' ) == '1' ) {
		$delimiter = '&raquo;';
		$before    = '<span>';
		$after     = '</span>';
		echo '<nav id="breadcrumbs">';
		global $post;
		$homeLink = esc_url( home_url() );
		echo '<a href="' . $homeLink . '" style="font-family: FontAwesome; font-size: 20px; vertical-align: bottom;">&#xf015;</a> ' . $delimiter . ' ';
		if ( is_category() ) {
			global $wp_query;
			$cat_obj   = $wp_query->get_queried_object();
			$thisCat   = $cat_obj->term_id;
			$thisCat   = get_category( $thisCat );
			$parentCat = get_category( $thisCat->parent );
			if ( $thisCat->parent != 0 ) {
				echo( get_category_parents( $parentCat, true, ' ' . $delimiter . ' ' ) );
			}
			echo $before . single_cat_title( '', false ) . $after;
		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time( 'd' ) . $after;
		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time( 'F' ) . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time( 'Y' ) . $after;
		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug      = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				echo ' ' . get_category_parents( $cat, true, ' ' . $delimiter . ' ' ) . ' ';
				echo $before . __( 'You currently reading ', 'theatro-notepad' ) . '"' . get_the_title() . '"' . $after;
			}
			/* } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				echo $before . $post_type->labels->singular_name . $after;*/
		} elseif ( is_attachment() ) {
			$parent_id   = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page          = get_page( $parent_id );
				$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
				$parent_id     = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			foreach ( $breadcrumbs as $crumb ) {
				echo ' ' . $crumb . ' ' . $delimiter . ' ';
			}
			echo $before . 'You&apos;re currently viewing "' . get_the_title() . '"' . $after;
		} elseif ( is_page() && ! $post->post_parent ) {
			echo $before . 'You&apos;re currently reading "' . get_the_title() . '"' . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id   = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page          = get_page( $parent_id );
				$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
				$parent_id     = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			foreach ( $breadcrumbs as $crumb ) {
				echo ' ' . $crumb . ' ' . $delimiter . ' ';
			}
			echo $before . __( 'You currently reading ', 'theatro-notepad' ) . '"' . get_the_title() . '"' . $after;
		} elseif ( is_search() ) {
			echo $before . __( 'Search results for ', 'theatro-notepad' ) . '"' . get_search_query() . '"' . $after;
		} elseif ( is_tag() ) {
			echo $before . __( 'Archive by tag ', 'theatro-notepad' ) . '"' . single_tag_title( '', false ) . '"' . $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			echo $before . __( 'Articles posted by ', 'theatro-notepad' ) . '"' . $userdata->display_name . '"' . $after;
		} elseif ( is_404() ) {
			echo $before . __( 'You got it ', 'theatro-notepad' ) . '"' . 'Error 404 not Found' . '"&nbsp;' . $after;
		} else {
			$term = get_term_by( "slug", get_query_var( "term" ), get_query_var( "taxonomy" ) );
			echo '<a href="/' . $term->slug . '">' . get_taxonomy( $term->taxonomy )->labels->singular_name . '</a> ' . $delimiter . ' ';
			$tmpTerm   = $term;
			$tmpCrumbs = array();
			while ( $tmpTerm->parent > 0 ) {
				$tmpTerm = get_term( $tmpTerm->parent, get_query_var( "taxonomy" ) );
				$crumb   = '<a href="' . get_term_link( $tmpTerm, get_query_var( 'taxonomy' ) ) . '">' . $tmpTerm->name . '</a>';
				array_push( $tmpCrumbs, $crumb );
			}
			echo implode( '', array_reverse( $tmpCrumbs ) );
			echo '<a href="' . get_term_link( $tmpTerm, get_query_var( 'taxonomy' ) ) . '">' . $term->name . '</a>';
		}
		if ( get_query_var( 'paged' ) ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo ' (';
			}
			echo ( 'Page' ) . ' ' . get_query_var( 'paged' );
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo ')';
			}
		}
		echo '</nav>';
	}
}

/*
 * Page Navigation
 * Display navigation to next/previous set of posts when applicable
 */
function theatro_page_nav() {
	if ( get_theme_mod( 'enable_page-nav' ) == '1' ) {
		global $wp_query, $wp_rewrite;
		$pages = '';
		$max   = $wp_query->max_num_pages;
		if ( ! $current = get_query_var( 'paged' ) ) {
			$current = 1;
		}
		$a['base']      = str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) );
		$a['total']     = $max;
		$a['current']   = $current;
		$total          = 0;
		$a['mid_size']  = 3;
		$a['end_size']  = 1;
		$a['prev_text'] = __( 'Previous page', 'theatro-notepad' );
		$a['next_text'] = __( 'Next page', 'theatro-notepad' );
		if ( $max > 0 ) {
			echo '<nav id="page-nav">';
		}
		if ( $total == 1 && $max > 0 ) {
			$pages = '<span class="pages-nav">' . __( 'Page ', 'theatro-notepad' ) . $current . __( ' of the ', 'theatro-notepad' ) . $max . '</span>' . "\r\n";
		}
		echo $pages . paginate_links( $a );
		if ( $max > 0 ) {
			echo '</nav><br/>';
		}
	} else {
		global $wp_query;

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}
		?>
        <nav class="navigation paging-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'theatro-notepad' ); ?></h1>
            <div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
                    <div class="nav-previous"><?php next_posts_link( '<i class="fa fa-arrow-left"></i> Older posts' ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
                    <div class="nav-next"><?php previous_posts_link( 'Newer posts <i class="fa fa-arrow-right"></i>' ); ?></div>
				<?php endif; ?>

            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
		<?php
	}
}

/*
 * Post navigation
 * Display navigation to next/previous post when applicable
 */
function theatro_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
    <nav class="navigation post-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'theatro-notepad' ); ?></h1>
        <div class="nav-links">

			<?php previous_post_link( '%link', '<i class="fa fa-arrow-left"></i> %title' ); ?>
			<?php next_post_link( '%link', '%title <i class="fa fa-arrow-right"></i>' ); ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
	<?php
}

/*
 * Comments
 * Enable comment_reply
 */
function theatro_include_comment_reply() {
	if ( is_singular() ) {
		wp_enqueue_script( "comment-reply" );
	}
}

add_action( 'wp_enqueue_scripts', 'theatro_include_comment_reply' );

/*
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function theatro_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments.
			?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php _e( 'Pingback:', 'theatro-notepad' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'theatro-notepad' ), '<span class="edit-link">', '</span>' ); ?></p>
			<?php
			break;
		default :
			// Proceed with normal comments.
			global $post;
			?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment">
                <header class="comment-meta comment-author vcard">
					<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite>By <b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( '(Post author) ', 'theatro-notepad' ) . '</span>' : ''
					);
					printf( '<b>on <a href="%1$s"><time datetime="%2$s">%3$s</time></a></b>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( '%1$s', get_comment_date( 'j F, Y' ) )
					);
					?>
                </header><!-- .comment-meta -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'theatro-notepad' ); ?></p>
				<?php endif; ?>

                <section class="comment-content comment">
					<?php comment_text(); ?>
					<?php edit_comment_link( __( 'Edit', 'theatro-notepad' ), '<p class="edit-link">', '</p>' ); ?>
                </section><!-- .comment-content -->

                <div class="reply">
					<?php comment_reply_link( array_merge( $args, array(
						'reply_text' => __( 'Reply', 'theatro-notepad' ),
						'after'      => ' <span>&darr;</span>',
						'depth'      => $depth,
						'max_depth'  => $args['max_depth']
					) ) ); ?>
                </div><!-- .reply -->
            </article><!-- #comment-## -->
			<?php
			break;
	endswitch; // end comment_type check
}

/*
 * Copyright
 * Enable info about copyright
 */
function theatro_copyright() {
	if ( get_theme_mod( 'disable_theatro_copy' ) !== '1' ) {
		$theatro_copy_uri  = "http://mycyberuniverse.com/author.html";
		$theatro_copy_text = 'Theme "In Theatro Notepad" designed and engineered by ShareVB based on "Anarcho Notepad" by Arthur "Berserkr" Gareginyan.';
		echo '<a title="Theme author" target="_blank" href=' . $theatro_copy_uri . '>' . $theatro_copy_text . '</a><br/>';
	}
}

add_action( 'wp_footer', 'theatro_copyright', 999 );

/*
 * Queries
 * Display info about a database queries
 */
function theatro_mysql_queries() {
	if ( get_theme_mod( 'show_info_line' ) == '1' ) {
		echo "\n";
		echo get_num_queries();
		_e( ' queries in ', 'theatro-notepad' );
		timer_stop( 1 );
		_e( ' seconds', 'theatro-notepad' );
		echo ' / ';
		echo round( memory_get_usage() / 1024 / 1024, 2 );
		_e( ' mb', 'theatro-notepad' );
		echo "\n";
	}
}

add_action( 'wp_footer', 'theatro_mysql_queries', 999 );

/*
 * Top Button
 * Enable Top Button
 */
function theatro_top_button() {
	if ( get_theme_mod( 'disable_top_button' ) !== '1' ) {
		echo '<a id="back-top" href="#top"><i class="fa fa-arrow-up fa-lg"></i></a>';
	}
}

add_action( 'wp_footer', 'theatro_top_button', 999 );
function the_post_inner_content() {
}

function theatro_taxo_init() {
	register_taxonomy( 'director', 'post', array(
		'label'   => __( 'Metteur en scène' ),
		'rewrite' => array( 'slug' => 'metteurs-en-scene' )
	) );
	register_taxonomy( 'actor', 'post', array(
		'label'   => __( 'Comédien' ),
		'rewrite' => array( 'slug' => 'comediens' )
	) );
	register_taxonomy( 'playwriter', 'post', array(
		'label'   => __( 'Auteur' ),
		'rewrite' => array( 'slug' => 'auteurs' )
	) );
	register_taxonomy( 'theater', 'post', array(
		'label'   => __( 'Théâtre' ),
		'rewrite' => array( 'slug' => 'theatres' )
	) );
}

add_action( 'init', 'theatro_taxo_init' );
/*
 * No Content
 * The Message if no content
 */
function theatro_not_found() {
	?>
    <div class="no-results">
        <h1>Pas d'articles</h1>
        <p>Il n'y a pas encore d'articles ici !</p>
    </div>
	<?php
}

function get_tags_text() {
	$ret      = '';
	$posttags = get_the_tags();
	if ( $posttags ) {
		foreach ( $posttags as $tag ) {
			$ret .= $tag->name . ' ';
		}
	}

	return $ret;
}

function the_tags_text() {
	echo get_tags_text();
}

function get_terms_text( $type ) {
	$terms = get_the_terms( get_the_ID(), $type );
	if ( $terms && ! is_wp_error( $terms ) ) {
		$ret = array();
		foreach ( $terms as $term ) {
			$ret[] = $term->name;
		}

		return join( ", ", $ret );
	}

	return '';
}

// add custom feed content
function add_feed_title( $content ) {
	if ( is_feed() ) {
		$content .= ' - ' . get_tags_text();
	}

	return $content;
}

function add_feed_content( $content ) {
	if ( is_feed() ) {
		$h = array();
		$v = get_terms_text( 'playwriter' );
		if ( $v ) {
			$h[] = 'de ' . $v;
		}
		$v = get_terms_text( 'director' );
		if ( $v ) {
			$h[] = 'mise en scène par ' . $v;
		}
		$v = get_terms_text( 'theater' );
		if ( $v ) {
			$h[] = $v;
		}
		if ( sizeof( $h ) > 0 ) {
			$content = '<p>' . join( ", ", $h ) . '</p><br/>' . $content;
		}
	}

	return $content;
}

add_filter( 'the_excerpt_rss', 'add_feed_content' );
add_filter( 'the_content', 'add_feed_content' );
add_filter( 'the_title', 'add_feed_title' );

/*
 * Entry Meta
 * Display Entry Meta
 */
function theatro_entry_meta() {
	?>
    <div class="meta">
		<?php
		if ( is_page() ) {
			if ( ( the_category() != '' ) ) {
				?><i class="fa fa-folder-open"></i> <?php _e( 'Category: ', 'theatro-notepad' );
				the_category( ', ' );
			}
			edit_post_link( __( 'EDIT', 'theatro-notepad' ), ' | <i class="fa fa-pencil"> ', '</i>' );
		} elseif ( is_single() ) {
			echo 'Ecrit le ';
			the_date( get_option( 'm.d.Y' ) );
			echo ' dans les catégories ';
			the_category( ', ' );
			edit_post_link( __( 'EDIT', 'theatro-notepad' ), '" | <i class="fa fa-pencil"> ', '</i>' );
			?>
            <br/>
			<?php
			theatro_author_bio();
		} elseif ( is_home() || is_category() || is_archive() || is_search() ) {
			?><i class="fa fa-folder-open"></i> <?php _e( 'Category: ', 'theatro-notepad' );
			the_category( ', ' ); ?> | <i
                    class="fa fa-comment"></i> <?php comments_popup_link( __( 'LEAVE A COMMENT', 'theatro-notepad' ) );
			edit_post_link( __( 'EDIT', 'theatro-notepad' ), ' | <i class="fa fa-pencil"> ', '</i>' );
		} else {
			?><i class="fa fa-folder-open"></i> <?php _e( 'Category: ', 'theatro-notepad' );
			the_category( ', ' ); ?> | <i
                    class="fa fa-comment"></i> <?php comments_popup_link( __( 'LEAVE A COMMENT', 'theatro-notepad' ) );
			edit_post_link( __( 'EDIT', 'theatro-notepad' ), ' | <i class="fa fa-pencil"> ', '</i>' );
		}
		?>
        <div>
            <div class="fb-like" data-share="true" data-href="<?php the_permalink() ?>"></div>
        </div>
    </div>
	<?php
}

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more( $more ) {
	global $post;

	return ' <a class="moretag" href="' . get_permalink( $post->ID ) . '">[...]</a>';
}

add_filter( 'excerpt_more', 'new_excerpt_more' );