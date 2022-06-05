<?php defined('ABSPATH') || exit;

/**
 * 基础变量
 */
function clover_base_var() {
  return "<style id='clover-base-var'>
    :root {
      --cv-bgc: #FFFFFF;
      --cv-col: #F96000;
      --cv-pad: 12px;
      --cv-sidebar-wid: 30%;
      --cv-text-col: #333;
      --cv-haeder-hei: 60px;
      --cv-primary: #F96000;
      --cv-transition: all 0.12s cubic-bezier(0.455, 0.03, 0.515, 0.955);
    }
  </style>";
}