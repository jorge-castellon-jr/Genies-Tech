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
$number_of_posts = get_sub_field( 'number_of_posts' );
$button_text = get_sub_field( 'button_text' );
$query_array = [
	'numberposts' => $number_of_posts
];
?>
<section class="posts-block posts-<?php echo $number_of_posts ?>" style="<?php echo implode( $styles, ';' ); ?>;">
	<div class="wrap">
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
                    <!-- <div class="meta-wrap">
                        <span class="date"><?php echo date("F j, Y", strtotime($post['post_date'])); ?></span>
                    </div> -->
                     <h3><a href="<?php echo get_permalink($post['ID']); ?>"><?php echo $post['post_title']; ?></a></h3>
                    <!-- <div class="excerpt">
                        <?php echo get_the_excerpt( $post['ID'] ); ?>
                    </div> -->
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
