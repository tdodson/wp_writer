<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sassy_Underscores
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php underscores_sass_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php underscores_sass_category_list(); ?> <!-- custom function in template-tags.php -->

		<?php
		endif; ?>
		
		<?php 
		if ( has_post_thumbnail() ) { ?>
		<figure class="featured-image full-bleed">
			<?php 
			the_post_thumbnail() 
			?>
		</figure>
		<?php } ?>
	
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( !is_singular() ) :
				the_excerpt(); ?>
				<div class="read-more">
				    <?php 
						$read_more_link = sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Read more<span class="screen-reader-text"> "%s"</span>', 'underscores_sass' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									get_the_title()
								);
						?>
				    <a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
				        <?php echo $read_more_link; ?>
				    </a>
				</div>

		<?php
			else :
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'underscores_sass' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );
				
				if( function_exists( 'get_field' ) ) {
					if(get_field( 'journal' ) ) {
						echo '<aside class="journal">Originally published in ';
						echo '<cite>' . get_field('journal') . '</cite>.';
						echo '</aside>';
					} //end conditional statement testing for 'journal' field
				} // end conditional statement testing for get_field
				 wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'underscores_sass' ),
					'after'  => '</div>',
				) );
			endif; 
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php underscores_sass_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
