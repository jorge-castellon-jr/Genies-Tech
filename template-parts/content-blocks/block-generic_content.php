<?php
/**
 * The template used for displaying a generic content block.
 *
 * @package ThoriumDesign
 */

// Set up fields.
$title = get_sub_field( 'title' );
$content = get_sub_field( 'content' );

?>
<section class="generic-content">
    <div class="wrap">
        <?php if ( $title ) : ?>
            <p class="generic-content-title"><?php echo esc_html( $title ); ?>
        <?php endif; ?>

        <?php echo force_balance_tags( $content ); // WP XSS OK. ?>
    </div>
</section><!-- .hero-area -->
