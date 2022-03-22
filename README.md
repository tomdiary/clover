# Clover

## 目录结构

```python
├─ core/                # 关键模块（小工具、侧边栏）
├─ inc/                 # 核心功能函数
├─ parts/               # 模板部件
├─ templates/           # 模板
├─ assets/              # 存放静态资源（如图片、视频等）的目录
│  ├─ css/              # 样式
│  │  ├─ bass.css       # 公共样式
│  │  ├─ index.css      # 首页
│  │  ├─ normalize.css  # 初始化默认样式
├─ 404.php              # 404页面
├─ footer.php           # 公共底部
├─ functions.php        # 主题核心
├─ header.php           # 公共头部
├─ index.php            # 公共主页
├─ sidebar.php          # 公共侧边栏
```

## 编译 sass

```bash
$ sass --watch assets/css/:assets/css/
```