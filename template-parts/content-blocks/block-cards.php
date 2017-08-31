<?php
/**
 * The template used for displaying a hero.
 *
 * @package AllianceSeniorConsulting
 */

// Set up fields.
$number_of_cards = get_sub_field( 'number_of_cards' );
$cards = get_sub_field( 'cards' );

$card_img = get_sub_field( 'card-image' );
$card_heading = get_sub_field( 'card-heading' );
$card_description = get_sub_field( 'card_description' );
$card_button_text = get_sub_field( 'card_button_text' );
?>
<section class="cards-block cards-<?php echo $number_of_cards[0]; ?>">
	<div class="wrap">
		<?php
		// check if the repeater field has rows of data
		if( have_rows( 'cards') ):
			?> <div class="cards-block__wrapper"> <?php
			// loop through the rows of data
			while ( have_rows( 'cards') ) : the_row(); ?>

				<div class="cards-block__card-wrap">
					<img src="<?php the_sub_field('card_image') ?>" alt="">
					<h3><?php the_sub_field( 'card_heading' ); ?></h3>
					<p><?php the_sub_field( 'card_description' ); ?></p>
					<a href="#" class="btn"><?php the_sub_field('card_button_text'); ?></a>
				</div>

				<?php

			endwhile;
			?> </div> <?php
		else :

			// no rows found

		endif;
		?>
	</div>
</section><!-- .cards-block -->
