const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

// build main.js and main.css
module.exports = {
  entry:path.resolve(__dirname, 'public/resources/js/main.js'),
  output: {
    path: path.resolve(__dirname, 'public/resources/dist'),
  },
  module: {
        rules: [{
            test: /\.scss$/,
            use: [
                MiniCssExtractPlugin.loader,
                "css-loader",
                "sass-loader"
            ]
        }]
    },
    plugins: [
        new MiniCssExtractPlugin({
            chunkFilename: "[id].css"
        })
    ]
};
