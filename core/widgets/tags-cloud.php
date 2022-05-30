<?php defined('ABSPATH') || exit;

class Clover_Tags_Cloud extends WP_Widget {
  public function __construct() {
    $widget_options = array(
      'classname' => 'clover-widget-tags-cloud',
      'description' => 'clover（三叶草主题）标签云',
      'customize_selective_refresh' => true
    );

    parent::__construct('zeus_widget_tags_cloud', '三叶草-标签云', $widget_options);
  }

  public function widget($args, $instance) {
    $title = isset($instance['title']) ? $instance['title'] : '标签云';

    echo $args['before_widget'];
    echo $args['before_title'].$title.$args['after_title'];
    echo '<section class="tags-cloud-wrapper">';
    clover_get_tags_cloud();
    echo '</div>';
    echo $args['after_widget'];
  }

  public function form($instance) {
    $title = isset($instance['title']) ? $instance['title'] : '标签云';

    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title')?>">标题</label>
      <input
        type="text"
        class="widefat"
        id="<?php echo $this->get_field_id('title')?>"
        name="<?php echo $this->get_field_name('title')?>"
        value="<?php echo $title; ?>"
        placeholder="请输入标题">
    </p>
    <?php
  }
}

function clover_widget_tags_cloud() {
  register_widget('Clover_Tags_Cloud');
}

add_action('widgets_init', 'clover_widget_tags_cloud');