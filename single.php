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
          <?php previous_post_link('上一篇：%link'); ?>
          <?php next_post_link('下一篇：%link'); ?>
        </section>
      </section>
      <?php get_sidebar(); ?>
    </div>
  </section>
</section>
<?php get_footer(); ?>