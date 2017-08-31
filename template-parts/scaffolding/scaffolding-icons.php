<?php
/**
 * The template used for displaying icons in the scaffolding library.
 *
 * @package ThoriumDesign
 */
?>

<section class="section-scaffolding">

	<h2 class="scaffolding-heading"><?php esc_html_e( 'Icons', 'thorium-design' ); ?></h2>

	<?php // SVG
	thd_display_scaffolding_section( array(
		'title'       => 'SVG',
		'description' => 'Display inline SVGs.',
		'usage'       => '<?php thd_get_svg( array( \'icon\' => \'facebook-square\' ) ); ?>',
		'parameters'  => array(
			'$args' => '(required) Configuration arguments.',
		),
		'arguments'    => array(
			'icon'  => '(required) The SVG icon file name. Default none',
			'title' => '(optional) The title of the icon. Default: none',
			'desc'  => '(optional) The description of the icon. Default: none',
		),
		'output'       => thd_get_svg( array( 'icon' => 'facebook-square' ) ),
	) ); ?>
</section>
