<?php 
defined('ABSPATH') || exit;

$clover_includes = array(
  '/inc/init.php',
  '/inc/styles/var.php',
  '/inc/posts/index.php'
);

foreach ($clover_includes as $file) {
  require_once CLOVER_THEME_DIR . $file;
}