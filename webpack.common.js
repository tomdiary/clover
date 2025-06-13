const path = require('path')
const chalk = require('chalk')
const configPackage = require('./config/package.json')
const { ProgressPlugin, DefinePlugin } = require('webpack')
// const HtmlWebpackPlugin = require('html-webpack-plugin')
// const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin

const resolve = (dir) => path.join(__dirname, dir)

module.exports = function () {

  const { CLOVER_DEV_STATIC_PORT } = configPackage

  const webpackConfig = {
    target: 'web',
    entry: {
      main: resolve('src/main.js')
    },
    resolve: {
      // 别名
      alias: {
        '@$': resolve('src'),
        '@asst': resolve('src/assets'),
        '@stl': resolve('src/styles'),
        '@utl': resolve('src/utils'),
        '@scr': resolve('src/script')
      },
      // 指定解析的文件类型，解析顺序是从左到右。默认解析全部类型
      // extensions: ['js', 'ts', 'jsx', 'tsx', 'scss', 'sass', 'css'],
      symlinks: false,
    },
    plugins: [
      // 进度条
      // new ProgressBarPlugin({
      //   format: `:msg [:bar] ${chalk.green.bold(':percent')} (:elapsed s)`
      // }),
      new ProgressPlugin({
        activeModules: true
      }),
      // 打包体积分析
      new BundleAnalyzerPlugin({
        analyzerHost: 'localhost',
        analyzerPort: 5699,
        openAnalyzer: false
      }),
      // 加速打包
      // new HardSourceWebpackPlugin(),
      // 环境变量设置: DefinePlugin or EnvironmentPlugin
      new DefinePlugin({
        'process.env': {
          CLOVER_DEV_STATIC_PORT: JSON.stringify(CLOVER_DEV_STATIC_PORT)
        }
      })
    ],
    cache: {
      type: 'filesystem', // 使用文件缓存，与 hard-source-webpack-plugin 插件类似
    },
    module: {
      rules: [
        // 处理 SVG 图标
        {
          test: /\.svg$/,
          loader: 'svg-sprite-loader',
          // 只对相应目录下的资源做处理
          include: [resolve('src/icons')],
          options: {
            symbolId: 'icon-[name]'
          }
        },
        // 处理新语法: ES6/ES7/ES8等
        {
          test: /\.(js|jsx)$/,
          use: ['cache-loader', 'babel-loader'],
          include: resolve('src')
        }
      ]
    }
  }

  return webpackConfig
}
