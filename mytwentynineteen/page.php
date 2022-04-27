<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */



 
get_header();
?>

<style>

/* font */
@font-face {
  font-family: "Montserrat";
  src: url(fonts/montserrat-variablefont_wght-webfont.woff2);
}

@font-face {
  font-family: "Roboto";
  src: url(fonts/roboto-regular-webfont.woff2);
}


/* Styling af tekst */
h1 {
	color:#1D75B4;
	font-family: "Roboto";
}

p {
	color:#09273D;
	font-family: "Roboto";
}

</style>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php

			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile; // End the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
