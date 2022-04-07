<section class="sidebar">
  <div class="alert alert-primary" role="alert">
    A simple primary alert—check it out!
  </div>
  <?php 
    if ( is_singular('post') ):
      dynamic_sidebar('cv_posts_details_sidebar');
    else:
      dynamic_sidebar('cv_index_sidebar');
    endif;
   ?>
</section>