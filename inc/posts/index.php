<?php

function clover_get_posts_list() {
  $args = array('posts_per_page' => 10);
  $results = new WP_Query($args);
  if ( $results->have_posts() ):
    echo '<ul class="posts-list-wrapper">';
    while ( $results->have_posts() ) {
      $results->the_post();
      ?>
      <li class="post-item">
        <a class="post-item-link" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
      </li>
      <?php
    }
    echo '</ul>';
  endif;
  wp_reset_postdata();
}

