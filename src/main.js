/**
 * 主文件
 * @author TomDiary
 * @link https://github.com/tomdiary
 */
import moment from 'moment'
import '@sts/main.scss'

moment.locale('zh-cn')

lightGallery(document.getElementById('lightgallery'), {
  licenseKey: '0000-0000-000-0000'
})
