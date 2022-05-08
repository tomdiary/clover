<?php defined('ABSPATH') || exit;

CSF::createWidget('cv_widget_directory', array(
  'title'       => '三叶草-目录',
  'classname'   => 'cv-widget-directory',
  'description' => '三叶草目录，支持动态切换样式',
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => 'Title'
    ),
    array(
      'id'      => 'opt-text',
      'type'    => 'text',
      'title'   => 'Text',
      'default' => 'Default text value'
    ),
    array(
      'id'      => 'opt-switcher',
      'type'    => 'switcher',
      'title'   => 'Switcher'
    ),
    array(
      'id'      => 'opt-textarea',
      'type'    => 'textarea',
      'title'   => 'Textarea',
      'help'    => 'The help text of the field.'
    )
  )
));

if (!function_exists('cv_widget_directory')) {
  function cv_widget_directory( $args, $instance ) {

    echo $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }

    echo $instance['title'];
    echo $instance['opt-text'];
    echo $instance['opt-switcher'];
    echo $instance['opt-textarea'];
    echo $args['after_widget'];
  }
}
