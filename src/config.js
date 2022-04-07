/**
 * lightGallery 配置
 * @link https://github.com/sachinchoolur/lightGallery
 */
 lightGallery(document.getElementById('lightgallery'), {
  licenseKey: '0000-0000-000-0000'
})

/**
 * overlayscrollbars 配置
 * @link https://github.com/KingSora/OverlayScrollbars
 */
 document.addEventListener('DOMContentLoaded', () => {
  OverlayScrollbars(document.querySelectorAll('body'), {
    className: 'os-theme-minimal-dark'
  })
})