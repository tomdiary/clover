const path = require('path')
const { merge } = require('webpack-merge')
const commonConfig = require('./webpack.common')
const autoprefixer = require('autoprefixer')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const SpeedMeasurePlugin = require('speed-measure-webpack-plugin')
const configPackage = require('./config/package.json')

const resolve = (dir) => path.join(__dirname, dir)
const { CLOVER_DEV_STATIC_PORT } = configPackage

module.exports = function () {
  // 编译速度分析，替换方案：https://github.com/ShuiRuTian/time-analytics-webpack-plugin
  const smp = new SpeedMeasurePlugin()

  const webpackConfig = {
    mode: 'development',
    devtool: 'eval-source-map',
    output: {
      filename: '[name].bundle.js',
      chunkFilename: '[name].bundle.js',
      path: resolve('dist'),
      pathinfo: true,
      clean: true
    },
    devServer: {
      // static: resolve('dist'), // 静态文件需要
      // compress: true, // 启动 gzip compression
      port: CLOVER_DEV_STATIC_PORT, // 端口
      hot: true, // 热更新
      // https://webpack.docschina.org/configuration/dev-server/#devserverallowedhosts
      // 白名单，如果全部允许设置 all 即可，指定某些服务请设置具体的域名 [.apple.com, jd.com]
      allowedHosts: 'all',
      client: {
        // 日志级别
        logging: 'info',
        // 编译错误或警告，显示全屏覆盖
        overlay: {
          errors: true, // 只展示错误信息
          warnings: false, // 屏蔽警告信息
        },
        // 编译进度
        progress: true,
      }
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: '[name].bundle.css',
        ignoreOrder: true
      }),
    ],
    module: {
      rules: [
        // 处理 scss 样式
        {
          test: /\.s[ac]ss$/i,
          use: [
            // {
            //   loader: 'style-loader',
            // },
            {
              loader: MiniCssExtractPlugin.loader,
            },
            // 将 CSS 转化成 CommonJS 模块
            {
              loader: 'css-loader',
              options: {
                modules: false,
                importLoaders: 2,
                // 0 => no loaders (default);
                // 1 => postcss-loader;
                // 2 => postcss-loader, sass-loader
              }
            },
            {
              loader: 'postcss-loader',
              options: {
                postcssOptions: {
                  plugins: [
                    autoprefixer,
                    [
                      'postcss-preset-env'
                    ]
                  ]
                }
              }
            },
            // 将 Sass 编译成 CSS
            {
              loader: 'sass-loader'
            }
          ]
        }
      ]
    }
  }
  // 解决 smp 不兼容，https://github.com/stephencookdev/speed-measure-webpack-plugin/issues/167#issuecomment-1318684127
  const webpackConfigMerge = merge(commonConfig(), webpackConfig)
  const cssPluginIndex = webpackConfigMerge.plugins.findIndex(
    (e) => e.constructor.name === 'MiniCssExtractPlugin'
  )
  const cssPlugin = webpackConfigMerge.plugins[cssPluginIndex]
  const configToExport = smp.wrap(webpackConfigMerge)
  configToExport.plugins[cssPluginIndex] = cssPlugin

  return configToExport
}
