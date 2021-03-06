<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Sassy_Underscores
 */

if ( ! function_exists( 'underscores_sass_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function underscores_sass_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'underscores_sass' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'underscores_sass' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		// echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		echo '<span class="posted-on">' . $posted_on . '</span>';  // WPCS: XSS OK.

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="pipe"> | </span>';
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'underscores_sass' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'underscores_sass' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="pipe"> | </span><span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'underscores_sass_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function underscores_sass_entry_footer() {
		// Hide tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'underscores_sass' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'underscores_sass' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

function underscores_sass_category_list() {
/* translators: used between list items, there is a space after the comma */
	$categories_list = get_the_category_list( esc_html__( ', ', 'underscores_sass' ) );
	if ( $categories_list ) {
		/* translators: 1: list of categories. */
		printf( '<span class="cat-links">' . esc_html__( '%1$s', 'underscores_sass' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	}
}

function underscores_sass_post_navigation() {
	the_post_navigation( array(
            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next: ', 'underscores_sass' ) . '</span>' . '<span class="screen-reader-text">' . __('Next post: ', 'underscores_sass') . '</span>' . '<span class="post-title">%title</span>',
            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous: ', 'underscores_sass' ) . '</span>' . '<span class="screen-reader-text">' . __('Previous post: ', 'underscores_sass') . '</span>' . '<span class="post-title">%title</span>',
        ) );
};