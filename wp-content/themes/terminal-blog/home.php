<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Terminal Blog
 */

get_header();
$archive_page_title = get_theme_mod( 'terminal_blog_archive_page_title', __( 'Latest Posts', 'terminal-blog' ) );
?>

<main id="primary" class="site-main">

	<?php if ( is_front_page() && is_home() ) : ?>
	<div class="terminal-wrapper">
		<?php
		if ( ! empty( $archive_page_title ) ) {
			?>
			<div class="section-head">
				<div class="section-header">
					<h3 class="section-title"><?php echo esc_html( $archive_page_title ); ?></h3>
				</div>
			</div>
			<?php
		}
	endif;
	?>

	<?php if ( have_posts() ) : ?>

		<?php if ( terminal_blog_is_frontpage_blog() ) { ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php
			$breadcrumb_enable = get_theme_mod( 'terminal_blog_breadcrumb_enable', true );
			if ( $breadcrumb_enable ) :
				?>
				<div id="breadcrumb-list">
					<?php
					echo terminal_blog_breadcrumb(
						array(
							'show_on_front' => false,
							'show_browse'   => false,
						)
					);
					?>
				</div><!-- #breadcrumb-list -->
				<?php
			endif;

		}
		?>

		<div class="theme-archive-layout list-layout list-style-1">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/

					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;
			?>
		</div>

			<?php if ( is_front_page() && is_home() ) { ?>
				</div>
			<?php } ?>
		<?php

			do_action( 'terminal_blog_posts_pagination' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

</main><!-- #main -->

<?php

if ( terminal_blog_is_sidebar_enabled() ) {
	get_sidebar();
}

get_footer();
