<?php defined('ABSPATH') || exit;

/**
 * 注册特色图像
 */
function clover_use_thumbnail() {
  add_theme_support( 'title-tag' );
  // 开启文章特色图像
  add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'clover_use_thumbnail' );

/**
 * 注册侧边栏
 */
function clover_sidebars() {
  register_sidebar( array(
    'name'          => __('首页侧边栏', 'clover'),
    'id'            => 'cv_index_sidebar',
    'description'   => '三叶草首页侧边栏',
    'before_widget' => '<aside id="%1$s" class="clover-widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));

  register_sidebar( array(
    'name'          => __('帖子详情侧边栏', 'clover'),
    'id'            => 'cv_posts_details_sidebar',
    'description'   => '三叶草帖子详情侧边栏',
    'before_widget' => '<aside id="%1$s" class="clover-widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));
}
add_action('widgets_init', 'clover_sidebars');


if (!function_exists('_clover')) {
  function _clover($option = '', $default = null) {
    $options_meta = CLOVER_OPTIONS;
    $options = get_option($options_meta);
    return (isset($options[$option])) ? $options[$option] : $default;
  }
}