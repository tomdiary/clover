<?php namespace CoreMain\MainOptions\SeoOptions;

defined('ABSPATH') || exit;

/**
 * 是否开启主题SEO功能
 * @author TomDiary
 * @version 0.1.0 2022-04-18 更新
 */
function is_clover_seo($wp_customize, $section) {
  $wp_customize->add_setting('is_clover_seo_setting', array(
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));

  $wp_customize->add_control('is_clover_seo_control', array(
    'settings'  => 'is_clover_seo_setting',
    'label'     => '是否开启主题SEO',
    'section'   => $section,
    'type'      => 'checkbox',
  ));
}