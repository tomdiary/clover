<?php
defined('ABSPATH') || exit;

/**
 * 常量
 */
define( 'CLOVER_DS', DIRECTORY_SEPARATOR ); // 路径（/）
define( 'CLOVER_THEME_DIR', get_template_directory() ); // 文件目录（/usr/src/xxx）
define( 'CLOVER_THEME_DIR_URI', get_template_directory_uri() ); // 文件目录（域名/wp-content/theme/主题）
define( 'CLOVER_VERSION', wp_get_theme()->get( 'Version' ) ); // 版本

/**
 * 加载依赖文件库
 * @var array
 */
$clover_includes = array(
  '/inc/main.php'
);

/**
 * 挂载脚本文件
 */
function clover_theme_scripts() {
  $__f = CLOVER_THEME_DIR_URI . '/assets/';
  $__v = CLOVER_VERSION;

  // 禁用jquery
  wp_deregister_script('jquery');

  wp_enqueue_style('lightgallery-css', 'https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lightgallery-bundle.min.css', array(), '2.4.0', 'all'); // lightgallery
  wp_enqueue_style('clover-normalize-style', $__f . 'css/normalize.css', array(), $__v);
  wp_enqueue_style('clover-base-style', $__f . 'css/base.css', array('clover-normalize-style'), $__v);
  wp_enqueue_style('clover-index-style', $__f . 'css/index.css', array('clover-normalize-style', 'clover-base-style'), $__v);

  wp_enqueue_script('tailwindcss', 'https://cdn.tailwindcss.com/3.0.23', array(), '3.0.23', true); // tailwindcss
  wp_enqueue_script('alpinejs', 'https://cdn.jsdelivr.net/npm/alpinejs@3.9.1/dist/cdn.min.js', array(), '3.9.1', true); // alpinejs
  wp_enqueue_script('axios', 'https://cdn.jsdelivr.net/npm/axios@0.26.1/dist/axios.min.js', array(), '0.26.1', true); // axios
  wp_enqueue_script('lightgallery-js', 'https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/lightgallery.umd.min.js', array(), '2.4.0', true); // lightgallery

  // wp_enqueue_style('fa5', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), '5.13.0', 'all');
  // wp_enqueue_style('fa5-v4-shims', 'https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css', array(), '5.13.0', 'all');

  wp_enqueue_script('captcha', 'https://ssl.captcha.qq.com/TCaptcha.js', array(), '', true); // 解析QQ头像
  wp_enqueue_script('main',  $__f . 'js/main.js', array('tailwindcss', 'axios', 'alpinejs', 'lightgallery-js'), $__v, true); // js 公共文件
} 

add_action('wp_enqueue_scripts', 'clover_theme_scripts');

/**
 * 批量导入核心文件
 * @var [type]
 */
foreach ($clover_includes as $file) {
  require_once CLOVER_THEME_DIR . $file;
}