<?php get_header(); ?>
<section class="clover-main">
  <section class="post-header-info">
    <div class="header-info-wrapper container">
      <h1 class="post-title"><?php the_title(); ?></h1>
      <h5 class="post-meta">
        <span class="meta-item meta-time">5天前</span>
        <span class="meta-item meta-read">阅读&nbsp;&nbsp;12k</span>
        <span class="meta-item meta-praise">点赞&nbsp;&nbsp;20</span>
        <span class="meta-item meta-comment">评论&nbsp;&nbsp;20</span>
      </h5>
    </div>
  </section>
  <section class="post-main">
    <div class="post-core-wrapper container flex-layout">
      <section class="post-area">
        <section class="post-wrapper">
          <article class="post-core" id="post-core">
            <?php while(have_posts()): the_post(); ?>
              <?php the_content(); ?>
            <?php endwhile; ?>
          </article>
          <?php get_template_part( 'templates-parts/content/entry-tags' ); ?>
          <section class="paging-previous-next">
            <?php
              $prev_post = get_previous_post();
              if ($prev_post) {
                $prev_title = apply_filters('the_title', $prev_post->post_title);
                $prev_date = get_the_date('', $prev_post);
                $prev_link = get_permalink($prev_post->ID);

                echo <<<HTML
                  <div class="nav-previous">
                    <a class="nav-previous-link" href="{$prev_link}">
                        <span class="post-title">{$prev_title}</span>
                        <span class="post-date">{$prev_date}</span>
                    </a>
                  </div>
                HTML;
              }
            ?>
            <?php
              $next_post = get_next_post();
              if ($next_post) {
                $next_title = apply_filters('the_title', $next_post->post_title);
                $next_date = get_the_date('', $next_post);
                $next_link = get_permalink($next_post->ID);

                echo <<<HTML
                  <div class="nav-next">
                    <a class="nav-next-link" href="{$next_link}">
                        <span class="post-title">{$next_title}</span>
                        <span class="post-date">{$next_date}</span>
                    </a>
                  </div>
                HTML;
              }
            ?>
          </section>
        </section>
      </section>
      <?php get_sidebar(); ?>
    </div>
  </section>
</section>
<?php get_footer(); ?>