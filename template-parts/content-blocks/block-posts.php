<?php
/**
 * Description
 *
 * @package   ${NAMESPACE}
 * @since     1.0.0
 * @author    ajskelton
 * @link      anthonyskelton.com
 * @license   GNU General Public License 2.0+
 */
$heading = get_sub_field( 'heading' );
$number_of_posts = get_sub_field( 'number_of_posts' );
$button_text = get_sub_field( 'button_text' );
$query_array = [
	'numberposts' => $number_of_posts
];
$styles = array();
// Padding Top
if ( is_numeric( get_sub_field( 'padding_top' ) ) ) {
	$styles[] = 'padding-top:' . get_sub_field('padding_top') . 'px';
}
// Padding Bottom
if ( is_numeric( get_sub_field( 'padding_bottom' ) ) ) {
	$styles[] = 'padding-bottom:' . get_sub_field('padding_bottom') . 'px';
}
// Background Color
if ( get_sub_field( 'background_color' ) ) {
	$styles[] = 'background-color:' . get_sub_field('background_color');
}
if ( get_sub_field( 'background_image' ) ) {
    $styles[] = 'background-image: url(' . get_sub_field('background_image')['url'] . ')';
}
?>
<section class="posts-block posts-<?php echo $number_of_posts ?>" style="<?php echo implode( $styles, ';' ); ?>;">
	<div class="wrap">
		<div class="posts-block__title">
			<h2><?php echo $heading; ?></h2>
		</div>
		<div class="posts-wrap">
			<?php
			$posts = wp_get_recent_posts($query_array);
			foreach($posts as $post) :
				?>
				<article class="posts-block__post post-<?php echo $post['ID']; ?>">
                    <?php
                    if(has_post_thumbnail( $post['ID'])){
                        echo get_the_post_thumbnail( $post['ID'], 'thumbnail' );

                    }
                    ?>
                    <div class="meta-wrap">
                        <span class="date"><?php echo date("F j, Y", strtotime($post['post_date'])); ?></span>
                    </div>
                     <h3><a href="<?php echo get_permalink($post['ID']); ?>"><?php echo $post['post_title']; ?></a></h3>
                    <div class="excerpt">
                        <?php echo get_the_excerpt( $post['ID'] ); ?>
                    </div>
				</article>
				<?php
			endforeach;
			?>
		</div>
        <div class="btn__wrap center">
		    <a class="btn-pill" href="/articles"><?php echo $button_text; ?></a>
        </div>
	</div>
</section>