<?php
/**
 * The template used for displaying a logo carousel
 *
 * @package ThoriumDesign
 */

$isGrey = get_sub_field('grey_scale');
$num_items_displayed = get_sub_field( 'num_photos_displayed' );
$container_width_size = get_sub_field( 'container_size' );
$container_height_size = get_sub_field( 'container_height_size' );
$section_class = '';
$logos = get_sub_field( 'logo_carousel' ); ?>

<section class="customers-carousel <?=$section_class?> <?php if($isGrey){ echo 'greyscale'; } ?> <?php if($container_width_size){ echo $container_width_size; } ?> <?php if($container_height_size){ echo $container_height_size; } ?>" id="<?=$section_id?>">
    <section class="container">
        <div class="wrap">
		<?php if( get_sub_field("title") ) { ?>
            <h2 class="heading"><?=get_sub_field("title")?></h2>
		<?php } ?>
            <div class="logo-carousel" id="<?php if( $num_items_displayed ){ echo $num_items_displayed; } ?>">
			<?php
			foreach ($logos as $logo) :
				if ( !empty( $logo['url'] ) ): ?>
                    <div class="logo-carousel-slide">
                        <img src="<?php echo $logo['url']; ?>" />
                    </div>
				<?php endif; ?>
			<?php endforeach; ?>

            </div>
        </div>
    </section>
</section>