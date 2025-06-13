/**
 * 主文件
 * @author TomDiary
 * @link https://github.com/tomdiary
 */
import 'bootstrap'
// import script from '@scr'
import storage from '@utl/cv.storage'
import * as _ from 'lodash-es'
// import 'bootstrap/scss/bootstrap.scss'
import '@stl/plugin.scss'
import '@stl/main.scss'
import './config'

window.cv = {
  storage
}

console.log(_.concat([0, 1], 3, [2, 9], [2]))

window.onload = async () => {
  const postList = await fetch({
    method: 'get',
    url: '/wp-json/wp/v2/posts?page=1'
  })
  console.log(postList)
}
