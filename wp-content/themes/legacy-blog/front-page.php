<?php
/**
 * The front page template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Terminal Blog
 */

get_header();

// Call home.php if Homepage setting is set to latest posts.
if ( terminal_blog_is_latest_posts() ) {

	require get_home_template();

} elseif ( terminal_blog_is_frontpage() ) {

    require get_template_directory() . '/inc/frontpage-sections/breaking-news.php';
    require get_theme_file_path() . '/inc/frontpage-sections/category.php';
    require get_theme_file_path() . '/inc/frontpage-sections/posts-grid.php';

}

get_footer();
