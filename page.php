<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThoriumDesign
 */

get_header(); ?>

			<main id="main" class="site-main">

					<?php thd_display_content_blocks(); ?>

			</main><!-- #main -->


<?php get_footer(); ?>
