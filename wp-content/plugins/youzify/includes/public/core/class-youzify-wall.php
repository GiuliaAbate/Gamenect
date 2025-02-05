<?php

class Youzify_Wall {

	/**
	 * Instance of this class.
	 */
	protected static $instance = null;

	/**
	 * Return the instance of this class.
	 *
	 * @since 3.0.0
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

    public function __construct() {

    	// Enqueue Scripts.
    	if ( bp_is_activity_component() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
    	} elseif ( ! is_admin() ) {
	    	$this->scripts();
    	}

    	// Include Wall Functions.
    	$this->include_files();

    	// Add Wall Sidebar.
		add_action( 'youzify_activity_stream_sidebar', array( $this, 'add_sidebar' ) );

    	// Add Left Sidebar.
		// add_action( 'youzify_activity_stream_left_sidebar', array( $this, 'add_left_sidebar' ) );

		// Fomat Post
		add_filter( 'bp_insert_activity_meta', array( $this, 'hide_activity_time_stamp' ),10, 2 );
		add_filter( 'bp_get_activity_content_body', array( $this, 'get_activity_content_body' ), 10, 2 );

		// Open Activity Post and Comment link on new tabs.
		add_filter( 'bp_activity_comment_content', array( $this, 'open_links_in_new_tabs' ) );
		add_filter( 'bp_activity_comment_content', array( $this, 'add_comment_attachments' ) );
		add_filter( 'bp_get_the_thread_message_content', array( $this, 'open_links_in_new_tabs' ) );

	    // Remove Activity Action Filter
	    remove_filter( 'bp_get_activity_action', 'bp_activity_filter_kses', 1 );

		// Add Embed Urls in a new line so they can be converted to iframes.
		add_filter( 'youzify_groups_activity_new_update_content', array( $this, 'activate_autoembed' ) );
		add_filter( 'bp_activity_new_update_content', array( $this, 'activate_autoembed' ) );

    }

    /**
     * Include Wall Files.
     */
    function include_files() {

    	// Include Files.
    	require YOUZIFY_CORE . 'wall/class-youzify-form.php';
    	require YOUZIFY_CORE . 'wall/class-youzify-functions.php';

    	do_action( 'youzify_activity_files' );

    }

    /**
	 * Check if Bookmarking Posts Option is Enabled.
	 */
	function is_bookmark_active() {
	    $activate = 'on' == youzify_option( 'youzify_enable_bookmarks', 'on' ) ? true : false;
	    return apply_filters( 'youzify_is_bookmarks_active', $activate );
	}

	/**
	 * Get Wall Post Content.
	 */
	function get_activity_content_body( $content = null, $activity = null ) {

	    // Check if activity content is not empty.
	    if ( ! empty( $content ) ) {
	    	$content = '<div class="activity-inner">' . $this->open_links_in_new_tabs( $content ) . '</div>';
	    }

	    // Add Embeds.
	    $content .= $this->embeds( $activity );

	    // Check if is read more action.
	    $is_read_more = $this->is_read_more();

	    // Add Attachments.
	    if ( ! $is_read_more ) {

	    	$attachments = $this->post_attachments( $activity );

			$content .= $attachments;

			if ( empty( $attachments ) ) {

				// Get Attachments
				$place_id = bp_activity_get_meta( $activity->id, 'youzify_checkin_place_id' );

				if ( ! empty( $place_id ) ) {
					$content .= '<div class="youzify-activity-map-unloaded" data-place_id="' . $place_id . '"></div>';
				}

			}

	    } elseif ( $is_read_more && 'activity_comment' == $activity->type ) {
			$content .= $this->add_comment_attachments();
	    }

	    return apply_filters( 'youzify_get_activity_content_body', $content, $activity );

	}

    /**
     * Post.
     */
    function embeds( $activity = null ) {

    	$content = '';

		switch ( $activity->type ) {

			case 'joined_group':
		        $content = bp_is_groups_component() ? $this->embed_user( $activity->user_id ) : $this->embed_group( $activity->item_id );
				break;

			case 'created_group':
		        $content = $this->embed_group( $activity->item_id );
				break;

			case 'new_member':
        		$content = $this->embed_user( $activity->user_id );
				break;

			case 'updated_profile':
        		$content = $this->embed_user( $activity->user_id );
				break;

			case 'friendship_created':
        		$user_id = ( bp_is_user() && bp_displayed_user_id() != $activity->user_id ) ? $activity->user_id : $activity->secondary_item_id;
        		$content = $this->embed_user( $user_id );
				break;

			case 'new_blog_post':
    			$content = $this->embed_post( $activity->item_id, $activity->secondary_item_id );
				break;

			case 'new_wc_purchase':
			case 'new_wc_product':
				do_action( 'youzify_show_wc_embed_product' );
				break;

			case 'new_tutor_course':
				do_action( 'youzify_show_new_tutor_course' );
				break;
			case 'new_tutor_enrolled_course':
				do_action( 'youzify_show_new_tutor_enrolled_course' );
				break;

			case 'new_lifterlms_course':
			case 'new_lifterlms_enrolled_course':
				do_action( 'youzify_show_new_lifterlms_course' );
				break;

			case 'new_learndash_course':
			case 'new_learndash_enrolled_course':
				do_action( 'youzify_show_new_learndash_course' );
				break;

			case 'new_learnpress_course':
			case 'new_learnpress_enrolled_course':
				do_action( 'youzify_show_new_learnpress_course' );
				break;

			case 'new_learndash_certificate':
				do_action( 'youzify_show_new_learndash_certificate' );
				break;

			case 'new_tutor_certificate':
				do_action( 'youzify_show_new_tutor_certificate' );
				break;

			case 'new_lifterlms_certificate':
				do_action( 'youzify_show_new_lifterlms_certificate' );
				break;

			case 'new_learndash_certificate':
				do_action( 'youzify_show_new_learndash_certificate' );
				break;

			case 'new_learnpress_certificate':
				do_action( 'youzify_show_new_learnpress_certificate' );
				break;
		}

		// Get Embed Post.
	    if ( ! empty( $content ) ) {
	    	$content = '<div class="youzify-activity-embed">' . $content . '</div>';
    	}

    	return $content;

    }

    /**
     * Comment Attachments.
     */
    function add_comment_attachments( $content = null ) {

    	// Get Comment ID.
    	$comment_id = bp_get_activity_comment_id();

    	if ( empty( $comment_id ) ) {
    		if ( isset( $_POST['activity_id'] ) && ! empty( $_POST['activity_id'] ) ) {
    			$comment_id = absint( $_POST['activity_id'] );
    		}
    	}

    	// Get Attachments.
		$attachments = bp_activity_get_meta( $comment_id, 'youzify_attachments' );

		if ( ! empty( $attachments ) ) {

			foreach ( $attachments as $attachment_id => $data ) {

			$item_url = wp_get_attachment_url( $attachment_id );

			ob_start();

			// Get File Type.
			$type = youzify_get_file_type( $item_url );

			switch ( $type ) {

				case 'image':

					?>
					<a href="<?php echo esc_url( $item_url ); ?>" rel="nofollow" class="youzify-img-with-padding" data-youzify-lightbox="youzify-post-<?php echo $comment_id; ?>"><img loading="lazy" <?php echo youzify_get_image_attributes( $attachment_id, 'youzify-comment', 'activity-comment' ); ?> alt=""></a>
					<?php
					break;

				case 'file':

					?>

					<a rel="nofollow" target="_blank" href="<?php echo esc_url( $item_url ); ?>" class="youzify-comment-file">
						<span class="youzify-file-icon"><i class="fas fa-download youzify-attachment-file-icon"></i></span>
						<span class="youzify-wall-file-details">
							<span class="youzify-wall-file-title"><?php echo youzify_get_filename_excerpt( $data['real_name'], 45 ); ?></span>
							<span class="youzify-wall-file-size"><?php echo youzify_file_format_size( $data['file_size'] ); ?></span>
						</span>
					</a>

					<?php

					break;

				case 'video':


					// Get Video Attributes
					$video_attributes = apply_filters( 'youzify_activity_post_video_attributes', 'controls' );

					// Get Video URL
					$video_url = wp_get_attachment_url( $attachment_id );

					echo apply_filters( 'youzify_get_wall_post_video', '<video width="100%" ' . $video_attributes . ' preload="metadata" type="video/quicktime"><source src="' . $video_url . '#t=0.001" type="video/mp4">' . __( 'Your browser does not support the video tag.', 'youzify' ) . '</video>', $video_url, $attachment_id, $data );
						break;

				case 'audio':

					// Get audio Link.
					$audio_link = wp_get_attachment_url( $attachment_id );

					// Get Audio Attribute
					$audio_attributes = apply_filters( 'youzify_activity_post_audio_attributes', 'controls' );

					echo apply_filters( 'youzify_get_wall_post_audio', '<audio ' . $audio_attributes . '><source src="' . $audio_link . '" type="audio/mpeg">' . __( 'Your browser does not support the audio element.', 'youzify' ) . '</audio>', $audio_link, $attachment_id );
					break;

			}

			}

			$attachments = ob_get_contents();

			ob_end_clean();

			$content =  $content . '<div class="youzify-comment-attachments">' . $attachments . '</div>';

		}

    	return $content;

    }

    /**
     * Get Wall Attachments.
     */
	function post_attachments( $activity = null ) {

		// Get Attachments
		$attachments = bp_activity_get_meta( $activity->id, 'youzify_attachments' );

		ob_start();

		// echo '<div class="youzify-post-attachments">';

		switch ( $activity->type ) {
			case 'activity_photo':
				$this->get_wall_post_images( $attachments, $activity->id );
				break;
			case 'activity_video':
				$this->get_wall_post_video( $attachments );
				break;
			case 'activity_link':
				$this->get_wall_post_link( $attachments, $activity->id );
				break;
			case 'activity_slideshow':
				$this->get_wall_post_slideshow( $attachments );
				break;
			case 'activity_file':
				$this->get_wall_post_file( $attachments );
				break;
			case 'activity_quote':
				$this->get_wall_post_quote( $attachments, $activity->id );
				break;
			case 'activity_audio':
				$this->get_wall_post_audio( $attachments );
				break;
			case 'new_cover':
				$this->get_wall_post_cover( $attachments );
				break;
			case 'new_avatar':
				$this->get_wall_post_avatar( $attachments, $activity->id  );
				break;
			case 'activity_giphy':
				$this->get_wall_post_giphy( $activity->id );
				break;
			case 'activity_share':
				$this->get_wall_shared_post( $activity->secondary_item_id );
				break;
		}

		// Get Url Preview
		$this->get_activity_url_preview( $activity->id, $activity->content );

		// echo '</div>';

		$content = ob_get_contents();

		ob_end_clean();

		if ( ! empty( $content ) ) {
			$content = '<div class="youzify-post-attachments">' . $content . '</div>';
		}

		return apply_filters( 'youzify_activity_attachment_content', $content, $activity );

	}

	/**
	 * Get Wall Shared Post
	 */
	function get_wall_shared_post( $activity_id ) {

		// Get Activity.
		global $activities_template;

        if ( $activities_template === null ) {
        	$activities_template = (object) array();
        }

        // Back up the global.
        $old_activities_template = $activities_template->activity;

		$activities_template->activity = new BP_Activity_Activity( $activity_id );

        $show_preview = true;

        if ( $this->get_privacy( $activity_id ) != 'public' ) {
        	$show_preview = false;
        }

		?>

		<div class="youzify-shared-wrapper">

			<div class="youzify-shared-wrapper-container">

				<?php if ( $show_preview ) : ?>

				<div class="youzify-shared-attachments"><?php

					$activity = $activities_template->activity;

					do_action( 'youzify_share_post_attachments', $activity );

				?></div>
				<div class="youzify-shared-description">
					<div class="youzify-shared-description-content">
						<?php $profile_url = bp_members_get_user_url( $activity->user_id ); ?>
						<div class="activity-avatar"><a href="<?php bp_activity_user_link(); ?>"><?php bp_activity_avatar() ?></a></div>
						<div class="youzify-shared-head">
							<a class="youzify-post-author" href="<?php bp_activity_user_link(); ?>"><?php echo bp_core_get_user_displayname( bp_get_activity_user_id() ); ?><?php youzify_the_user_verification_icon( bp_get_activity_user_id() ); ?></a>
							<div class="youzify-timestamp-area"><?php echo youzify_get_activity_time_stamp_meta(); ?></div>
						</div>
						<div class="youzify-shared-content"><?php bp_activity_content_body(); ?></div>
					</div>
				</div>
				<?php else: ?>
					<div class="youzify-shared-post-unavailable">
						<div class="title"><?php _e( "This content isn't available right now", 'youzify' ); ?></div>
						<p><?php _e( "When this happens, it's usually because the owner only shared it with a small group of people, change who can see it or it's been deleted.", 'youzify' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php

        $activities_template->activity = $old_activities_template;

	}

	/**
	 * Get Activity Privacy.
	 */
	function get_privacy( $activity_id ) {

		global $wpdb, $bp;

		// Prepare SQL
		$sql = $wpdb->prepare( "SELECT privacy from {$bp->activity->table_name} WHERE id = %d", $activity_id );

		// Update Privacy
		return $wpdb->get_var( $sql );

	}
	/**
	 * Open Wall Post & Comment Content On New Tab.
	 */
	function open_links_in_new_tabs( $content ) {

		if ( ! empty( $content ) ) {

		  	$pattern = '/<a(.*?)?href=[\'"]?[\'"]?(.*?)?>/i';

		    $content = preg_replace_callback( $pattern, function( $m ) {

		        $tpl = array_shift( $m );
		        $hrf = isset( $m[1] ) ? $m[1] : null;

		        if ( preg_match( '/target=[\'"]?(.*?)[\'"]?/i', $tpl ) ) {
		            return $tpl;
		        }

		        if ( trim( $hrf ) && 0 === strpos( $hrf, '#' ) ) {
		            return $tpl;
		        }

		        return preg_replace_callback( '/href=/i', function( $m2 ) {
		            return sprintf( 'target="_blank" %s', array_shift( $m2 ) );
		        }, $tpl );

	    	}, $content );

		}

		return $content;
	}

	/**
	 * Cover Post.
	 */
	function get_wall_post_cover( $attachments ) {

		if ( ! empty( $attachments ) ) {

			foreach ( $attachments as $media_id => $data ) {
				echo '<img loading="lazy" ' . youzify_get_image_attributes( $media_id, 'youzify-wide', 'activity-cover-image' ) . ' alt="">';

			}
		}

	}

	/**
	 * Avatar Post.
	 */
	function get_wall_post_avatar( $attachments, $activity_id ) {

		if ( ! empty( $attachments ) ) {

			foreach ( $attachments as $media_id => $data ) {
				echo '<a href="' . wp_get_attachment_image_url( $media_id ) . '" data-youzify-lightbox="youzify-post-' . $activity_id . '" class="youzify-img-with-padding"><img loading="lazy" ' . youzify_get_image_attributes( $media_id, 'full', 'activity-avatar-image' ) . ' alt=""></a>';
			}

		}

	}

	/**
	 * Cover Post.
	 */
	function get_wall_post_giphy( $activity_id ) {

		// Get Image Url.
		$img_url = bp_activity_get_meta( $activity_id, 'giphy_image' );

		?>
		<a href="<?php echo esc_url( $img_url ); ?>" rel="nofollow" class="youzify-img-with-padding" data-youzify-lightbox="youzify-post-<?php echo $activity_id; ?>"><img loading="lazy" <?php echo youzify_get_image_attributes_by_link( $img_url ); ?> alt=""></a>
		<?php

	}

	/**
	 * Quote Post.
	 */
	function get_wall_post_quote( $attachments, $activity_id ) { ?>

	    <div class="youzify-wall-quote-post">
		    <div class="youzify-wall-quote-content quote-with-img">
		        <?php if ( ! empty( $attachments ) ) : foreach ( $attachments as $media_id => $data ) { ?><img loading="lazy" <?php echo youzify_get_image_attributes( $media_id, 'youzify-wide', 'activity-quote' ); ?> alt=""><?php } endif; ?>
		        <div class="youzify-wall-quote-main-content">
		            <div class="youzify-wall-quote-icon"><i class="fas fa-quote-right"></i></div>
		            <blockquote><?php echo bp_activity_get_meta( $activity_id, 'youzify-quote-text' ); ?></blockquote>
		            <h3 class="youzify-wall-quote-owner"><?php echo bp_activity_get_meta( $activity_id, 'youzify-quote-owner' ); ?></h3>
		        </div>
		    </div>
	    </div>

		<?php
	}

	/**
	 * File Post.
	 */
	function get_wall_post_file( $attachments ) {

		foreach ( $attachments as $media_id => $data ) {

			$url = apply_filters( 'youzify_activity_file_download_url',  wp_get_attachment_url( $media_id ), $media_id );

		?>

		<div class="youzify-wall-file-post">
			<i class="fas fa-cloud-download-alt youzify-wall-file-icon"></i>
			<div class="youzify-wall-file-details">
				<div class="youzify-wall-file-title"><?php echo youzify_get_filename_excerpt( $data['real_name'], 45 ); ?></div>
				<div class="youzify-wall-file-size"><?php echo youzify_file_format_size( $data['file_size'] ); ?></div>
			</div>
			<a rel="nofollow" target="_blank" href="<?php echo esc_url( $url ); ?>" class="youzify-wall-file-download"><i class="fas fa-download"></i><?php _e( 'Download', 'youzify' ); ?></a>
		</div>

		<?php

		}

	}

	/**
	 * Link Post.
	 */
	function get_wall_post_link( $attachments, $activity_id ) {

		// Get Link Data
		$link_url = bp_activity_get_meta( $activity_id, 'youzify-link-url' );

		?>

		<a class="youzify-wall-link-content" rel="nofollow" href="<?php echo esc_url( $link_url ); ?>" target="_blank">
			<?php if ( ! empty( $attachments ) ) : foreach ( $attachments as $media_id => $data ) { ?><img loading="lazy" <?php echo youzify_get_image_attributes( $media_id, 'youzify-activity-wide', 'activity-link' ); ?> alt=""><?php } endif; ?>
			<div class="youzify-wall-link-data">
				<div class="youzify-wall-link-title"><?php echo bp_activity_get_meta( $activity_id, 'youzify-link-title' ); ?></div>
				<div class="youzify-wall-link-desc"><?php echo bp_activity_get_meta( $activity_id, 'youzify-link-desc' ); ?></div>
				<div class="youzify-wall-link-url"><?php echo $link_url; ?></div>
			</div>
		</a>

		<?php
	}

	/**
	 * Get Url Preview
	 */
	function get_activity_url_preview( $activity_id, $activity_content = null ) {

		if ( $this->is_read_more() ) {
			return;
		}

		// Get Url Data.
		$url = bp_activity_get_meta( $activity_id, 'url_preview' );

		if ( empty( $url ) ) {
			return;
		}

		// Unserialize data.
		$url = is_serialized( $url ) ? unserialize( $url ) : maybe_unserialize( base64_decode( $url ) );

		if ( ! $this->show_url_preview( $url, $activity_content ) ) {
			return;
		}

		?>

		<a class="youzify-wall-link-content" rel="nofollow" href="<?php echo esc_url( $url['link'] ); ?>" target="_blank">
			<?php if ( ! empty( $url['image'] ) && ( empty( $url['use_thumbnail'] ) || $url['use_thumbnail'] == 'off' ) ) : ?><img loading="lazy" <?php echo youzify_get_image_attributes_by_link( $url['image'] ); ?> alt=""><?php endif; ?>
			<div class="youzify-wall-link-data">
				<?php if ( ! empty( $url['title'] ) ) : ?><div class="youzify-wall-link-title"><?php echo $url['title']; ?></div><?php endif; ?>
				<?php if ( ! empty( $url['description'] ) ) : ?><div class="youzify-wall-link-desc"><?php echo $url['description']; ?></div><?php endif; ?>
				<?php if ( ! empty( $url['site'] ) ) : ?><div class="youzify-wall-link-url"><?php echo $url['site']; ?></div><?php endif; ?>
			</div>
		</a>
		<?php

	}

	/**
	 * Check if we should show Live Url Preview.
	 **/
	function show_url_preview( $data, $activity_content = null ) {

		if ( apply_filters( 'youzify_pass_checking_for_embed_link', false ) ) {
			return true;
		}
		
		$show = true;

		// Get Preview Link.
		$preview_link = ! empty( $data['link'] ) ? $data['link'] : null;

		if ( empty( $data ) || empty( $preview_link ) ) {
			$show = false;
		}

		// Get Oembed Class.
		$oembed = new WP_oEmbed();

		if ( $show == true ) {

			// Get Post Urls.
			preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $activity_content, $match );

			if ( isset( $match[0] ) && ! empty( $match[0] ) ) {

				// Get Current Site Domaine
				$site_domain = parse_url( site_url(), PHP_URL_HOST);

				foreach ( array_unique( $match[0] ) as $link ) {

					// Avoid Self-domain Links
				    if ( strpos( $link, $site_domain ) !== false ) {
				        continue;
				    }

					if ( strpos( $link, '?s=%23' ) !== false ) {
						continue;
					}

					$provider = $oembed->get_provider( $link, [ 'discover' => true ] );

					if ( false !== $provider ) {
						$show = false;
						break;
					}

				}

			}
		}

		return apply_filters( 'youzify_display_activity_live_url_preview', $show, $data );
	}

	/**
	 * Audio Post.
	 */
	function get_wall_post_audio( $attachments ) {

		// Get Audio Link.
		foreach ( $attachments as $media_id => $data ) {

			// Get Audio Link
			$audio_link = wp_get_attachment_url( $media_id );

			// Get Audio Attribute
			$audio_attributes = apply_filters( 'youzify_activity_post_audio_attributes', 'controls' );


			echo apply_filters( 'youzify_get_wall_post_audio', '<audio '. $audio_attributes .'><source src="' . $audio_link . '" type="audio/mpeg">' . __( 'Your browser does not support the audio element.', 'youzify' ) . '</audio>', $audio_link );
		}

	}

	/**
	 * Video Post.
	 */
	function get_wall_post_video( $attachments ) {

		if ( isset( $attachments[0] ) ) {
			return;
		}

		if ( ! empty( $attachments ) ) {

			foreach ( $attachments as $media_id => $data ) {

				// Get Video Poster.
				$poster = isset( $data['thumbnail'] ) ? wp_get_attachment_url( $data['thumbnail'], 'full' ) : '';

				// Get Video Attributes
				$video_attributes = apply_filters( 'youzify_activity_post_video_attributes', 'controls' );

				// Get Video URL
				$video_url = wp_get_attachment_url( $media_id );

				echo apply_filters( 'youzify_get_wall_post_video', '<video width="100%" ' . $video_attributes . ' preload="metadata" type="video/quicktime" poster="' . $poster . '"><source src="' . $video_url . '#t=0.001" type="video/mp4">' . __( 'Your browser does not support the video tag.', 'youzify' ) . '</video>', $video_url, $media_id, $data );
			}

		}
	}

	/**
	 * Slideshow Post.
	 */
	function get_wall_post_slideshow( $slides ) { ?>

	    <div class="youzify-wall-slider youzify-slides-<?php echo youzify_option( 'youzify_slideshow_height_type', 'fixed' ); ?>-height">
	    <?php foreach ( $slides as $media_id => $data ) : ?><div class="youzify-wall-slideshow-item"><img loading="lazy" <?php echo youzify_get_image_attributes( $media_id, 'youzify-wide', 'activity-slideshow' ); ?> alt=""></div><?php endforeach; ?>
		</div>

		<?php
	}

	/**
	 * Photo Post.
	 */
	function get_wall_post_images( $attachments, $activity_id ) {

		if ( empty( $attachments ) ) {
			return;
		}

		// Get Attachments number.
		$count_atts = count( $attachments );

		if ( 1 == $count_atts ) {

			foreach( $attachments as $media_id => $data ) : ?>

			<a href="<?php echo esc_url( wp_get_attachment_image_url( $media_id, 'full' ) ); ?>" rel="nofollow" class="youzify-img-with-padding" data-youzify-lightbox="youzify-post-<?php echo $activity_id; ?>"><img loading="lazy" <?php echo youzify_get_image_attributes( $media_id, 'youzify-wide', 'activity-photo' ); ?> alt=""></a>

			<?php endforeach; } elseif ( 2 == $count_atts || 3 == $count_atts ) { ?>

			<div class="youzify-post-<?php echo $count_atts; ?>imgs">

				<?php $n = 0; foreach( $attachments as $media_id => $data ) : $n++;?>
					<a class="youzify-post-img<?php echo $n;?>" rel="nofollow" href="<?php echo esc_url( wp_get_attachment_image_url( $media_id, 'full' ) ); ?>" data-youzify-lightbox="youzify-post-<?php echo $activity_id; ?>">
						<div class="youzify-post-img"><img loading="lazy" <?php echo youzify_get_image_attributes( $media_id, 'youzify-medium', 'activity-photo' ); ?> alt=""></div>
					</a>

				<?php endforeach; ?>

			</div>

		<?php } elseif ( 4 <= $count_atts ) { ?>

			<div class="youzify-post-4imgs">
				<?php $i = 0; foreach( $attachments as $media_id => $data ) : ?>
				<a class="youzify-post-img<?php echo $i + 1; if ( 3 == $i && $count_atts > 4  ) { echo ' youzify-post-plus4imgs'; }?>" href="<?php echo esc_url( wp_get_attachment_image_url( $media_id, 'full' ) ); ?>" rel="nofollow" data-youzify-lightbox="youzify-post-<?php echo $activity_id; ?>">
					<div class="youzify-post-img">
						<?php $size = $i == 0 ? 'youzify-wide' : 'youzify-medium'; ?>
						<img loading="lazy" <?php echo youzify_get_image_attributes( $media_id, $size, 'activity-photo' ); ?> alt="">
						<?php
							if ( 3 == $i && $count_atts > 4 ) {
								$images_nbr = $count_atts - 4;
								echo '<span class="youzify-post-imgs-nbr">+' . $images_nbr . '</span>';
							}
						?>
					</div>
				</a>

				<?php $i++; endforeach; ?>

			</div>
			<?php
		}
	}

	/**
	 * 	Wall Embed Group
	 */
	function embed_group( $group_id = false ) {

		if ( ! $group_id ) {
			return false;
		}

	    $group = groups_get_group( array( 'group_id' => $group_id ) );

	    // Get Profile Link.
	    $group_url = bp_get_group_url( $group );

	    // Get Group Members Number
	    $members_count = bp_get_group_total_members( $group );

		ob_start();

		?>

	 	<div class="youzify-wall-embed youzify-wall-embed-group">
	 		<div class="youzify-cover"><?php echo youzify_get_group_cover( $group_id ); ?></div>
	 		<a href="<?php echo esc_url( $group_url ); ?>" class="youzify-embed-avatar"><?php echo bp_core_fetch_avatar( array( 'item_id' => $group_id, 'type' => 'full', 'html' => true, 'object' => 'group' ) ); ?></a>
	 		<div class="youzify-embed-data">
	 			<div class="youzify-embed-head">
		 			<a href="<?php echo esc_url( $group_url ); ?>" class="youzify-embed-name"><?php echo $group->name; ?></a>
		 			<div class="youzify-embed-meta">
		 				<div class="youzify-embed-meta-item"><?php echo youzify_get_group_status( $group->status ); ?></div>
		 				<div class="youzify-embed-meta-item">
		 					<i class="fas fa-users"></i><span><?php echo sprintf( _n( '%s Member', '%s Members', $members_count, 'youzify' ), bp_core_number_format( $members_count ) ); ?></span>
		 				</div>
		 			</div>
	 			</div>
	 			<div class="youzify-embed-action">
	 				<?php do_action( 'youzify_wall_embed_group_actions' );?>
	 				<?php bp_group_join_button( $group ); ?>
	 			</div>
	 		</div>
	 	</div>

		<?php

		$content = ob_get_contents();

		ob_end_clean();

		return $content;

	}

	/**
	 * Wall Embed User
	 */
	function embed_user( $user_id = false ) {

		if ( ! $user_id ) {
			return false;
		}

		ob_start();

	    // Get Profile Link.
	    $profile_url = bp_members_get_user_url( $user_id );

		?>

	 	<div class="youzify-wall-embed youzify-wall-embed-user">
	 		<div class="youzify-cover"><?php echo youzify_get_user_cover( $user_id );  ?></div>
	 		<a href="<?php echo esc_url( $profile_url ); ?>" class="youzify-embed-avatar"><?php echo bp_core_fetch_avatar(
			array( 'item_id' => $user_id, 'type' => 'full', 'html' => true ) ); ?></a>
	 		<div class="youzify-embed-data">
	 			<div class="youzify-embed-head">
		 			<a href="<?php echo esc_url( $profile_url ); ?>" class="youzify-embed-name"><?php echo bp_core_get_user_displayname( $user_id ); ?></a>
		 			<div class="youzify-embed-meta">@<?php echo bp_members_get_user_slug( $user_id ); ?></div>
	 			</div>
	 			<div class="youzify-embed-action">
	 				<?php do_action( 'youzify_wall_embed_user_actions' ); ?>
	 				<?php if ( bp_is_active( 'friends' ) ) { bp_add_friend_button( $user_id ); } ?>
	 				<?php youzify_send_private_message_button( $user_id ); ?>
	 			</div>
	 		</div>
	 	</div>

		<?php

		$content = ob_get_contents();

		ob_end_clean();

		return $content;

	}

	/**
	 * 	Wall New Post Thumbnail&a
	 */
	function embed_post_thumbnail( $post_id = false ) {

		// Get Image ID.
		$img_id = get_post_thumbnail_id( $post_id );

		// Get Image Url.
	    $img_url = wp_get_attachment_image_src( $img_id , 'large' );

	    if ( ! empty( $img_url[0] ) ) {
	        $thumbnail = '<img loading="lazy" '. youzify_get_image_attributes_by_link( $img_url[0] ) . ' alt="">';
	    } else {

	    	// Get Post Format
	    	$post_format = get_post_format();

	        // Set Post Format
	        $format = ! empty( $post_format ) ? $post_format : 'standard';

	        // Get Thumbnail.
	        $thumbnail = '<div class="youzify-wall-nothumb" style="background-image:url( ' . YOUZIFY_ASSETS . 'images/geopattern.png);"><div class="youzify-thumbnail-icon"><i class="' . youzify_get_format_icon( $format ) . '"></i></div></div>';

	    }

	    return $thumbnail;
	}

	/**
	 * 	Wall Embed Post
	 */
	function embed_post( $blog_id = false, $post_id = false ) {

		if ( ! $post_id ) {
			return false;
		}

	    switch_to_blog( $blog_id );

	    // Get Post Data.
	    $post = get_post( $post_id );

	    // Get Categories
	    $post_link = get_the_permalink( $post_id );
	    $post_tumbnail = $this->embed_post_thumbnail( $post_id );
	    $categories = get_the_category_list( ', ', ' ', $post_id );

	    restore_current_blog();


		ob_start();

		?>

	 	<div class="youzify-wall-new-post">
	 		<div class="youzify-post-img"><a href="<?php echo esc_url( $post_link ); ?>"><?php echo $post_tumbnail; ?></a></div>

	 		<?php do_action( 'youzify_after_wall_new_post_thumbnail', $post_id ); ?>

	 		<div class="youzify-post-inner">

		 		<div class="youzify-post-head">
		 			<div class="youzify-post-title"><a href="<?php echo esc_url( $post_link ); ?>"><?php echo $post->post_title; ?></a></div>
		 			<div class="youzify-post-meta">
		 				<?php if ( ! empty( $categories ) ) : ?>
		 				<div class="youzify-meta-item"><i class="fas fa-tags"></i><?php echo $categories; ?></div>
		 				<?php endif; ?>
		 				<div class="youzify-meta-item"><i class="far fa-calendar-alt"></i><?php echo get_the_date( 'F j, Y', $post_id ); ?></div>
		 				<div class="youzify-meta-item"><i class="far fa-comments"></i><?php echo $post->comment_count; ?></div>
		 			</div>
		 		</div>
		 		<div class="youzify-post-excerpt">
			        <p><?php echo youzify_get_excerpt( $post->post_content, 40 ); ?></p>
		 		</div>
		 		<?php do_action( 'youzify_activity_new_blog_post_before_read_more', $post ); ?>
		 		<a href="<?php echo esc_url( $post_link ); ?>" class="youzify-post-more-button"><span class="youzify-btn-icon"><i class="fas fa-angle-double-right"></i></span><span class="youzify-btn-title"><?php echo apply_filters( 'youzify_wall_embed_blog_post_read_more_button', __( 'Read More', 'youzify' ) ); ?></span></a>
	 		</div>
	 	</div>

		<?php

		$content = ob_get_contents();

		ob_end_clean();

		return $content;

	}

    /**
     * Activate Embeds.
     */
	function activate_autoembed( $content ) {

		// Get Post Urls.
		preg_match_all( '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match );

		if ( ! isset( $match[0] ) && empty( $match[0] ) ) {
			return $content;
		}

		foreach ( array_unique( $match[0] ) as $link ) {

			if ( ! wp_oembed_get( $link ) ) {
				continue;
			}

			$content = str_replace( $link, "\n$link\n", $content );
		}

		return $content;

	}

	/**
	 * Get Wall Comments.
	 */
	function show_wall_post_comments_number() {

		// Check if comments allowed.
		if ( ! bp_activity_can_comment() ) {
			return false;
		}

		if ( is_user_logged_in() || 0 == bp_activity_get_comment_count() ) {
			return false;
		}

		?>
		<div class="youzify-post-comments-count" activity_id="<?php echo get_the_ID(); ?>"><i class="far fa-comments"></i><?php youzify_wall_get_comment_button_title(); ?></div>
		<?php

	}

	/**
	 * Call Activity Stream Sidebar.
	 */
	function add_sidebar( $layout ) {

		if ( ! apply_filters( 'youzify_activate_activity_stream_sidebar', true ) ) {
			return;
		}

		if ( $layout != 'youzify-right-sidebar-layout'  ) {

			echo '<div class="youzify-sidebar-column youzify-sidebar youzify-left-sidebar">';
			echo '<div class="youzify-column-content">';

		  	// Display Widgets.
			if ( is_active_sidebar( 'youzify-wall-left-sidebar' ) ) {
				do_action( 'youzify_before_wall_left_sidebar' );
				dynamic_sidebar( 'youzify-wall-left-sidebar' );
				do_action( 'youzify_after_wall_left_sidebar' );
			}

			echo '</div></div>';

		}

		if (  $layout != 'youzify-left-sidebar-layout' ) {

			echo '<div class="youzify-sidebar-column youzify-sidebar youzify-right-sidebar">';
			echo '<div class="youzify-column-content">';

		  	// Display Widgets.
			if ( is_active_sidebar( 'youzify-wall-sidebar' ) ) {
				do_action( 'youzify_before_wall_right_sidebar' );
				dynamic_sidebar( 'youzify-wall-sidebar' );
				do_action( 'youzify_after_wall_right_sidebar' );
			}

			echo '</div></div>';

		}

	}

    /**
     * Activity Scripts.
     */
    function scripts() {

	    // Wall JS.
	    wp_enqueue_script( 'youzify-wall', YOUZIFY_ASSETS . 'js/youzify-wall.min.js', array( 'jquery' ), YOUZIFY_VERSION );

		$api_key = youzify_option( 'youzify_google_map_api_key' );

		if ( ! empty( $api_key ) ) {
			wp_enqueue_script( 'youzify-google-map', 'https://maps.googleapis.com/maps/api/js?libraries=places&key=' . $api_key, array( 'jquery', 'jquery-ui-autocomplete' ), YOUZIFY_VERSION );
		}

	    // Wall Css
	    wp_enqueue_style( 'youzify-wall', YOUZIFY_ASSETS . 'css/youzify-wall.min.css', array(), YOUZIFY_VERSION );

	    // Load Profile Style
	    wp_enqueue_style( 'youzify-profile', YOUZIFY_ASSETS . 'css/youzify-profile.min.css', array(), YOUZIFY_VERSION );;

	    // Load Carousel CSS and JS.
	    wp_enqueue_style( 'youzify-carousel-css', YOUZIFY_ASSETS . 'css/youzify-owl-carousel.min.css', array(), YOUZIFY_VERSION );
	    wp_enqueue_script( 'youzify-carousel-js', YOUZIFY_ASSETS . 'js/youzify-owl-carousel.min.js', array(), YOUZIFY_VERSION );
	    wp_enqueue_script( 'youzify-slider', YOUZIFY_ASSETS . 'js/youzify-slider.min.js', array(), YOUZIFY_VERSION );

	    if ( is_user_logged_in() ) {

	        global $Youzify_upload_url;

	        $wall_jquery = array( 'jquery' );

	        if ( is_user_logged_in() ) {
	        	$wall_jquery[] = 'jquery-ui-sortable';
	        }

	        // Wall Uploader
	        wp_enqueue_script( 'youzify-wall-form', YOUZIFY_ASSETS . 'js/youzify-wall-form.min.js', $wall_jquery, YOUZIFY_VERSION, true );

	        $wall_args = apply_filters( 'Youzify_wall_js_args', array(
                'poll_max_options'  => __( 'The max number of allowed options is %d.', 'youzify' ),
                'max_one_file'      => __( "You can't upload more than one file.", 'youzify' ),
                'base_url'          => $Youzify_upload_url,
                'wp_url'			=> site_url(),
                'giphy_limit'       => 12,
            ) );

	        // Localize Script.
	        wp_localize_script( 'youzify-wall-form', 'Youzify_Wall', $wall_args );

	        // if ( 'on' == youzify_option( 'youzify_enable_wall_giphy', 'on' ) ) {
	            // Giphy Script.
	        wp_enqueue_script( 'youzify-giphy', YOUZIFY_ASSETS . 'js/youzify-giphy.min.js', array( 'jquery' ), YOUZIFY_VERSION, true );
	        // }

	    }

	    if ( youzify_enable_wall_posts_effect() ) {
	        // Load View Port Checker Script
	        wp_enqueue_script( 'youzify-viewchecker', YOUZIFY_ASSETS . 'js/youzify-viewportChecker.min.js', array( 'jquery' ), YOUZIFY_VERSION, true  );
	    }

	    // if its not the activity directory exit.
	    if ( bp_is_activity_directory() && 'on' == youzify_option( 'youzify_enable_activity_custom_styling', 'off' ) ) {
	        // Get CSS Code.
	        $custom_css = youzify_option( 'youzify_activity_custom_styling' );
	        if ( ! empty( $custom_css ) ) {
	            // Custom Styling File.
	            wp_enqueue_style( 'youzify-customStyle', YOUZIFY_ADMIN_ASSETS . 'css/custom-script.css' );
	            wp_add_inline_style( 'youzify-customStyle', $custom_css );
	        }
	    }

	    do_action( 'youzify_activity_scripts' );
    }

	/**
	 * Hide Activity Content Tipstamp.
	 */
    function hide_activity_time_stamp( $new_content, $old_content ) {
    	return $old_content;
    }

	/**
	 * Is Read More
	 */
	function is_read_more() {
		return isset( $_POST['action'] ) && $_POST['action'] == 'get_single_activity_content';
	}
	/**
	 * Is Read More
	 */
	function is_comment_read_more( $activity_type ) {
		return $this->is_read_more() && $activity_type == 'activity_comment';
	}


}

/**
 * Get a unique instance of Youzify Activity.
 */
function youzify_activity() {
	return Youzify_Wall::get_instance();
}

/**
 * Launch Youzify Activity!
 */
youzify_activity();