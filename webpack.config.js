const path = require('path')
// const HtmlWebpackPlugin = require('html-webpack-plugin')
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
// const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const extractTextPlugin = require('extract-text-webpack-plugin')
const resolve = (dir) => path.join(__dirname, dir)

// source map
const devtool = process.env.NODE_ENV !== 'production' ? 'eval-cheap-module-source-map' : 'nosources-source-map'

module.exports = {
  mode: process.env.NODE_ENV,
  entry: {
    main: './src/main.js'
  },
  output: {
    filename: '[name].bundle.js',
    path: resolve('dist')
  },
  devtool,
  devServer: {
    static: resolve('dist'),
    compress: true
  },
  resolve: {
    alias: {
      '@$': resolve('./src'),
      '@ast': resolve('./src/assets'),
      '@sts': resolve('./src/styles'),
      '@util': resolve('./src/utils')
    }
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
      chunkFilename: 'css/[id].css',
      ignoreOrder: false
    })
  ],
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        use: {
          loader: 'babel-loader',
        },
        exclude: /node_modules/
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          // process.env.NODE_ENV !== 'production' ? 'style-loader' : MiniCssExtractPlugin.loader,
          MiniCssExtractPlugin.loader,
          {
            loader: "css-loader"
          }, 
          {
            loader: 'sass-loader'
          },
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  [
                    'postcss-preset-env'
                  ]
                ]
              }
            }
          }
        ]
      }
    ]
  }
}