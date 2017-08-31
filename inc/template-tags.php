<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ThoriumDesign
 */

if ( ! function_exists( 'thd_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function thd_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: the date the post was published */
			esc_html_x( 'Posted on %s', 'post date', 'thorium-design' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: the post author */
			esc_html_x( 'by %s', 'post author', 'thorium-design' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'thd_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function thd_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'thorium-design' ) );
			if ( $categories_list && thd_categorized_blog() ) {
				/* translators: the post category */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'thorium-design' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'thorium-design' ) );
			if ( $tags_list ) {
				/* translators: the post tags */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'thorium-design' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'thorium-design' ), esc_html__( '1 Comment', 'thorium-design' ), esc_html__( '% Comments', 'thorium-design' ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'thorium-design' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Return SVG markup.
 *
 * @param  array  $args {
 *     Parameters needed to display an SVG.
 *
 * @param string $icon Required. Use the icon filename, e.g. "facebook-square".
 * @param string $title Optional. SVG title, e.g. "Facebook".
 * @param string $desc Optional. SVG description, e.g. "Share this post on Facebook".
 * }
 * @return string SVG markup.
 */
function thd_get_svg( $args = array() ) {

	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'thorium-design' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'thorium-design' );
	}

	// Set defaults.
	$defaults = array(
		'icon'  => '',
		'title' => '',
		'desc'  => '',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Figure out which title to use.
	$title = ( $args['title'] ) ? $args['title'] : $args['icon'];

	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	// Set ARIA.
	$aria_labelledby = '';
	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby="title-ID desc-ID"';
		$aria_hidden = '';
	}

	// Begin SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// Add title markup.
	$svg .= '<title>' . esc_html( $title ) . '</title>';

	// If there is a description, display it.
	if ( $args['desc'] ) {
		$svg .= '<desc>' . esc_html( $args['desc'] ) . '</desc>';
	}

	// Use absolute path in the Customizer so that icons show up in there.
	if ( is_customize_preview() ) {
		$svg .= '<use xlink:href="' . get_parent_theme_file_uri( '/assets/images/svg-icons.svg#icon-' . esc_html( $args['icon'] ) ) . '"></use>';
	} else {
		$svg .= '<use xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use>';
	}

	$svg .= '</svg>';

	return $svg;
}

/**
 * Trim the title length.
 *
 * @param array $args Parameters include length and more.
 * @return string        The shortened excerpt.
 */
function thd_get_the_title( $args = array() ) {

	// Set defaults.
	$defaults = array(
		'length'  => 12,
		'more'    => '...',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Trim the title.
	return wp_trim_words( get_the_title( get_the_ID() ), $args['length'], $args['more'] );
}

/**
 * Limit the excerpt length.
 *
 * @param array $args Parameters include length and more.
 * @return string The shortened excerpt.
 */
function thd_get_the_excerpt( $args = array() ) {

	// Set defaults.
	$defaults = array(
		'length' => 20,
		'more'   => '...',
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Trim the excerpt.
	return wp_trim_words( get_the_excerpt(), absint( $args['length'] ), esc_html( $args['more'] ) );
}

/**
 * Echo an image, no matter what.
 *
 * @param string $size The image size to display. Default is thumbnail.
 */
function thd_display_post_image( $size = 'thumbnail' ) {

	// If post has a featured image, display it.
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( $size );
		return;
	}

	$attached_image_url = thd_get_attached_image_url( $size );

	// Else, display an attached image or placeholder.
	?>
	<img src="<?php echo esc_url( $attached_image_url ); ?>" class="attachment-thumbnail wp-post-image" alt="<?php echo esc_html( get_the_title() ); ?>"/>
	<?php
}

/**
 * Return an image URL, no matter what.
 *
 * @param  string $size The image size to return. Deafault is thumbnail.
 * @return string       The image URL.
 */
function thd_get_post_image_url( $size = 'thumbnail' ) {

	// If post has a featured image, return its URL.
	if ( has_post_thumbnail() ) {

		$featured_image_id = get_post_thumbnail_id( get_the_ID() );
		$media             = wp_get_attachment_image_src( $featured_image_id, $size );

		if ( is_array( $media ) ) {
			return current( $media );
		}
	}

	// Else, return the URL for an attached image or placeholder.
	return thd_get_attached_image_url( $size );
}

/**
 * Get the URL of an image that's attached to the current post, else a placeholder image URL.
 *
 * @param  string $size The image size to return. Deafault is thumbnail.
 * @return string       The image URL.
 */
function thd_get_attached_image_url( $size = 'thumbnail' ) {

	// Check for any attached image.
	$media = get_attached_media( 'image', get_the_ID() );
	$media = current( $media );

	// If an image is attached, return its URL.
	if ( is_array( $media ) && $media ) {
		return 'thumbnail' === $size ? wp_get_attachment_thumb_url( $media->ID ) : wp_get_attachment_url( $media->ID );
	}

	// Return URL to a placeholder image as a fallback.
	return get_stylesheet_directory_uri() . '/assets/images/placeholder.png';
}

/**
 * Echo the copyright text saved in the Customizer.
 */
function thd_display_copyright_text() {

	// Grab our customizer settings.
	$copyright_text = get_theme_mod( 'thd_copyright_text' );

	// Stop if there's nothing to display.
	if ( ! $copyright_text ) {
		return false;
	}

	// Return the text.
	echo '<span class="copyright-text">' . wp_kses_post( $copyright_text ) . '</span>';
}

/**
 * Display social sharing icons.
 */
function thd_display_social_icons() {

	// Build the sharing URLs.
	$twitter_url  = 'https://twitter.com/share?text=' . rawurlencode( html_entity_decode( get_the_title() ) ) . '&amp;url=' . rawurlencode( get_the_permalink() );
	$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( get_the_permalink() );
	$linkedin_url = 'https://www.linkedin.com/shareArticle?title=' . rawurlencode( html_entity_decode( get_the_title() ) ) . '&amp;url=' . rawurlencode( get_the_permalink() );

	?>
	<div class="social-share">
		<h5 class="social-share-title"><?php esc_html_e( 'Share This', 'thorium-design' ); ?></h5>
		<ul class="social-icons menu menu-horizontal">
			<li class="social-icon">
				<a href="<?php echo esc_url( $twitter_url ); ?>" onclick="window.open(this.href, 'targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, top=150, left=0, width=600, height=300' ); return false;">
					<?php echo thd_get_svg( array( // WPCS: XSS ok.
						'icon'  => 'twitter-square',
						'title' => 'Twitter',
						'desc'  => esc_html__( 'Share on Twitter', 'thorium-design' ),
					) ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Share on Twitter', 'thorium-design' ); ?></span>
				</a>
			</li>
			<li class="social-icon">
				<a href="<?php echo esc_url( $facebook_url ); ?>" onclick="window.open(this.href, 'targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, top=150, left=0, width=600, height=300' ); return false;">
					<?php echo thd_get_svg( array( // WPCS: XSS ok.
						'icon'  => 'facebook-square',
						'title' => 'Facebook',
						'desc'  => esc_html__( 'Share on Facebook', 'thorium-design' ),
					) ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Share on Facebook', 'thorium-design' ); ?></span>
				</a>
			</li>
			<li class="social-icon">
				<a href="<?php echo esc_url( $linkedin_url ); ?>" onclick="window.open(this.href, 'targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, top=150, left=0, width=475, height=505' ); return false;">
					<?php echo thd_get_svg( array( // WPCS: XSS ok.
						'icon'  => 'linkedin-square',
						'title' => 'LinkedIn',
						'desc'  => esc_html__( 'Share on LinkedIn', 'thorium-design' ),
					) ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Share on LinkedIn', 'thorium-design' ); ?></span>
				</a>
			</li>
		</ul>
	</div><!-- .social-share -->
	<?php
}

/**
 * Display the social links saved in the customizer.
 */
function thd_display_social_network_links() {

	// Create an array of our social links for ease of setup.
	// Change the order of the networks in this array to change the output order.
	$social_networks = array( 'facebook', 'googleplus', 'instagram', 'linkedin', 'twitter' );

	?>
	<ul class="social-icons">
		<?php
		// Loop through our network array.
		foreach ( $social_networks as $network ) :

			// Look for the social network's URL.
			$network_url = get_theme_mod( 'thd_' . $network . '_link' );

			// Only display the list item if a URL is set.
			if ( ! empty( $network_url ) ) : ?>
				<li class="social-icon <?php echo esc_attr( $network ); ?>">
					<a href="<?php echo esc_url( $network_url ); ?>">
						<?php echo thd_get_svg( array( // WPCS: XSS ok.
							'icon'  => $network . '-square',
							'title' => /* translators: the social network name */ sprintf( esc_html_e( 'Link to %s', 'thorium-design' ), ucwords( esc_html( $network ) ) ),
						) ); ?>
						<span class="screen-reader-text"><?php echo /* translators: the social network name */ sprintf( esc_html_e( 'Link to %s', 'thorium-design' ), ucwords( esc_html( $network ) ) ); // WPCS: XSS ok. ?></span>
					</a>
				</li><!-- .social-icon -->
			<?php endif;
		endforeach; ?>
	</ul><!-- .social-icons -->
	<?php
}
