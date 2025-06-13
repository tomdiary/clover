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

// 在页面上使用这个函数创建内部链接
function replace_external_links($content) {
  $pattern = '/<a(.*?)href=["\'](http[s]?:\/\/.*?)["\'](.*?)>/i';
  $replacement = function($matches) {
    $links_domains = array_map('trim', explode("\n", _clover('exclude_link')));
    $links = parse_url($matches[2], PHP_URL_HOST);
    if (in_array($links, $links_domains)) {
      $internal_link = $matches[2];
    } else {
      $internal_link = create_internal_link($matches[2]);
    }

    return '<a'.$matches[1].'href="'.$internal_link.'" target="_blank"'.$matches[3].'>';
  };
  $content = preg_replace_callback($pattern, $replacement, $content);
  return $content;
}
add_filter('the_content', 'replace_external_links');

// 此函数将在页面上创建一个内部链接
function create_internal_link($external_link) {
  $encoded_link = base64_encode($external_link);
  return esc_url(add_query_arg(_clover('redirect_key', 'redirect_to'), $encoded_link, get_site_url()));
}

// 此函数处理重定向请求
function handle_redirect() {
  if(isset($_GET[_clover('redirect_key', 'redirect_to')])) {
    $encoded_link = sanitize_text_field($_GET[_clover('redirect_key', 'redirect_to')]);
    $external_link = base64_decode($encoded_link);

    // 进一步验证$external_link是否为有效的URL
    if (filter_var($external_link, FILTER_VALIDATE_URL)) {
      wp_redirect($external_link);
      exit;
    }
  }
}
add_action('template_redirect', 'handle_redirect');
