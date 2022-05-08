<?php namespace CoreMain;

defined('ABSPATH') || exit;

use CoreMain\MainOptions\{
  CloverBasicCustomizeRegister,
  CloverSeoCustomizeRegister,
  CloverColorCustomizeRegister
};

class CloverCore {

  public function __construct() {
    $this->load_library();
    $this->customize_api();
    if (class_exists('CSF')) $this->codestar_framework();
  }

  public function load_library() {
    require_once plugin_dir_path( __FILE__ ) . 'options/main-options.php';
    require_once plugin_dir_path( __FILE__ ) . 'codestar-framework/codestar-framework.php';
    require_once plugin_dir_path( __FILE__ ) . 'widgets/posts-list.php'; // 小工具 - 帖子列表
  }

  public function codestar_framework() {
    require_once plugin_dir_path( __FILE__ ) . 'admin/basic-admin.php';
  }

  public function customize_api() {
    new CloverBasicCustomizeRegister(); // 基本配置
    new CloverSeoCustomizeRegister();   // seo配置
    new CloverColorCustomizeRegister(); // 颜色配置
  }
}

new CloverCore();