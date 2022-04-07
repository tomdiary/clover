<?php 
defined('ABSPATH') || exit;

$clover_includes = array(
  '/core/codestar-framework/codestar-framework.php',
  '/core/widgets/directory.php'
);

foreach ($clover_includes as $file) {
  require_once CLOVER_THEME_DIR . $file;
}