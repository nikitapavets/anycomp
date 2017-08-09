module.exports = {
    entry: './resources/assets/js/administrator',
    output: {
        path: `${__dirname}/public/scripts`,
        filename: 'administrator.min.js'
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
                        plugins: ['transform-runtime']
                    }
                }
            }
        ]
    }
};
