<?php defined('ABSPATH') || exit;
/**
 * 常量
 */
const CLOVER_DEBUG = true;
//const CLOVER_DEBUG = WP_DEBUG;
const CLOVER_OPTIONS = 'clover_options';
const CLOVER_DS = DIRECTORY_SEPARATOR; // 路径（/）
define('CLOVER_THEME_DIR', get_template_directory()); // 文件目录（/usr/src/xxx）
define('CLOVER_THEME_DIR_URI', get_template_directory_uri()); // 文件目录（域名/wp-content/theme/主题）
define('CLOVER_VERSION', wp_get_theme()->get('Version')); // 版本

// sht
wp_enqueue_script('wp-api');

add_filter('rest_pre_serve_request', function ($served, $result, $request, $server) {
  // 如果已经发送了响应，就不进行任何操作
  if ($served) {
    return $served;
  }

  // 获取原始响应数据
  $data = $result->get_data();

  if (is_wp_error($result)) {
    $message = $result->get_error_message(); // 使用 get_error_message() 获取错误消息
  } else {
    $message = '响应成功';
  }

  // 包装数据
  $response_data = array(
    'status' => $result->is_error() ? 1 : 0,
    'message' => $message,
    'data'   => $data,
    'test' => $result
  );

  // 发送 JSON 响应
  wp_send_json($response_data);

  // 返回 true，表示我们已经发送了响应
  return true;

}, 10, 4);
// sht

/**
 * 加载依赖文件库
 * @var array
 */
$clover_includes = array(
  '/core/main.php',
  '/inc/main.php'
);

/**
 * 挂载脚本文件
 */
function clover_theme_scripts() {
  $__f = CLOVER_THEME_DIR_URI . '/assets/';
  $__p = CLOVER_THEME_DIR_URI . '/assets/plugin/';
  $__m = CLOVER_THEME_DIR_URI . CLOVER_DS;
  $__v = CLOVER_VERSION;

  // 禁用jquery
  // wp_deregister_script('jquery');

//  wp_enqueue_style('overlayscrollbars', $__p . 'overlayscrollbars/overlayScrollbars.min.css', array(), '1.13.1', 'all');
//  wp_enqueue_style('overlayscrollbars-minimal-dark', $__p . 'overlayscrollbars/os-theme-minimal-dark.css', array('overlayscrollbars'), '1.13.1', 'all');
//  wp_enqueue_style('lightgallery', $__p . 'lightgallery/lightgallery-bundle.min.css', array(), '2.4.0', 'all');

  // wp_enqueue_script('alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.9.1/dist/cdn.min.js', array(), '3.9.1', false);
  // wp_enqueue_script('axios', 'https://cdn.jsdelivr.net/npm/axios@0.26.1/dist/axios.min.js', array(), '0.26.1', true);
//  wp_enqueue_script('lightgallery', $__p . 'lightgallery/lightgallery.umd.min.js', array(), '2.4.0', true);
//  wp_enqueue_script('overlayscrollbars', $__p . 'overlayscrollbars/overlayScrollbars.min.js', array(), '1.13.1', true);
  // wp_enqueue_script('captcha', 'https://ssl.captcha.qq.com/TCaptcha.js', array(), '', true); // 解析QQ头像

  if (CLOVER_DEBUG) {
//    $manifest = json_decode(file_get_contents('http://localhost:5689/manifest.json'), true);
//    $mainJs = $manifest['main.js'];
//    $vendorsJs = $manifest['vendors.js'];
//    $mainCss = $manifest['main.css'];

    wp_enqueue_style('clover', '//localhost:5689/main.bundle.css', array(), $__v, 'all');

    wp_enqueue_script('clover', '//localhost:5689/main.bundle.js', array('jquery'), $__v, true);
//    wp_enqueue_script('vendors', '//localhost:5689/' . $vendorsJs, array('clover'), $__v, true);
  } else {
    $manifest = json_decode(file_get_contents(CLOVER_THEME_DIR . '/dist/manifest.json'), true);
    $mainJs = $manifest['main.js'];
    $vendorsJs = $manifest['vendors.js'];
    $mainCss = $manifest['main.css'];

    wp_enqueue_style('clover', $__m . $mainCss, array(), $__v, 'all');

    wp_enqueue_script('clover',  $__m . $mainJs, array('jquery'), $__v, true);
    wp_enqueue_script('vendors',  $__m . $vendorsJs, array('clover'), $__v, true);
  }
}

add_action('wp_enqueue_scripts', 'clover_theme_scripts');

/**
 * 批量导入核心文件
 * @var [type]
 */
foreach ($clover_includes as $file) {
  require_once CLOVER_THEME_DIR . $file;
}
