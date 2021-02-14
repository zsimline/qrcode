const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin')

module.exports = {
  mode: 'development',
  entry: './src/index.tsx',
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'bundle.js'
  },
  devtool: 'inline-source-map',
  module: {
    rules: [
      {
        test: /\.tsx$|\.ts$/,
        use: 'babel-loader',
        exclude: /node_modules/
      },
      {
        test: /\.css$/,
        use: [
          { loader: 'style-loader' },
          {
            loader: 'css-loader',
            options: {
              url: true,
              import: true,
              sourceMap: true
            }
          }
        ]
      },
      {
        test: /\.(png|jpg|gif)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'assets'
            }
          }
        ]
      }
    ]
  },
  plugins: [
    new HtmlWebpackPlugin({
      template: './src/index.html'
    })
  ],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, 'src'),
      "assets": path.resolve(__dirname, 'src/assets'),
      "utils": path.resolve(__dirname, 'src/utils'),
      "components": path.resolve(__dirname, 'src/components'),
      "services": path.resolve(__dirname, 'src/services'),
      "constants": path.resolve(__dirname, 'src/constants')
    },
    extensions: ['.tsx', '.ts', '.js']
  },
  devServer: {
    port: 8193,
    hot: true,
    open: true,
    clientLogLevel: 'warn',
    progress: true,
    contentBase: './dist',
    historyApiFallback: true
  }
}
