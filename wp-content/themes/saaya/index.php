<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mystery Themes
 * @subpackage Saaya
 * @since 1.0.0
 */

$archive_style = get_theme_mod( 'saaya_archive_style', 'mt-archive--masonry-style' );

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if( 'mt-archive--block-grid-style' === $archive_style ) {
			echo '<div class="archive-grid-post-wrapper">';
		}

			if ( have_posts() ) :

				if ( 'mt-archive--masonry-style' === $archive_style ) {
			?>
					<div class="saaya-content-masonry">
						<div id="mt-masonry">
			<?php
				}

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

				if ( 'mt-archive--masonry-style' === $archive_style ) {
			?>
						</div><!-- #mt-masonry -->
					</div><!-- .saaya-content-masonry -->
			<?php
				}

				the_posts_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;

		if( 'mt-archive--block-grid-style' === $archive_style ) {
			echo '</div>';
		}
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
