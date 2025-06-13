<section class="sidebar">
  <div class="alert alert-primary" role="alert">
    阿里巴巴集团控股支持的中国食品配送服务公司饿了么已承诺为其约 300 万外卖配送员提供更多的社会保障和福利，继 3 月份京东也采取类似举措，将其灵活就业的物流工人纳入该公司的社会保障和福利计划之后阿里巴巴也就采取类似措施。
  </div>
  <?php
    if ( is_singular('post') ):
      dynamic_sidebar('cv_posts_details_sidebar');
    else:
      dynamic_sidebar('cv_index_sidebar');
    endif;
   ?>
<!--  <section class="post-directory">-->
<!--    <h3 class="directory-title">文章目录</h3>-->
<!--    --><?php //echo clover_directory(); ?>
<!--  </section>-->
  <!-- 分类 -->
  <?php do_action('qm/debug', _clover('sidebar-tags'))?>
  <div class="clover-category">
    <div class="clover-category__title">分类</div>
    <div class="clover-category__list">
      <div class="clover-category__list__item">
        <h2 class="clover-category__list__item__title">JavaScript</h2>
        <span class="clover-category__list__item__total">(20)</span>
      </div>
      <div class="clover-category__list__item">
        <h2 class="clover-category__list__item__title">Python</h2>
        <span class="clover-category__list__item__total">(30)</span>
      </div>
      <div class="clover-category__list__item">
        <h2 class="clover-category__list__item__title">Golang</h2>
        <span class="clover-category__list__item__total">(100)</span>
      </div>
      <div class="clover-category__list__item">
        <h2 class="clover-category__list__item__title">C++</h2>
        <span class="clover-category__list__item__total">(8)</span>
      </div>
      <div class="clover-category__list__item">
        <h2 class="clover-category__list__item__title">Java</h2>
        <span class="clover-category__list__item__total">(208)</span>
      </div>
    </div>
  </div>
  <?php get_template_part( 'templates-parts/common/tags-cloud' ); ?>
  <!-- 个人介绍 -->

</section>