<?php defined('ABSPATH') || exit;

/**
 * 常量
 */
define('CLOVER_DS', DIRECTORY_SEPARATOR); // 路径（/）
define('CLOVER_THEME_DIR', get_template_directory()); // 文件目录（/usr/src/xxx）
define('CLOVER_THEME_DIR_URI', get_template_directory_uri()); // 文件目录（域名/wp-content/theme/主题）
define('CLOVER_VERSION', wp_get_theme()->get('Version')); // 版本
define('CLOVER_OPTIONS', 'clover_options');

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

  wp_enqueue_style('overlayscrollbars', $__p . 'overlayscrollbars/overlayScrollbars.min.css', array(), '1.13.1', 'all');
  wp_enqueue_style('overlayscrollbars-minimal-dark', $__p . 'overlayscrollbars/os-theme-minimal-dark.css', array('overlayscrollbars'), '1.13.1', 'all');
  wp_enqueue_style('lightgallery', $__p . 'lightgallery/lightgallery-bundle.min.css', array(), '2.4.0', 'all');
  wp_enqueue_style('clover', $__m . 'dist/css/main.css', array(), $__v, 'all');

  // wp_enqueue_script('alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.9.1/dist/cdn.min.js', array(), '3.9.1', false);
  // wp_enqueue_script('axios', 'https://cdn.jsdelivr.net/npm/axios@0.26.1/dist/axios.min.js', array(), '0.26.1', true);
  wp_enqueue_script('lightgallery', $__p . 'lightgallery/lightgallery.umd.min.js', array(), '2.4.0', true);
  wp_enqueue_script('overlayscrollbars', $__p . 'overlayscrollbars/overlayScrollbars.min.js', array(), '1.13.1', true);
  // wp_enqueue_script('captcha', 'https://ssl.captcha.qq.com/TCaptcha.js', array(), '', true); // 解析QQ头像
  wp_enqueue_script('main',  $__m . 'dist/main.bundle.js', array('jquery', 'overlayscrollbars', 'lightgallery'), $__v, true);
}

add_action('wp_enqueue_scripts', 'clover_theme_scripts');

/**
 * 批量导入核心文件
 * @var [type]
 */
foreach ($clover_includes as $file) {
  require_once CLOVER_THEME_DIR . $file;
}