<?php namespace CoreMain\MainOptions;

defined('ABSPATH') || exit;

use function CoreMain\MainOptions\BaseOptions;
use function CoreMain\MainOptions\SeoOptions\{
  is_clover_seo
};
use function CoreMain\MainOptions\BasicOptions;

/**
 * clover 基本配置
 * @author TomDiary
 * @version 0.1.0 2022-04-18 更新
 */
class CloverBasicCustomizeRegister {

  public function __construct() {
    $this->load_library();
    add_action('customize_register', array($this, 'clover_customize_register'));
  }

  public function load_library() {
    require_once plugin_dir_path( __FILE__ ) . 'base-options.php';
    require_once plugin_dir_path( __FILE__ ) . 'seo-options.php';
  }

  public function clover_customize_register($wp_customize) {
    $wp_customize->add_panel('clover_basic_customize', array(
      'title'       => __('基本配置(三叶草)', 'clover'),
      'description' => __('三叶草主题基本配置', 'clover'),
      'capability'  => 'edit_theme_options',
      'priority'    => 100,
    ));

    $this->clover_basic_section($wp_customize);
  }

  public function clover_basic_section($wp_customize) {
    $wp_customize->add_section('clover_website_layout', array(
      'panel'       => 'clover_basic_customize',
      'title'       => __('布局设置', 'clover'),
      'description' => '布局设置',
      'priority'    => 120,
    ));

    $this->clover_basic_setting($wp_customize);
    $this->clover_basic_control($wp_customize);
  }

  public function clover_basic_setting($wp_customize) {
    $wp_customize->add_setting('clover_basic_layout_header_setting', array(
      'default'        => 'layout1',
      'capability'     => 'edit_theme_options',
      'type'           => 'option',
    ));
  }

  public function clover_basic_control($wp_customize) {
    $wp_customize->add_control('clover_layout_header_control', array(
      'settings'  => 'clover_basic_layout_header_setting',
      'label'     => '顶部布局',
      'section'   => 'clover_website_layout',
      'type'      => 'select',
      'choices'   => array(
        'layout1' => '盒子',
        'layout2' => '全宽',
      ),
    ));
  }
}

/**
 * clover SEO配置
 * @author TomDiary
 * @version 0.1.0 2022-04-14 更新
 */
class CloverSeoCustomizeRegister {

  public function __construct() {
    add_action('customize_register', array($this, 'customize_register'));
  }

  public function customize_register($wp_customize) {
    $wp_customize->add_panel('clover_seo_customize', array(
      'title'       => __('SEO配置(三叶草)', 'clover'),
      'description' => __('三叶草SEO配置', 'clover'),
      'capability'  => 'edit_theme_options',
      'priority'    => 121,
    ));

    $this->clover_seo_section($wp_customize);
  }

  public function clover_seo_section($wp_customize) {
    $wp_customize->add_section('global_seo_section', array(
      'panel'       => 'clover_seo_customize',
      'title'       => __('全局设置', 'clover'),
      'description' => '全局设置',
      'priority'    => 120,
    ));

    is_clover_seo($wp_customize, 'global_seo_section'); // 是否开启SEO
  }
}

/**
 * clover 颜色配置
 * @author TomDiary
 * @version 0.1.0 2022-04-18 更新
 */
class CloverColorCustomizeRegister {
  public function __construct() {
    add_action('customize_register', array($this, 'customize_register'));
  }

  public function customize_register($wp_customize) {
    $wp_customize->add_panel('clover_color_customize', array(
      'title'       => __('颜色配置', 'clover'),
      'description' => __('三叶草颜色配置', 'clover'),
      'capability'  => 'edit_theme_options',
      'priority'    => 121,
    ));
  }
}