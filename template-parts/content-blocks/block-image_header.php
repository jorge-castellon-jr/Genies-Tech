<?php
/**
 * The template used for displaying an image header content block
 *
 * @package GeniesTech
 */

$text = get_sub_field( 'text' );
$image = get_sub_field( 'image' );
$title = get_sub_field( 'title' );

?>
<section class="image-header" style="background: url('<?php echo $image['url'] ?>'); background-size: cover;">
	<div class="wrap">
		<div class="image-header__wrapper">
			<div class="image-header__text">
				<h2><?php echo $title ?></h2>
				<p><?php echo $text ?></p>
			</div>
		</div>
	</div>
</section>
