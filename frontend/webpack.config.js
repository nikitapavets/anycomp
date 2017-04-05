"use strict";
const webpack = require('webpack');
const path = require('path');
const loaders = require('./webpack.loaders');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const DashboardPlugin = require('webpack-dashboard/plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

const HOST = process.env.HOST || "127.0.0.1";
const PORT = process.env.PORT || "3000";

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
    devtool: process.env.WEBPACK_DEVTOOL || 'eval-source-map',
    output: {
        publicPath: '/',
        path: path.join(__dirname, 'public'),
        filename: './[name]/index.js',
        library: '[name]'
    },
    resolve: {
        extensions: ['', '.js', '.jsx'],
        modulesDirectories: ['node_modules']
    },
    module: {
        loaders
    },
    devServer: {
        contentBase: "./public",
        noInfo: true,
        hot: true,
        inline: true,
        historyApiFallback: true,
        port: PORT,
        host: HOST
    },
    plugins: [
        new webpack.NoErrorsPlugin(),
        new webpack.HotModuleReplacementPlugin(),
        new DashboardPlugin(),
        new webpack.optimize.CommonsChunkPlugin({
            name: 'core',
            chunks: ['admin', 'client']
        }),
        new ExtractTextPlugin("[name]/index.css", {
            allChunks: true
        }),
        new HtmlWebpackPlugin({
            template: './src/admin/index.html',
            filename: './admin/index.html',
            hash: true,
            chunks: ['core', 'admin']
        }),
        new HtmlWebpackPlugin({
            template: './src/client/index.html',
            filename: './client/index.html',
            hash: true,
            chunks: ['core', 'client']
        }),
        // new webpack.ProvidePlugin({
        //     SlideMenu: "slide-and-swipe-menu"
        // })
    ]
};
