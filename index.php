<?php get_header(); ?>
  <section class="clover-main container">
    <section class="section-wrapper section-wrapper-flex">
      <?php get_template_part( 'templates-parts/posts-list' ); ?>
      <?php get_sidebar(); ?>
    </section>
  </section>
<?php get_footer(); ?>