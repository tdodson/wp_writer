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
		<?php undersocres_sass_category_list(); ?> <!-- custom function in template-tags.php -->

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
			the_excerpt();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php underscores_sass_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
