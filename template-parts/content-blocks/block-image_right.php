<?php
/**
 * The template used for displaying an image right content block
 *
 * @package AllianceSeniorConsulting
 */

$text = get_sub_field( 'text' );
$image = get_sub_field( 'image' );

?>
<section class="image-right">
	<div class="wrap">
		<div class="image-right__wrapper">
			<div class="image-right__text">
				<?php the_sub_field('text'); ?>
			</div>
			<div class="image-right__image">
				<img src="<?php echo $image; ?>" alt="">
			</div>
		</div>
	</div>
</section>
