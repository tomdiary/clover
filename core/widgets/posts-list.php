<?php defined('ABSPATH') || exit;

class Clover_Posts_List extends WP_Widget {
  public function __construct() {
    $widget_options = array(
      'classname' => 'clover-widget-posts-list',
      'description' => 'clover（三叶草主题）帖子列表',
      'customize_selective_refresh' => true
    );

    parent::__construct('zeus_widget_tags', '三叶草-帖子列表', $widget_options);
  }

  public function widget($args, $instance) {
    $title = isset($instance['title']) ? $instance['title'] : '帖子列表';
    $type = isset($instance['type']) ? $instance['type'] : 0;

    echo $args['before_widget'];
    echo $args['before_title'].$title.$args['after_title'];
    echo '<div class="clover-widget-posts-list">';
    clover_get_posts_list();
    echo '</div>';
    echo $args['after_widget'];
  }

  public function form($instance) {
    $title = isset($instance['title']) ? $instance['title'] : '帖子列表';
    $type = isset($instance['type']) ? $instance['type'] : 0;

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
    <p>
      <label for="<?php echo $this->get_field_id('type')?>">标题</label>
      <select 
        id="<?php echo $this->get_field_id('type')?>"
        name="<?php echo $this->get_field_name('type')?>">
        <option <?php echo $type == 0 ? 'selected' : ''; ?> value="0">默认</option>
        <option <?php echo $type == 1 ? 'selected' : ''; ?> value="1">按时间</option>
        <option <?php echo $type == 2 ? 'selected' : ''; ?> value="2">按阅读</option>
      </select>
    </p>
    <?php
  }
}

function clover_widget_post_list() {
  register_widget('Clover_Posts_List');
}

add_action('widgets_init', 'clover_widget_post_list');