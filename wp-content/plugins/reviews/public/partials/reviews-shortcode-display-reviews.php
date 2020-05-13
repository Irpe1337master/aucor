<?php

/**
 * HTML for adding review. Used by shortcode
 *
 * @link       iirohongisto.com
 * @since      1.0.0
 *
 * @package    Reviews
 * @subpackage Reviews/public/partials
 */

// The Loop
?>
<h4>Reviews by other people!</h4>
<?php
if ( $reviews ) {
    foreach ( $reviews as $review ) {
      echo '<div class="border-bottom">';
        echo '<h5>' . esc_html( $review->post_title ) . '</h5>';
        echo '<p>' . esc_html( $review->post_content ) . '</p>';

        $review_score = wp_get_post_terms($review->ID, 'review_score', array( 'fields' => 'names' ));

        if ($review_score) {
          echo '<strong>Score: ' . esc_html( $review_score[0] ) . '</strong>';
        }

      echo '</div>';
    }
} else {
    echo '<p>'. __('No reviews found!', 'aucor') .'</p>';
}
