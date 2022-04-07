/**
 * 主文件
 * @author TomDiary
 * @link https://github.com/tomdiary
 */
import 'bootstrap'
// import script from '@scr'
import moment from 'moment'
import storage from '@ut/cv.storage'
import '@sty/main.scss'
import './config'

moment.locale('zh-cn')

window.cv = {
  storage
}

// window.onload = async () => {
//   const postList = await axios.get('/wp-json/wp/v2/posts?page=1')
//   console.log(postList)
// }