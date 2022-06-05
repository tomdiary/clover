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
  <section class="single-core">
    <div class="single-core-wrapper container">
      <section class="post-area post-area-flex">
        <section class="post-wrapper">
          <?php while(have_posts()): the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
          <?php the_tags(); ?>
        </section>
        <?php get_sidebar(); ?>
      </section>
    </div>
  </section>
</section>
<?php get_footer(); ?>