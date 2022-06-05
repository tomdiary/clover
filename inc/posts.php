<?php defined('ABSPATH') || exit;

/**
 * 查询帖子
 */
function clover_get_posts_list($args = array('posts_per_page' => 10)) {
  $paged = get_query_var('paged', 1);
  $args = array(
    'posts_per_page' => 6,
    'paged' => $paged
  );
  $results = new WP_Query($args);
  if ($results->have_posts()):
    echo '<ul class="posts-list-wrapper">';
    while ($results->have_posts()) {
      $results->the_post();
      ?>
      <li class="post-item">
        <a class="post-item-link" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
      </li>
      <?php
    }
    echo '</ul>';
  endif;
  wp_reset_postdata();
}

/**
 * 标签云
 */
function clover_get_tags_cloud() {
  $tag_cloud = wp_tag_cloud(
    array(
      'echo'     => true,
      'number'   => 30,
      'taxonomy' => 'post_tag',
      'smallest' => 14,
      'largest'  => 14,
      'unit'     => 'px',
    )
  );
}

/**
 * 分页
 */
if (!function_exists('clover_posts_pagination')) {
  function clover_posts_pagination() {
    the_posts_pagination(array(
      'class' => 'posts-pagination',
      'aria_label' => 'posts',
      'screen_reader_text' => '',
      'mid_size'  => get_option('posts_per_page', 10),
      'prev_text' => __('上一页', 'clover'),
      'next_text' => __('下一页', 'clover'),
    ));
  }
}

/**
 * 获取特色图像
 */
function get_post_thumbnail_url($post_id){
	$post_id = $post_id === null ? get_the_ID() : $post_id;
	$thumbnail_id = get_post_thumbnail_id($post_id);
	if($thumbnail_id && $thumbnail_id !== 0){
		$thumb = wp_get_attachment_image_src($thumbnail_id, 'full');
		return $thumb[0];
	}else{
		return 'http://wtd.com/wp-content/uploads/2022/05/wallhaven-l3v3pq.jpg';
	}
}

/*
 * 截取正文
 * */
function clover_str_post_content($len = 100, $suffix = '...'){
  // 获取正文信息
  $content = get_the_content();
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  // 去除正文中的HTML标签
  $content = strip_tags($content);
  if( mb_strlen($content) <= $len) {
    return $content;
  } else {
    return $content = mb_substr($content, 0, $len) . $suffix;
  }
}