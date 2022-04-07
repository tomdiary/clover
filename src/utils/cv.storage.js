/**
 * 公共 sorage 封装
 * @author TomDiary
 */
const STORAGE_KEY = 'cv_storage'

export default {
  setItem(type = 1, lable = STORAGE_KEY, value = {}) {
    [type ? 'localStorage' : 'sessionStorage'].setItem(lable, JSON.stringify(value))
  },
  getItem() {},
  removeItem() {},
  clear() {}
}