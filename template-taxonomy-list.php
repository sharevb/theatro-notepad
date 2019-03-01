<?php
/**
 * template-taxonomy-list.php
 * The template for displaying Taxonomy Indexes.
 *
 * Template Name: Taxonomy List
 *
 * @package    In Theatro Veritas Notepad
 * @since    1.0
 * @author    ShareVB based on Anarcho Notepad from Arthur "Berserkr" Gareginyan <arthurgareginyan@gmail.com>
 * @copyright    Copyright © 2015, ShareVB - Copyright © 2013-2015, Arthur Gareginyan
 * @link        http://sharevb.net
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 */
?>

<?php get_header(); ?>

    <section id="content" role="main">
        <div class="content-row">
            <div class="notebook-left"></div>
            <div class="col01">
                <div id="mobilemenu"></div>

				<?php

				the_post();

				$tax      = get_post_meta( $post->ID, 'taxonomy', true );
				$taxonomy = $tax ? $tax : basename( get_the_permalink() );
				$terms    = get_terms( $taxonomy );
				function my_cmp( $a, $b ) {
					$a_name = end( explode( " ", $a->name ) );
					$b_name = end( explode( " ", $b->name ) );

					if ( ! isset( $a_name ) && isset( $b_name ) ) {
						return 1;
					} elseif ( ! isset( $b_name ) && isset( $a_name ) ) {
						return - 1;
					} elseif ( ! isset( $a_name ) && ! isset( $b_name ) ) {
						return 0;
					}

					return strcasecmp( $a_name, $b_name );
				}

				usort( $terms, "my_cmp" );

				$letter = "";
				?>

                <h1><?php the_title(); ?></h1>
                <div class="index-letters">
                    <span class="byletter">Par lettres :</span>
					<?php
					foreach ( $terms as $term ) {
						$arr   = explode( " ", $term->name );
						$upper = substr( strtoupper( end( $arr ) ), 0, 1 );
						if ( $upper != $letter ) {
							$letter = $upper;
							echo '<a class="index-letter" href="#l_' . $letter . '">' . $letter . '</a>';
						}
					}
					?>
                </div>
				<?php
				$letter = "";
				foreach ( $terms as $term ) {
					$arr   = explode( " ", $term->name );
					$upper = substr( strtoupper( end( $arr ) ), 0, 1 );
					if ( $upper != $letter ) {
						$letter = $upper;
						echo '<h2 id="l_' . $letter . '">' . $letter . '</h2>';
					}
					// The $term is an object, so we don't need to specify the $taxonomy.
					$term_link = get_term_link( $term );

					// If there was an error, continue to the next term.
					if ( is_wp_error( $term_link ) ) {
						continue;
					}

					?>
                    <p>
                        <a href="<?php echo esc_url( $term_link ) ?>"><?php echo $term->name; ?></a>
                    </p>
					<?php
				} ?>

            </div>
			<?php get_sidebar(); ?>
            <div class="notebook-right"></div>
        </div>
    </section><br clear="all"/>

<?php get_footer(); ?>