const Webpack = require('webpack');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const path = require('path');

const isProduction = process.env.NODE_ENV === 'production';
const cssOutputPath = isProduction ? 'styles/administrator.min.css' : 'styles/administrator.min.css';
const jsOutputPath = isProduction ? 'scripts/administrator.min.js' : 'scripts/administrator.min.js';

const ExtractSASS = new ExtractTextPlugin(cssOutputPath);

let webpackConfig = {
    entry: [
        'babel-polyfill',
        './resources/assets/js/administrator',
        // './resources/assets/sass/admin.sass'
    ],
    output: {
        path: path.resolve(__dirname, 'public'),
        filename: jsOutputPath
    },
    resolve: {
        extensions: ['.sass', '.css', '.js']
    },
    watch: true,
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['env'],
                        plugins: [
                            'transform-runtime',
                            'transform-object-rest-spread'
                        ]
                    }
                }
            },
            {
                test: /\.(sass|scss)$/,
                include: [
                    path.resolve(__dirname, 'node_modules'),
                    path.resolve(__dirname, 'resources/assets/sass'),
                    path.resolve(__dirname, 'resources/assets/img')
                ],
                use: ExtractSASS.extract({
                    use: [
                        {
                            loader: "css-loader",
                            options: {
                                sourceMap: true
                            }
                        },
                        {
                            loader: "sass-loader",
                            options: {
                                sourceMap: true
                            }
                        }
                    ],
                    fallback: "style-loader"
                })
            },
            {
                test: /\.css$/,
                use: [
                    'style-loader',
                    'css-loader'
                ]
            },
            {
                test: /\.(png|jpg|gif|svg)$/,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 8192
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        new Webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: JSON.stringify(isProduction ? 'production' : 'development'),
            },
        }),
        new ExtractTextPlugin(path.resolve(__dirname, `public/${cssOutputPath}`), {
            allChunks: true
        }),
        ExtractSASS
    ],
};

module.exports = webpackConfig;