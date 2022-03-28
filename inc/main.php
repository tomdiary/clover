<?php 
defined('ABSPATH') || exit;

$clover_includes = array(
  '/inc/styles/var.php'
);

foreach ($clover_includes as $file) {
  require_once CLOVER_THEME_DIR . $file;
}