<?php defined('ABSPATH') || exit;

$prefix = CLOVER_OPTIONS;

CSF::createOptions($prefix, array(
  'menu_title' => '三叶草主题',
  'menu_slug'  => 'clover-framework',
));

/**
 * 基本设置
 */
CSF::createSection($prefix, array(
  'title'  => '基本设置',
  'icon'   => 'fas fa-rocket',
  'fields' => array(
    array(
      'id'    => 'site_logo',
      'type'  => 'upload',
      'title' => '网站LOGO',
    ),
    array(
      'id'    => 'site_dark_logo',
      'type'  => 'upload',
      'title' => '网站LOGO（暗黑）',
    ),
    array(
      'id'    => 'site_favicon',
      'type'  => 'upload',
      'title' => 'favicon',
    ),
    array(
      'id'      => 'zeus_color',
      'type'    => 'color',
      'title'   => '主题色',
      'default' => '#161E54',
    ),
    array(
      'id'      => 'is_dark_btn',
      'type'    => 'switcher',
      'title'   => '是否显示切换夜间模式按钮',
      'label'   => '',
      'default' => true,
    ),
    array(
      'id'    => 'opt-checkbox',
      'type'  => 'checkbox',
      'title' => 'Checkbox',
      'label' => 'The label text of the checkbox.',
    ),
    array(
      'id'        => 'clover_post_thumbnail',
      'type'      => 'upload',
      'title'     => '帖子缩略图',
      'library'     => 'image',
    ),
    array(
      'id'      => 'opt-radio',
      'type'    => 'radio',
      'title'   => 'Radio',
      'options' => array(
        'yes'   => 'Yes, Please.',
        'no'    => 'No, Thank you.',
      ),
      'default' => 'yes',
    ),
    array(
      'id'          => 'opt-select',
      'type'        => 'select',
      'title'       => 'Select',
      'placeholder' => 'Select an option',
      'options'     => array(
        'opt-1'     => 'Option 1',
        'opt-2'     => 'Option 2',
        'opt-3'     => 'Option 3',
      ),
    ),
    array(
      'id'    => 'opt-background',
      'type'  => 'background',
      'title' => 'Background',
    ),
    array(
      'type'    => 'notice',
      'style'   => 'success',
      'content' => 'A <strong>notice</strong> field with <strong>success</strong> style.',
    ),
    array(
      'id'    => 'opt-icon',
      'type'  => 'icon',
      'title' => 'Icon',
    ),
    array(
      'id'    => 'opt-alt-text',
      'type'  => 'text',
      'title' => 'Text',
    ),
    array(
      'id'         => 'opt-alt-textarea',
      'type'       => 'textarea',
      'title'      => 'Textarea',
      'subtitle'   => 'A textarea with shortcoder.',
      'shortcoder' => 'csf_demo_shortcodes',
    ),
    array(
      'id'          => 'sidebar-tags',
      'type'        => 'select',
      'title'       => '侧边栏标签',
      'placeholder' => '请输入标签名',
      'chosen'      => true,
      'ajax'        => true,
      'multiple'    => true,
      'sortable'    => true,
      'min_length'  => 2,
      'options'     => 'tags',
    ),
  )
));

/**
 * SEO设置
 */
CSF::createSection($prefix, array(
  'title'  => 'SEO设置',
  'icon'   => 'fas fa-rocket',
  'fields' => array(
    array(
      'id'      => 'del_clover_seo',
      'type'    => 'switcher',
      'title'   => '禁用主题内置的SEO功能',
      'label'   => '有部分用户在用插件做SEO，可以在此关闭S主题自带SEO功能',
      'default' => false,
    ),
    array(
      'id'     => 'clover_index_seo',
      'type'   => 'fieldset',
      'title'  => '首页SEO信息',
      'fields' => array(
        array(
          'id'    => 'web_title',
          'type'  => 'text',
          'title' => '网站标题',
          'default' => '三叶草 - 轻盈、简洁 WordPress 主题'
        ),
        array(
          'id'    => 'is_keywords',
          'type'  => 'switcher',
          'title' => '网站关键字',
          'label' => '是否开启网站关键字',
          'default' => true,
        ),
        array(
          'id'         => 'web_keywords',
          'type'       => 'text',
          'title'      => '网站关键词',
          'desc'       => '3-5个关键词，用英文逗号隔开，一般不超过100个字符',
          'attributes' => array(
            'style' => 'width: 100%;',
          ),
          'default'    => '三叶草主题,clovertheme.com,clover',
          'dependency' => array('is_keywords', '==', 'true')
        ),
        array(
          'id'      => 'web_description',
          'type'    => 'textarea',
          'title'   => '网站描述',
          'default' => '三叶草主题，最优秀的WordPress主题',
          'desc' => '一般不超过200个字符',
        ),
      ),
      'dependency' => array('del_clover_seo', '==', 'false'),
    ),
    array(
      'id'      => 'connector',
      'type'    => 'text',
      'title'   => '全站链接符',
      'desc'    => '一经选择，切勿更改，对SEO不友好，一般为“-”或“_”',
      'default' => '-',
      'dependency' => array('del_clover_seo', '==', 'false'),
    ),
    array(
      'id'      => 'no_categoty',
      'type'    => 'switcher',
      'title'   => '分类去除category/前缀',
      'label'   => '',
      'default' => true,
    ),
    array(
      'id'      => 'is_archive_crumbs',
      'type'    => 'switcher',
      'title'   => '禁用文章内页面包屑导航',
      'label'   => '',
      'default' => false,
    )
  )
));

/**
 * 颜色设置
 * @link https://colorhunt.co/palette/06113cff8c32ddddddeeeeee
 */
CSF::createSection($prefix, array(
  'title'  => '颜色设置',
  'icon'   => 'fas fa-rocket',
  'fields' => array(
    array(
      'id'    => 'clover_color',
      'type'  => 'color',
      'title' => '主题色',
      'default' => '#FF8C32',
    ),
    array(
      'id'    => 'clover_text_color',
      'type'  => 'color',
      'title' => '文字颜色',
      'default' => '#333',
    ),
    array(
      'id'    => 'clover_link_color',
      'type'  => 'color',
      'title' => '链接颜色',
      'default' => '#FF8C32',
    ),
    array(
      'id'     => 'clover_h16_color',
      'type'   => 'fieldset',
      'title'  => 'H1~H6标签颜色',
      'fields' => array(
        array(
          'id'    => 'clover_h1_color',
          'type'  => 'color',
          'title' => 'H1颜色',
          'default' => '#333',
        ),
        array(
          'id'    => 'clover_h2_color',
          'type'  => 'color',
          'title' => 'H2颜色',
          'default' => '#333',
        ),
        array(
          'id'    => 'clover_h3_color',
          'type'  => 'color',
          'title' => 'H3颜色',
          'default' => '#333',
        ),
        array(
          'id'    => 'clover_h4_color',
          'type'  => 'color',
          'title' => 'H4颜色',
          'default' => '#333',
        ),
        array(
          'id'    => 'clover_h5_color',
          'type'  => 'color',
          'title' => 'H5颜色',
          'default' => '#333',
        ),
        array(
          'id'    => 'clover_h6_color',
          'type'  => 'color',
          'title' => 'H6颜色',
          'default' => '#333',
        ),
      )
    )
  )
));

/**
 * 外部链接
 */
CSF::createSection($prefix, array(
  'title'  => '外部链接',
  'icon'   => 'fas fa-rocket',
  'fields' => array(
    array(
      'type'    => 'notice',
      'style'   => 'success',
      'content' => '请在 <strong>rebots.txt</strong> 文件中，添加一条 <strong>Disallow: /?redirect=*</strong> 规则，这样就屏蔽了搜索引擎对中间页的抓取，对 SEO 会有很大的帮助。',
    ),
    array(
      'id'      => 'is_link_redirect',
      'type'    => 'switcher',
      'title'   => '内部链接',
      'label'   => '文章中外部链接转为内部链接并使用 redirect 进行跳转',
      'default' => true,
    ),
    array(
      'id'      => 'link_nofollow',
      'type'    => 'switcher',
      'title'   => 'Nofollow',
      'label'   => '外部链接加上 nofollow',
      'default' => true,
    ),
    array(
      'id'       => 'redirect_key',
      'type'     => 'text',
      'title'    => '重定向KEY',
      'subtitle' => '示例：www.w3.com/?redirect_to=xxxxxxx',
      'default'  => 'redirect_to'
    ),
    array(
      'id'          => 'exclude_link',
      'type'        => 'textarea',
      'title'       => '排除',
      'subtitle'    => '以下链接将不会转换为内部链接',
      'placeholder' => '请输入域名，例如：www.jd.com 或 jd.com，一行一个域名.',
    ),
  ),
));