const ExtractTextPlugin = require('extract-text-webpack-plugin');
const Path = require('path');

const isProduction = process.env.NODE_ENV === 'production';
const cssOutputPath = isProduction ? '/styles/administrator.min.css' : '/styles/administrator.min.css';
const jsOutputPath = isProduction ? '/scripts/administrator.min.js' : '/scripts/administrator.min.js';

const ExtractSASS = new ExtractTextPlugin(cssOutputPath);

let webpackConfig = {
    entry: [
        'babel-polyfill',
        './resources/assets/js/administrator',
        './resources/assets/sass/admin.sass'
    ],
    output: {
        path: Path.join(__dirname, './public'),
        filename: jsOutputPath
    },
    watch: true,
    module: {
        rules: [
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
            }
        ]
    }
};

// ------------------------------------------
// Module
// ------------------------------------------
isProduction
    ? webpackConfig.module.loaders.push({
        test: /\.(sass|scss)$/,
        loader: ExtractSASS.extract(['css', 'sass']),
    })
    : webpackConfig.module.loaders.push({
        test: /\.scss$/,
        loaders: ['style', 'css', 'sass'],
    });

// ------------------------------------------
// Plugins
// ------------------------------------------
isProduction
    ? webpackConfig.plugins.push(
        ExtractSASS
    )
    : false;

module.exports = webpackConfig;
