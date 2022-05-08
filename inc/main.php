<?php defined('ABSPATH') || exit;

$clover_includes = array(
  '/inc/init.php',
  '/inc/styles.php',
  '/inc/posts.php'
);

foreach ($clover_includes as $file) {
  require_once CLOVER_THEME_DIR . $file;
}