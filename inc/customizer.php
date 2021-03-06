<?php
/**
 * Theme Customizer support
 *
 * @package	Anarcho Notepad
 * @since	2.24
 * @author	Arthur "Berserkr" Gareginyan <arthurgareginyan@gmail.com>
 * @copyright 	Copyright (c) 2013-2015, Arthur Gareginyan
 * @link      	http://mycyberuniverse.com/anarcho-notepad.html
 * @license   	http://www.gnu.org/licenses/gpl-3.0.html
 */


/* Implement Theme Customizer additions and adjustments */
function anarcho_customize_register( $wp_customize ) {

/* Class Anarcho_Customize_Textarea_Control */
class Anarcho_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>
        		<label>
        		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        		<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        		</label> <?php } }

   $wp_customize->remove_section( 'colors' );

   // META SECTION
   $wp_customize->add_section( 'meta_section', array(
		'title'				=> __( 'Meta', 'anarcho-notepad' ),
		'priority'			=> 1,
   ));

		// About box in sidebar
		$wp_customize->add_setting( 'about_box', array(
				'default'			=> __( 'Paste here small text about You and/or about site', 'anarcho-notepad' ),
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( new Anarcho_Customize_Textarea_Control( $wp_customize, 'about_box', array(
				'priority'			=> 1,
				'label'				=> __( 'About box - "What is this place?"', 'anarcho-notepad' ),
				'section'			=> 'meta_section',
				'settings'			=> 'about_box',
		)));

		// Copyright after post
		$wp_customize->add_setting( 'copyright_post', array(
				'default'			=> 'Copyright 2015. All rights reserved.',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( new Anarcho_Customize_Textarea_Control( $wp_customize, 'copyright_post', array(
				'priority'			=> 2,
				'label'				=> __( 'Copyright after post', 'anarcho-notepad' ),
				'section'			=> 'meta_section',
				'settings'			=> 'copyright_post',
		)));

		// Site-info in footer
		$wp_customize->add_setting( 'site-info', array(
				'default'			=> 'Copyright 2015. All rights reserved.',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( new Anarcho_Customize_Textarea_Control( $wp_customize, 'site-info', array(
				'priority'			=> 3,
				'label'				=> __( 'Site-info in footer', 'anarcho-notepad' ),
				'section'			=> 'meta_section',
				'settings'			=> 'site-info',
		)));

		// Disable copyright of the author of theme in footer
		$wp_customize->add_setting('disable_anarcho_copy', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'disable_anarcho_copy', array(
				'priority'			=> 4,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Disable copyright of the author of theme in footer', 'anarcho-notepad' ),
		        'section'			=> 'meta_section',
		));


   // STUFF SECTION
   $wp_customize->add_section( 'stuff_section', array(
		'title'				=> __( 'Stuff', 'anarcho-notepad' ),
		'priority'			=> 2,
   ));

		// Enable Title Animation
		$wp_customize->add_setting('enable_title_animation', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'enable_title_animation', array(
				'priority'			=> 1,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Enable "Title animation"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Disable "Paper Search"
		$wp_customize->add_setting('disable_paper_search', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'disable_paper_search', array(
				'priority'			=> 2,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Disable "Paper Search"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Disable box "What is this place"
		$wp_customize->add_setting('disable_about_box', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'disable_about_box', array(
				'priority'			=> 3,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Disable box "What is this place?"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Disable box "Friends & Links"
		$wp_customize->add_setting('disable_links_box', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'disable_links_box', array(
				'priority'			=> 4,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Disable box "Friends & Links"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Enable Year in Red Data Ribbons
		$wp_customize->add_setting('enable_year_ribbons', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'enable_year_ribbons', array(
				'priority'			=> 5,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Enable Year in "Red Data Ribbons"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Disable Red Data Ribbons
		$wp_customize->add_setting('disable_ribbons', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'disable_ribbons', array(
				'priority'			=> 6,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Disable "Red Data Ribbons"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Disable Recent Posts Sticker
		$wp_customize->add_setting('disable_recent_sticker', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'disable_recent_sticker', array(
				'priority'			=> 7,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Disable "Recent Posts Sticker"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Enable "Breadcrumbs"
		$wp_customize->add_setting('enable_breadcrumbs', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'enable_breadcrumbs', array(
				'priority'			=> 8,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Enable "Breadcrumbs"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Enable "Page Navigation"
		$wp_customize->add_setting('enable_page-nav', array(
				'default'           => '1',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'enable_page-nav', array(
				'priority'			=> 9,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Enable "Page Navigation"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Disable "About the Author"
		$wp_customize->add_setting('disable_about_bio', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'disable_about_bio', array(
				'priority'			=> 10,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Disable block "About the Author"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Disable button "To Top"
		$wp_customize->add_setting('disable_top_button', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'disable_top_button', array(
				'priority'			=> 11,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Disable button "To Top"', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Show info line in footer
		$wp_customize->add_setting('show_info_line', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'show_info_line', array(
				'priority'			=> 12,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Show info line in footer', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Disable RSS icon in sidebar
		$wp_customize->add_setting('disable_rss_icon', array(
				'default'           => '0',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'disable_rss_icon', array(
				'priority'			=> 13,
		        'type'				=> 'checkbox',
		        'label'				=> __( 'Disable RSS icon in sidebar', 'anarcho-notepad' ),
		        'section'			=> 'stuff_section',
		));

		// Create an Array for number of recent post
		$num_recent_post_array = array(
				'2' => '3',
				'3' => '4',
				'4' => '5',
				'5' => '6',
				'6' => '7',
				'7' => '8',
				'8' => '9',
				'9' => '10'
		);
		// Enable number of recent post
		$wp_customize->add_setting( 'num_recent_post', array(
				'default'	           	=> '6',
				'control'               => 'select',
				'sanitize_callback'		=> 'esc_attr',
		));
		$wp_customize->add_control( 'num_recent_post', array(
				'label'					=> __('Numbers of recent posts in sidebar', 'anarcho-notepad'),
				'priority'				=> 14,
				'section'				=> 'stuff_section',
				'settings'				=> 'num_recent_post',
				'type'					=> 'select',
				'choices'				=> $num_recent_post_array,
		));

    // SCRIPTS SECTION
    $wp_customize->add_section( 'scripts_section', array(
		'title'				=> __( 'Scripts', 'anarcho-notepad' ),
		'description'       => __( 'Put here your scripts', 'anarcho-notepad' ),
		'priority'			=> 3,
    ));

		// Scripts before posts
		$wp_customize->add_setting( 'scripts_before_posts', array(
				'Default'               => '',
				'sanitize_callback'     => 'esc_attr',
		));
		$wp_customize->add_control( new Anarcho_Customize_Textarea_Control( $wp_customize, 'scripts_before_posts', array(
				'priority'              => 2,
				'label'                 => __( 'Scripts before posts', 'anarcho-notepad' ),
				'section'               => 'scripts_section',
				'settings'              => 'scripts_before_posts',
		)));

		// Scripts at the beginning of the posts
		$wp_customize->add_setting( 'scripts_beginning_posts', array(
				'Default'               => '',
				'sanitize_callback'     => 'esc_attr',
		));
		$wp_customize->add_control( new Anarcho_Customize_Textarea_Control( $wp_customize, 'scripts_beginning_posts', array(
				'priority'              => 3,
				'label'                 => __( 'Scripts at the beginning of the posts', 'anarcho-notepad' ),
				'section'               => 'scripts_section',
				'settings'              => 'scripts_beginning_posts',
		)));

		// Scripts at the end of the posts
		$wp_customize->add_setting( 'scripts_end_posts', array(
				'Default'               => '',
				'sanitize_callback'     => 'esc_attr',
		));
		$wp_customize->add_control( new Anarcho_Customize_Textarea_Control( $wp_customize, 'scripts_end_posts', array(
				'priority'              => 4,
				'label'                 => __( 'Scripts at the end of the posts', 'anarcho-notepad' ),
				'section'               => 'scripts_section',
				'settings'              => 'scripts_end_posts',
		)));

		// Scripts after posts
		$wp_customize->add_setting( 'scripts_after_posts', array(
				'Default'           	=> '',
				'sanitize_callback'		=> 'esc_attr',
		));
		$wp_customize->add_control( new Anarcho_Customize_Textarea_Control( $wp_customize, 'scripts_after_posts', array(
				'priority'              => 5,
				'label'                 => __( 'Scripts after posts', 'anarcho-notepad' ),
				'section'               => 'scripts_section',
				'settings'              => 'scripts_after_posts',
		)));

    // POST SECTION
    $wp_customize->add_section( 'post_section', array(
		'title'                         => __( 'Post', 'anarcho-notepad' ),
		'priority'                      => 10,
    ));

		// Create an Array for font size
		$font_size_array = array(
				'Default'               => 'Default',
				'80%'                   => '80%',
				'90%'                   => '90%',
				'100%'                  => '100%',
				'110%'                  => '110%',
				'120%'                  => '120%',
				'130%'                  => '130%',
				'140%'                  => '140%',
				'150%'                  => '150%'
		);

		// Enable font size for posts
		$wp_customize->add_setting( 'post_font_size', array(
				'Default'           => 'Default',
				'control'           => 'select',
				'sanitize_callback' => 'esc_attr',
		));
		$wp_customize->add_control( 'post_font_size', array(
				'label'             => __('Font size of posts', 'anarcho-notepad'),
				'priority'          => 1,
				'section'           => 'post_section',
				'settings'          => 'post_font_size',
				'type'              => 'select',
				'choices'           => $font_size_array,
		));

		// Create an Array with a ton of Google Fonts
		$google_font_array = array(
			'Default'				=> 'Default',
			'Questrial'				=> 'Questrial',
			'Astloch'				=> 'Astloch',
			'IM+Fell+English+SC'    => 'IM+Fell+English+SC',
			'Lekton'				=> 'Lekton',
			'Nova+Round'            => 'Nova+Round',
			'Nova+Oval'				=> 'Nova+Oval',
			'League+Script'         => 'League+Script',
			'Caudex'				=> 'Caudex',
			'IM+Fell+DW+Pica'			=> 'IM+Fell+DW+Pica',
			'Nova+Script'				=> 'Nova+Script',
			'Nixie+One'				=> 'Nixie+One',
			'IM+Fell+DW+Pica+SC'			=> 'IM+Fell+DW+Pica+SC',
			'Puritan'				=> 'Puritan',
			'Prociono'				=> 'Prociono',
			'Abel'					=> 'Abel',
			'Snippet'				=> 'Snippet',
			'Kristi'				=> 'Kristi',
			'Mako'					=> 'Mako',
			'Ubuntu+Mono'				=> 'Ubuntu+Mono',
			'Nova+Slim'				=> 'Nova+Slim',
			'Patrick+Hand'				=> 'Patrick+Hand',
			'Crafty+Girls'				=> 'Crafty+Girls',
			'Brawler'				=> 'Brawler',
			'Droid+Sans'				=> 'Droid+Sans',
			'Geostar'				=> 'Geostar',
			'Yellowtail'				=> 'Yellowtail',
			'Permanent+Marker'			=> 'Permanent+Marker',
			'Just+Another+Hand'			=> 'Just+Another+Hand',
			'Unkempt'				=> 'Unkempt',
			'Jockey+One'				=> 'Jockey+One',
			'Lato'					=> 'Lato',
			'Arvo'					=> 'Arvo',
			'Cabin'					=> 'Cabin',
			'Playfair+Display'			=> 'Playfair+Display',
			'Crushed'				=> 'Crushed',
			'Asset'					=> 'Asset',
			'Sue+Ellen+Francisco'			=> 'Sue+Ellen+Francisco',
			'Julee'					=> 'Julee',
			'Judson'				=> 'Judson',
			'Neuton'				=> 'Neuton',
			'Sorts+Mill+Goudy'			=> 'Sorts+Mill+Goudy',
			'Mate'					=> 'Mate',
			'News+Cycle'				=> 'News+Cycle',
			'Michroma'				=> 'Michroma',
			'Lora'					=> 'Lora',
			'Give+You+Glory'			=> 'Give+You+Glory',
			'Rammetto+One'				=> 'Rammetto+One',
			'Pompiere'				=> 'Pompiere',
			'PT+Sans'				=> 'PT+Sans',
			'Andika'				=> 'Andika',
			'Cabin+Sketch'				=> 'Cabin+Sketch',
			'Delius+Swash+Caps'			=> 'Delius+Swash+Caps',
			'Coustard'				=> 'Coustard',
			'Cherry+Cream+Soda'			=> 'Cherry+Cream+Soda',
			'Maiden+Orange'				=> 'Maiden+Orange',
			'Syncopate'				=> 'Syncopate',
			'PT+Sans+Narrow'			=> 'PT+Sans+Narrow',
			'Montez'				=> 'Montez',
			'Short+Stack'				=> 'Short+Stack',
			'Poller+One'				=> 'Poller+One',
			'Tinos'					=> 'Tinos',
			'Philosopher'				=> 'Philosopher',
			'Neucha'				=> 'Neucha',
			'Gravitas+One'				=> 'Gravitas+One',
			'Corben'				=> 'Corben',
			'Istok+Web'				=> 'Istok+Web',
			'Federo'				=> 'Federo',
			'Yeseva+One'				=> 'Yeseva+One',
			'Petrona'				=> 'Petrona',
			'Arimo'					=> 'Arimo',
			'Irish+Grover'				=> 'Irish+Grover',
			'Quicksand'				=> 'Quicksand',
			'Paytone+One'				=> 'Paytone+One',
			'Kelly+Slab'				=> 'Kelly+Slab',
			'Nova+Flat'				=> 'Nova+Flat',
			'Vast+Shadow'				=> 'Vast+Shadow',
			'Ubuntu'				=> 'Ubuntu',
			'Smokum'				=> 'Smokum',
			'Ruslan+Display'			=> 'Ruslan+Display',
			'La+Belle+Aurore'			=> 'La+Belle+Aurore',
			'Federant'				=> 'Federant',
			'Podkova'				=> 'Podkova',
			'IM+Fell+French+Canon'			=> 'IM+Fell+French+Canon',
			'PT+Serif+Caption'			=> 'PT+Serif+Caption',
			'The+Girl+Next+Door'			=> 'The+Girl+Next+Door',
			'Artifika'				=> 'Artifika',
			'Marck+Script'				=> 'Marck+Script',
			'Droid+Sans+Mono'			=> 'Droid+Sans+Mono',
			'Contrail+One'				=> 'Contrail+One',
			'Swanky+and+Moo+Moo'			=> 'Swanky+and+Moo+Moo',
			'Wire+One'				=> 'Wire+One',
			'Tenor+Sans'				=> 'Tenor+Sans',
			'Nova+Mono'				=> 'Nova+Mono',
			'Josefin+Sans'				=> 'Josefin+Sans',
			'Bitter'				=> 'Bitter',
			'Supermercado+One'			=> 'Supermercado+One',
			'PT+Serif'				=> 'PT+Serif',
			'Limelight'				=> 'Limelight',
			'Coda+Caption:800'			=> 'Coda+Caption:800',
			'Lobster'				=> 'Lobster',
			'Gentium+Basic'				=> 'Gentium+Basic',
			'Atomic+Age'				=> 'Atomic+Age',
			'Mate+SC'				=> 'Mate+SC',
			'Eater+Caps'				=> 'Eater+Caps',
			'Bigshot+One'				=> 'Bigshot+One',
			'Kreon'					=> 'Kreon',
			'Rationale'				=> 'Rationale',
			'Sniglet:800'				=> 'Sniglet:800',
			'Smythe'				=> 'Smythe',
			'Waiting+for+the+Sunrise'		=> 'Waiting+for+the+Sunrise',
			'Gochi+Hand'				=> 'Gochi+Hand',
			'Reenie+Beanie'				=> 'Reenie+Beanie',
			'Kameron'				=> 'Kameron',
			'Anton'					=> 'Anton',
			'Holtwood+One+SC'			=> 'Holtwood+One+SC',
			'Schoolbell'				=> 'Schoolbell',
			'Tulpen+One'				=> 'Tulpen+One',
			'Redressed'				=> 'Redressed',
			'Ovo'					=> 'Ovo',
			'Shadows+Into+Light'			=> 'Shadows+Into+Light',
			'Rokkitt'				=> 'Rokkitt',
			'Josefin+Slab'				=> 'Josefin+Slab',
			'Passero+One'				=> 'Passero+One',
			'Copse'					=> 'Copse',
			'Walter+Turncoat'			=> 'Walter+Turncoat',
			'Sigmar+One'				=> 'Sigmar+One',
			'Convergence'				=> 'Convergence',
			'Gloria+Hallelujah'			=> 'Gloria+Hallelujah',
			'Fontdiner+Swanky'			=> 'Fontdiner+Swanky',
			'Tienne'				=> 'Tienne',
			'Calligraffitti'			=> 'Calligraffitti',
			'UnifrakturCook:700'			=> 'UnifrakturCook:700',
			'Tangerine'				=> 'Tangerine',
			'Days+One'				=> 'Days+One',
			'Cantarell'				=> 'Cantarell',
			'IM+Fell+Great+Primer'			=> 'IM+Fell+Great+Primer',
			'Antic'					=> 'Antic',
			'Muli'					=> 'Muli',
			'Monofett'				=> 'Monofett',
			'Just+Me+Again+Down+Here'		=> 'Just+Me+Again+Down+Here',
			'Geostar+Fill'				=> 'Geostar+Fill',
			'Candal'				=> 'Candal',
			'Cousine'				=> 'Cousine',
			'Merienda+One'				=> 'Merienda+One',
			'Goblin+One'				=> 'Goblin+One',
			'Monoton'				=> 'Monoton',
			'Ubuntu+Condensed'			=> 'Ubuntu+Condensed',
			'EB+Garamond'				=> 'EB+Garamond',
			'Droid+Serif'				=> 'Droid+Serif',
			'Lancelot'				=> 'Lancelot',
			'Cookie'				=> 'Cookie',
			'Fjord+One'				=> 'Fjord+One',
			'Arapey'				=> 'Arapey',
			'Rancho'				=> 'Rancho',
			'Sancreek'				=> 'Sancreek',
			'Butcherman+Caps'			=> 'Butcherman+Caps',
			'Salsa'					=> 'Salsa',
			'Amatic+SC'				=> 'Amatic+SC',
			'Creepster+Caps'			=> 'Creepster+Caps',
			'Chivo'					=> 'Chivo',
			'Linden+Hill'				=> 'Linden+Hill',
			'Nosifer+Caps'				=> 'Nosifer+Caps',
			'Marvel'				=> 'Marvel',
			'Alice'					=> 'Alice',
			'Love+Ya+Like+A+Sister' 		=> 'Love+Ya+Like+A+Sister',
			'Pinyon+Script'				=> 'Pinyon+Script',
			'Stardos+Stencil'			=> 'Stardos+Stencil',
			'Leckerli+One'				=> 'Leckerli+One',
			'Nothing+You+Could+Do'			=> 'Nothing+You+Could+Do',
			'Sansita+One'				=> 'Sansita+One',
			'Poly'					=> 'Poly',
			'Alike'					=> 'Alike',
			'Fanwood+Text'				=> 'Fanwood+Text',
			'Bowlby+One+SC'				=> 'Bowlby+One+SC',
			'Actor'					=> 'Actor',
			'Terminal+Dosis'			=> 'Terminal+Dosis',
			'Aclonica'				=> 'Aclonica',
			'Gentium+Book+Basic'			=> 'Gentium+Book+Basic',
			'Rosario'				=> 'Rosario',
			'Satisfy'				=> 'Satisfy',
			'Sunshiney'				=> 'Sunshiney',
			'Aubrey'				=> 'Aubrey',
			'Jura'					=> 'Jura',
			'Ultra'					=> 'Ultra',
			'Zeyada'				=> 'Zeyada',
			'Changa+One'				=> 'Changa+One',
			'Varela'				=> 'Varela',
			'Black+Ops+One'				=> 'Black+Ops+One',
			'Open+Sans'				=> 'Open+Sans',
			'Alike+Angular'				=> 'Alike+Angular',
			'Prata'					=> 'Prata',
			'Bowlby+One'				=> 'Bowlby+One',
			'Megrim'				=> 'Megrim',
			'Damion'				=> 'Damion',
			'Coda'					=> 'Coda',
			'Vidaloka'				=> 'Vidaloka',
			'Radley'				=> 'Radley',
			'Indie+Flower'				=> 'Indie+Flower',
			'Over+the+Rainbow'			=> 'Over+the+Rainbow',
			'Open+Sans+Condensed:300'		=> 'Open+Sans+Condensed:300',
			'Abril+Fatface'				=> 'Abril+Fatface',
			'Miltonian'				=> 'Miltonian',
			'Delius'				=> 'Delius',
			'Six+Caps'				=> 'Six+Caps',
			'Francois+One'				=> 'Francois+One',
			'Dorsa'					=> 'Dorsa',
			'Aldrich'				=> 'Aldrich',
			'Buda:300'				=> 'Buda:300',
			'Rochester'				=> 'Rochester',
			'Allerta'				=> 'Allerta',
			'Bevan'					=> 'Bevan',
			'Wallpoet'				=> 'Wallpoet',
			'Quattrocento'				=> 'Quattrocento',
			'Dancing+Script'			=> 'Dancing+Script',
			'Amaranth'				=> 'Amaranth',
			'Unna'					=> 'Unna',
			'PT+Sans+Caption'			=> 'PT+Sans+Caption',
			'Geo'					=> 'Geo',
			'Quattrocento+Sans'			=> 'Quattrocento+Sans',
			'Oswald'				=> 'Oswald',
			'Carme'					=> 'Carme',
			'Spinnaker'				=> 'Spinnaker',
			'MedievalSharp'				=> 'MedievalSharp',
			'Nova+Square'				=> 'Nova+Square',
			'IM+Fell+French+Canon+SC' 		=> 'IM+Fell+French+Canon+SC',
			'Voltaire'				=> 'Voltaire',
			'Raleway:100'				=> 'Raleway:100',
			'Delius+Unicase'			=> 'Delius+Unicase',
			'Shanti'				=> 'Shanti',
			'Expletus+Sans'				=> 'Expletus+Sans',
			'Crimson+Text'				=> 'Crimson+Text',
			'Nunito'				=> 'Nunito',
			'Numans'				=> 'Numans',
			'Hammersmith+One'			=> 'Hammersmith+One',
			'Miltonian+Tattoo'			=> 'Miltonian+Tattoo',
			'Allerta+Stencil'			=> 'Allerta+Stencil',
			'Vollkorn'				=> 'Vollkorn',
			'Pacifico'				=> 'Pacifico',
			'Cedarville+Cursive'			=> 'Cedarville+Cursive',
			'Cardo'					=> 'Cardo',
			'Merriweather'				=> 'Merriweather',
			'Loved+by+the+King'			=> 'Loved+by+the+King',
			'Slackey'				=> 'Slackey',
			'Nova+Cut'				=> 'Nova+Cut',
			'Rock+Salt'				=> 'Rock+Salt',
			'Yanone+Kaffeesatz'			=> 'Yanone+Kaffeesatz',
			'Molengo'				=> 'Molengo',
			'Nobile'				=> 'Nobile',
			'Goudy+Bookletter+1911' 		=> 'Goudy+Bookletter+1911',
			'Bangers'				=> 'Bangers',
			'Old+Standard+TT'			=> 'Old+Standard+TT',
			'Orbitron'				=> 'Orbitron',
			'Comfortaa'				=> 'Comfortaa',
			'Varela+Round'				=> 'Varela+Round',
			'Forum'					=> 'Forum',
			'Maven+Pro'				=> 'Maven+Pro',
			'Volkhov'				=> 'Volkhov',
			'Allan:700'				=> 'Allan:700',
			'Luckiest+Guy'				=> 'Luckiest+Guy',
			'Gruppo'				=> 'Gruppo',
			'Cuprum'				=> 'Cuprum',
			'Anonymous+Pro'				=> 'Anonymous+Pro',
			'UnifrakturMaguntia'        => 'UnifrakturMaguntia',
			'Covered+By+Your+Grace'     => 'Covered+By+Your+Grace',
			'Homemade+Apple'			=> 'Homemade+Apple',
			'Lobster+Two'				=> 'Lobster+Two',
			'Coming+Soon'				=> 'Coming+Soon',
			'Mountains+of+Christmas'    => 'Mountains+of+Christmas',
			'Architects+Daughter'       => 'Architects+Daughter',
			'Dawning+of+a+New+Day'      => 'Dawning+of+a+New+Day',
			'Kranky'                    => 'Kranky',
			'Adamina'                   => 'Adamina',
			'Carter+One'				=> 'Carter+One',
			'Bentham'                   => 'Bentham',
			'IM+Fell+Great+Primer+SC'   => 'IM+Fell+Great+Primer+SC',
			'Chewy'                     => 'Chewy',
			'IM+Fell+English'			=> 'IM+Fell+English',
			'Inconsolata'				=> 'Inconsolata',
			'Vibur'                     => 'Vibur',
			'Andada'                    => 'Andada',
			'IM+Fell+Double+Pica'       => 'IM+Fell+Double+Pica',
			'Kenia'                     => 'Kenia',
			'Meddon'                    => 'Meddon',
			'Metrophobic'               => 'Metrophobic',
			'Play'                      => 'Play',
			'Special+Elite'				=> 'Special+Elite',
			'IM+Fell+Double+Pica+SC'    => 'IM+Fell+Double+Pica+SC',
			'Didact+Gothic'				=> 'Didact+Gothic',
			'Modern+Antiqua'			=> 'Modern+Antiqua',
			'VT323'                     => 'VT323',
			'Annie+Use+Your+Telescope'  => 'Annie+Use+Your+Telescope');

		// Enable Google Fonts for posts
		$wp_customize->add_setting( 'post_font', array(
				'Default'               => 'Default',
				'control'               => 'select',
				'sanitize_callback'		=> 'esc_attr',
		));
		$wp_customize->add_control( 'post_font', array(
				'label'					=> __('Font of posts (Google Webfonts)', 'anarcho-notepad'),
				'priority'				=> 1,
				'section'				=> 'post_section',
				'settings'				=> 'post_font',
				'type'					=> 'select',
				'choices'				=> $google_font_array,
		));


    // HEADER SECTION


    // TITLE SECTION

		// Enable Google Fonts for Title
		$wp_customize->add_setting( 'titlefontstyle_setting', array(
				'Default'               => 'Permanent+Marker',
				'control'               => 'select',
				'sanitize_callback'		=> 'esc_attr',
		));
		$wp_customize->add_control( 'titlefontstyle_control', array(
				'label'					=> __('Site Title font (Google Webfonts)', 'anarcho-notepad'),
				'priority'				=> 10,
				'section'				=> 'title_tagline',
				'settings'				=> 'titlefontstyle_setting',
				'type'					=> 'select',
				'choices'				=> $google_font_array,
		));

		// Enable Google Fonts for Tagline
		$wp_customize->add_setting( 'taglinefontstyle_setting', array(
				'Default'          		=> 'Permanent+Marker',
				'control'               => 'select',
				'sanitize_callback'		=> 'esc_attr',
		));
		$wp_customize->add_control( 'taglinefontstyle_control', array(
				'label'					=> __('Site Tagline font (Google Webfonts)', 'anarcho-notepad'),
				'priority'				=> 11,
				'section'				=> 'title_tagline',
				'settings'				=> 'taglinefontstyle_setting',
				'type'					=> 'select',
				'choices'				=> $google_font_array,
		));

		// Title color
		$wp_customize->add_setting( 'title_color', array(
				'default'               => '#e5e5e5',
				'transport'             => 'postMessage',
				'type'           		=> 'option',
				'sanitize_callback'		=> 'esc_attr',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'title_color', array(
                'label' 				=> __('Site Title color', 'anarcho-notepad'),
                'section' 				=> 'title_tagline',
                'settings' 				=> 'title_color',
                'priority'				=> 12,
		)));

		// Tagline color
        $wp_customize->add_setting( 'tagline_color', array(
                'default'               => '#9b9b9b',
                'transport'             => 'postMessage',
                'type'           		=> 'option',
                'sanitize_callback'		=> 'esc_attr',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tagline_color', array(
                'label' 				=> __('Site Tagline color', 'anarcho-notepad'),
                'section' 				=> 'title_tagline',
				'settings' 				=> 'tagline_color',
                'priority'				=> 13,
        )));

        // Title Position
        $wp_customize->add_setting( 'title_position', array(
				'default'               => 'left',
				'sanitize_callback'		=> 'esc_attr',
		));
        $wp_customize->add_control( 'title_position', array(
				'label' 				=> __('Site Title Position', 'anarcho-notepad'),
                'section' 				=> 'title_tagline',
                'settings' 				=> 'title_position',
                'priority'				=> 14,
                'type'                  => 'radio',
                'choices'               => array(
                                                 'left'     => __('Left', 'anarcho-notepad'),
                                                 'center'   => __('Center', 'anarcho-notepad')
                                                 ),
        ));

    // BACKGROUND SECTION
    $wp_customize->get_section( 'background_image' );

		// Background color
        $wp_customize->add_setting( 'background_color' , array(
				'default'     			=> '000000',
				'transport'   			=> 'postMessage',
				'sanitize_callback'		=> 'esc_attr',
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
				'label'                 => __('Background Color', 'anarcho-notepad'),
				'section'               => 'background_image',
		)));

		// Add the option to use the CSS3 property Background-size
		$wp_customize->add_setting( 'backgroundsize_setting', array(
				'default'        		=> 'auto',
				'control'        		=> 'select',
				'sanitize_callback'		=> 'esc_attr',
		));
		$wp_customize->add_control( 'backgroundsize_control', array(
				'label'                 => __('Background Size', 'anarcho-notepad'),
				'section'               => 'background_image',
				'settings'              => 'backgroundsize_setting',
				'priority'              => 10,
				'type'                  => 'radio',
				'choices'               => array(
												'auto'		=> __('Auto (Default)', 'anarcho-notepad'),
												'contain'	=> __('Contain', 'anarcho-notepad'),
                                                'cover'		=> __('Cover', 'anarcho-notepad'),
                                            ),
		));

}
add_action( 'customize_register', 'anarcho_customize_register' );

/* Inject the Customizer Choices into the Theme */
add_action('wp_head', 'anarcho_notepad_inline_css');
function anarcho_notepad_inline_css() {

		if ( ( get_theme_mod('enable_title_animation') == '1' ) ) echo '<script>
var tit=document.title,c=0;function writetitle(){document.title=tit.substring(0,c);c==tit.length?(c=0,setTimeout("writetitle()",3E3)):(c++,setTimeout("writetitle()",200))}writetitle(); 
</script>' . "\n";

		/* Custom Font Styles */
		if ( ( get_theme_mod('titlefontstyle_setting') != 'Default' ) && ( get_theme_mod('titlefontstyle_setting') != '' ) ) {
			echo "<link href='//fonts.googleapis.com/css?family=" . get_theme_mod('titlefontstyle_setting') . "' rel='stylesheet' type='text/css'>"  . "\n";
			$q = get_theme_mod('titlefontstyle_setting');
			$q = preg_replace('/[^a-zA-Z0-9]+/', ' ', $q);
			echo '<style type="text/css" media="screen">' . "\n";
		 	echo	".site-title {font-family: '" . $q . "';}" . "\n";
			echo '</style>' . "\n";
		}
		if ( ( get_theme_mod('taglinefontstyle_setting') != 'Default' ) && ( get_theme_mod('taglinefontstyle_setting') != '' ) ) {
			echo "<link href='//fonts.googleapis.com/css?family=" . get_theme_mod('taglinefontstyle_setting') . "' rel='stylesheet' type='text/css'>"  . "\n";
			echo '<style type="text/css" media="screen">' . "\n";
			$x = get_theme_mod('taglinefontstyle_setting');
			$x = preg_replace('/[^a-zA-Z0-9]+/', ' ', $x);
			echo	".site-description {font-family: '" . $x . "';}" . "\n";
			echo '</style>' . "\n";
		}
		if ( ( get_theme_mod('post_font') != 'Default' ) && ( get_theme_mod('post_font') != '' ) ) {
			echo "<link href='//fonts.googleapis.com/css?family=" . get_theme_mod('post_font') . "' rel='stylesheet' type='text/css'>"  . "\n";
			echo '<style type="text/css" media="screen">' . "\n";
			$x = get_theme_mod('post_font');
			$x = preg_replace('/[^a-zA-Z0-9]+/', ' ', $x);
			echo	"#content .col01 .post-inner {font-family: '" . $x . "';}" . "\n";
			echo '</style>' . "\n";
		}
                if ( ( get_theme_mod('post_font_size') != 'Default' ) && ( get_theme_mod('post_font_size') != '' ) ) {
                        echo '<style type="text/css" media="screen">' . "\n";
                        $x = get_theme_mod('post_font_size');
                        echo    "#content .col01 .post-inner {font-size: " . $x . ";}" . "\n";
                        echo '</style>' . "\n";
                }
		/* End - Custom Font Styles */

	?><style type="text/css"><?php

		/* Background-size */
		?>
			body.custom-background {
				-webkit-background-size: <?php echo get_theme_mod( 'backgroundsize_setting' ); ?>;
				-moz-background-size: <?php echo get_theme_mod( 'backgroundsize_setting' ); ?>;
				-ms-background-size: <?php echo get_theme_mod( 'backgroundsize_setting' ); ?>;
				-o-background-size: <?php echo get_theme_mod( 'backgroundsize_setting' ); ?>;
				background-size: <?php echo get_theme_mod( 'backgroundsize_setting' ); ?>;
			}
		<?php
		/* End - Background-size */

		/* Has the text been hidden? */
		if ( ! display_header_text() ) {
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px 1px 1px 1px); /* IE7 */
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
		}
		/* End - Has the text been hidden? */

		/* Title & Description Color. */
		?>
		.site-title { color: <?php echo get_option('title_color'); ?>; }
		.site-description { color: <?php echo get_option('tagline_color'); ?>; }
		<?php

		/* If the user has set a custom color for the text in admin panel, use that. */
	       	/*if ( 'blank' != get_header_textcolor() ) {
    		?>
        		.site-title,
        		.site-description {
            			color: #<?php echo get_header_textcolor(); ?>;
       		 	}
		<?php
		}*/
		/* End - Title & Description Color. */

		/* Site Title Position. */
		if ( get_theme_mod('title_position') == 'left') {
    		?>
        		#title { margin-left: 4%; }
		<?php
		}
		if ( get_theme_mod('title_position') == 'center') {
    		?>
        		#title { margin-left: 20%; }
		<?php
		}
		/*End - Site Title Position. */

		/* Disable Paper Search */
		if ( get_theme_mod('disable_paper_search') == '1') {
		$outer_back=get_template_directory_uri() . '/images/outer-back.png';				/* 											.site-header {background:url( <?php echo $outer_back ?> ) no-repeat top center;				margin-top: -2.8%; }					.top-search-form {				position: absolute;				clip: rect(1px 1px 1px 1px); IE7 				clip: rect(1px, 1px, 1px, 1px); }		*/
		?>
			#title { height: 80%; }
			.logo { margin-top: 4%; }
			.site-title { margin-top: 4%; }

		<?php
		}
		if ( get_theme_mod('disable_paper_search') !== '1') {
		$outer_back_search=get_template_directory_uri() . '/images/outer-back-search.png';				/* .site-header { background:url( <?php echo $outer_back_search ?> ) no-repeat top center; } */
		?>
			
		<?php
		}
		/* End - Disable Paper Search */

	?></style><?php

}

function anarcho_customizer_live_preview() {
	wp_enqueue_script(
		'anarcho-themecustomizer',
		get_template_directory_uri().'/js/theme-customizer.js',
		array( 'jquery','customize-preview' ),
		'',
		true
	);
}
add_action( 'customize_preview_init', 'anarcho_customizer_live_preview' );