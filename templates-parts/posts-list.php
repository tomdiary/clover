<section class="posts-list">
  <?php
    // 遍历
    if (have_posts()) {
      echo '<div class="posts-list-wrapper">';
      while (have_posts()) {
        the_post();
        ?>
        <article class="post-item">
          <section class="post-wrapper">
            <h2 class="post-title">
              <a
                class="post-link"
                href="<?php the_permalink() ?>"
                title="<?php the_title() ?>">
                <?php the_title() ?>
              </a>
            </h2>
            <div class="post-logo">
              <img src="<?php echo get_post_thumbnail_url(get_the_ID()); ?>" alt="<?php the_title() ?>" />
            </div>
            <div class="post-description">
              <p><?php echo clover_str_post_content(180, ''); ?></p>
            </div>
          </section>
        </article>
        <?php
      }
      echo '</ul>';
    }
    clover_posts_pagination();
  ?>
</section>