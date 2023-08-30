const path = require('path');
const webpack = require('webpack');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require('copy-webpack-plugin');

module.exports = {
    entry:     {
        'main':                        './src/main.js',
        'css/main':                    './src/scss/main.scss',
    },
    output:    {
        path:     path.join(__dirname, 'assets'),
        filename: '[name].js'
    },
    resolve:   {
        extensions: ['*', '.js'],
        modules:    [
            'node_modules'
        ]
    },
    module:    {
        rules: [
            {
                test: /\.(css|scss)$/,
                use:  [
                    {
                        loader:  MiniCssExtractPlugin.loader,
                        options: {
                            publicPath: '../'
                        }
                    },
                    {
                        loader: 'css-loader'
                    },
                    {
                        loader: 'resolve-url-loader'
                    },
                    'postcss-loader',
                    {
                        loader: 'sass-loader'
                    }
                ]
            },
            {
                test:    /\.js$/,
                exclude: /(node_modules)/,
                use:     ['babel-loader', 'eslint-loader']
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/,
                use:  [{
                    loader:  'file-loader',
                    options: {
                        name:       '[name].[ext]',
                        outputPath: 'static/'
                    }
                }]
            },
            {
                test: /\.(woff(2)?|ttf|eot|otf)(\?v=\d+\.\d+\.\d+)?$/,
                use:  [{
                    loader:  'file-loader',
                    options: {
                        name:       '[name].[ext]',
                        outputPath: 'fonts/'
                    }
                }]
            }
        ]
    },
    plugins:   [
        new CleanWebpackPlugin({
            cleanStaleWebpackAssets: false
        }),
        new MiniCssExtractPlugin({
            filename:      '[name].css',
            chunkFilename: '[id].css'
        }),
        new webpack.ProvidePlugin({
            $:      'jquery',
            jQuery: 'jquery'
        }),
        new CopyPlugin({
            patterns: [
                { from: 'src/static', to: 'static', toType: 'dir' },
                { from: 'src/fonts', to: 'fonts', toType: 'dir' }
            ]
        })
    ],
    externals: {
        jquery: 'jQuery'
    }
};
