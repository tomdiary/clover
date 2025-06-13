const path = require('path')
const glob = require('glob')
const { BannerPlugin } = require('webpack')
const { merge } = require('webpack-merge')
const autoprefixer = require('autoprefixer')
const commonConfig = require('./webpack.common')
const TerserPlugin = require('terser-webpack-plugin')
const CompressionPlugin = require('compression-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const { WebpackManifestPlugin } = require('webpack-manifest-plugin')
const SpeedMeasurePlugin = require('speed-measure-webpack-plugin')
const { PurgeCSSPlugin } = require('purgecss-webpack-plugin')

const resolve = (dir) => path.join(__dirname, dir)

module.exports = function () {
  // 编译速度分析，替换方案：https://github.com/ShuiRuTian/time-analytics-webpack-plugin
  const smp = new SpeedMeasurePlugin()
  const webpackConfig = {
    mode: 'production',
    devtool: 'source-map', // 正式环境调试专用
    output: {
      filename: '[name].[contenthash].bundle.js',
      chunkFilename: '[name].[contenthash].bundle.js',
      path: resolve('dist'),
      pathinfo: false,
      clean: true
    },
    optimization: {
      minimize: true,
      minimizer: [
        new TerserPlugin({
          extractComments: false, // 将注释剥离到单独的文件，https://webpack.docschina.org/plugins/terser-webpack-plugin/#extractcomments
          parallel: 4, // 多进程并发
        })
      ],
      moduleIds: 'deterministic',
      splitChunks: {
        chunks: 'all',
        cacheGroups:{
          // 第三方依赖
          vendors:{
            test: /[\\/]node_modules[\\/]/,
            chunks: 'all',
            name: 'vendors',
            priority: 1, // // 设置优先级，首先抽离第三方模块
            enforce: true,
            minSize: 100,
            minChunks: 1 //最少引入了1次
          }
        }
      }
    },
    plugins: [
      // 提取样式表，CSS/JS可并行加载
      new MiniCssExtractPlugin({
        filename: 'css/[name].[contenthash].css',
        ignoreOrder: true
      }),
      // 压缩 CSS
      // new PurgeCSSPlugin({
      //   paths: glob.sync(
      //     `${resolve('src')}/**/*`,
      //     {
      //       nodir: true
      //     }
      //   ),
      //   extractors: [
      //     {
      //       extractor: content => {
      //         // Check if the file is main.scss, and if so, return an empty array
      //         if (
      //           content.includes('basic.scss') ||
      //           content.includes('common.scss') ||
      //           content.includes('main.scss') ||
      //           content.includes('normalize.scss') ||
      //           content.includes('posts.scss') ||
      //           content.includes('variables.scss') ||
      //           content.includes('widget.scss')
      //         ) {
      //           return [];
      //         }
      //
      //         // Otherwise, use the default extractor
      //         return content.match(/[\w-/:]+(?<!:)/g) || [];
      //       },
      //       extensions: ['html', 'js', 'jsx', 'ts', 'tsx', 'php', 'vue'],
      //     },
      //   ],
      // }),
      // 开启 gzip 压缩，后续需要服务器提供 gzip 支持
      new CompressionPlugin({
        test: /\.(js|css|html|ttf|woff|woff2)$/,
        threshold: 512,
        deleteOriginalAssets: false
      }),
      // 添加注释
      new BannerPlugin({
        banner: () => {
          return `name: Clover Theme\nversion: 0.1.0`
        }
      }),
      // 输出 manifest.json
      new WebpackManifestPlugin({
        publicPath: 'dist/'
      })
    ],
    module: {
      rules: [
        // 处理 scss 样式
        {
          test: /\.s[ac]ss$/i,
          use: [
            // {
            //   loader: 'style-loader'
            // },
            {
              loader: MiniCssExtractPlugin.loader,
            },
            // 将 CSS 转化成 CommonJS 模块
            {
              loader: 'css-loader',
              options: {
                // Enable CSS Modules features
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
            // 处理器 loader 编译慢的问题
            {
              loader: 'thread-loader',
              options: {
                workers: 4, // worker 的数量
                workerParallelJobs: 50 // 一个进程的工作数量
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
