<?php
/**
 * Template part for displaying front page introduction.
 *
 * @package Terminal Blog
 */

// Banner Section.
$banner_section = get_theme_mod( 'terminal_blog_banner_section_enable', false );

if ( false === $banner_section ) {
	return;
}

$content_ids      = array();
$posts_grid_content_type = get_theme_mod( 'terminal_blog_banner_section_content_type', 'post' );

if ( $posts_grid_content_type === 'post' ) {

	for ( $i = 1; $i <= 3; $i++ ) {
		$content_ids[] = get_theme_mod( 'terminal_blog_banner_section_post_' . $i );
	}

	$args = array(
		'post_type'           => 'post',
		'posts_per_page'      => absint( 3 ),
		'ignore_sticky_posts' => true,
	);
	if ( ! empty( array_filter( $content_ids ) ) ) {
		$args['post__in'] = array_filter( $content_ids );
		$args['orderby']  = 'post__in';
	} else {
		$args['orderby'] = 'date';
	}

} else {
	$cat_content_id = get_theme_mod( 'terminal_blog_banner_section_category' );
	$args           = array(
		'cat'            => $cat_content_id,
		'posts_per_page' => absint( 3 ),
	);
}

$query = new WP_Query( $args );
if ( $query->have_posts() ) {

	$section_title = get_theme_mod( 'terminal_blog_banner_section_title', __( 'Banner Posts', 'terminal-blog' ) );
	$button_label  = get_theme_mod( 'terminal_blog_banner_section_button_label', __( 'Read More', 'terminal-blog' ) );
	?>
	<div id="terminal_blog_banner_section" class="frontpage banner-navigation banner-section style-1">
		<div class="theme-wrapper">
			<div class="terminal-wrapper">
				<?php if ( ! empty( $section_title ) ) { ?>
					<div class="section-head">
						<div class="section-header">
							<h3 class="section-title"><?php echo esc_html( $section_title ); ?></h3>
						</div>
					</div>
				<?php } ?>
				<div class="banner-section-wrapper adore-navigation">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<div class="banner-item">
							<div class="post-item post-list">
								<div class="post-item-image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'post-thumbnail' ); ?>
									</a>
									<div class="read-time-comment">
										<span class="reading-time">
											<i class="far fa-clock"></i>
											<?php
											echo terminal_blog_time_interval( get_the_content() );
											echo esc_html__( ' min read', 'terminal-blog' );
											?>
										</span>
										<span class="comment">
											<i class="far fa-comment"></i>
											<?php echo absint( get_comments_number( get_the_ID() ) ); ?>
										</span>
									</div>
								</div>
								<div class="post-item-content">
									<div class="entry-cat">
										<?php the_category( '', '', get_the_ID() ); ?>
									</div>
									<h3 class="entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>  
									<ul class="entry-meta">
										<li class="post-author"> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="far fa-user"></i><?php echo esc_html( get_the_author() ); ?></a></li>
										<li class="post-date"><i class="far fa-calendar-alt"></i></span><?php echo esc_html( get_the_date() ); ?></li>
									</ul>
									<div class="post-exerpt">
										<?php
										$content = get_the_content();
										$content = strip_shortcodes( $content ); // Remove shortcodes, including image captions
										$content = preg_replace( '/<img(.*?)alt=[\'"](.*?)[\'"](.*?)>/i', '', $content ); // Remove image tags with alt attributes
										$content = wp_kses_post( wp_trim_words( $content, 25 ) );
										?>
										<p><?php echo $content; ?></p>
									</div>
									<?php if ( ! empty( $button_label ) ) { ?>
										<div class="post-btn">
											<a href="<?php the_permalink(); ?>" class="btn-read-more"><?php echo esc_html( $button_label ); ?></a>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
	</div>

	<?php
}
