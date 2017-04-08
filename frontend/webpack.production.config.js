"use strict";
const webpack = require('webpack');
const path = require('path');
const loaders = require('./webpack.loaders');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const WebpackCleanupPlugin = require('webpack-cleanup-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
    entry: {
        admin: [
            'react-hot-loader/patch',
            './src/admin/index.jsx'
        ],
        client: [
            'react-hot-loader/patch',
            './src/client/index.jsx'
        ],
        core: [
            'react-hot-loader/patch',
            './src/core/index.css'
        ]
    },
    output: {
        publicPath: '/',
        path: path.resolve('../backend/public_new'),
        filename: './js/[name].js',
        library: '[name]'
    },
    resolve: {
        extensions: ['', '.js', '.jsx']
    },
    module: {
        loaders
    },
    plugins: [
        new WebpackCleanupPlugin(),
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        }),
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false,
                screw_ie8: true,
                drop_console: true,
                drop_debugger: true
            }
        }),
        new webpack.optimize.OccurenceOrderPlugin(),
        new webpack.optimize.DedupePlugin(),
        new webpack.optimize.CommonsChunkPlugin({
            name: 'core',
            chunks: ['admin', 'client']
        }),
        new ExtractTextPlugin("./css/[name].css", {
            allChunks: true
        })
        // new CopyWebpackPlugin([
        //     { from: './static/.htaccess'},
        //     { from: './static/index.php'},
        //     { from: './static/robots.txt'},
        //     { from: './static/web.config'}
        // ])
    ]
};
