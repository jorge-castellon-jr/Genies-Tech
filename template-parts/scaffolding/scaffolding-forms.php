<?php
/**
 * The template used for displaying forms in the scaffolding library.
 *
 * @package ThoriumDesign
 */
?>

<section class="section-scaffolding">

	<h2 class="scaffolding-heading"><?php esc_html_e( 'Forms', 'thorium-design' ); ?></h2>

	<?php // Search form.
	$echo = false; // set echo to false so the search form outputs correctly.
	thd_display_scaffolding_section( array(
		'title'       => 'Search Form',
		'description' => 'Display the search form.',
		'usage'       => '<?php get_search_form(); ?>',
		'output'      => get_search_form( $echo ),
	) ); ?>
</section>
