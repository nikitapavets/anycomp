module.exports = [
	{
		test: /\.jsx?$/,
		exclude: /(node_modules|bower_components|public\/)/,
		loader: "babel"
	},
	{
		test: /\.eot(\?v=\d+\.\d+\.\d+)?$/,
		exclude: /(bower_components)/,
		loader: "file?name=[1]&regExp=static/(.*)"
	},
	{
		test: /\.(woff|woff2)(\?v=\d+\.\d+\.\d+)?$/,
		exclude: /(bower_components)/,
		loader: "url?name=[1]&regExp=static/(.*)&prefix=font/&limit=5000"
	},
	{
		test: /\.json(\?v=\d+\.\d+\.\d+)?$/,
		exclude: /(node_modules|bower_components)/,
		loader: "json-loader"
	},
	{
		test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/,
		exclude: /(bower_components)/,
		loader: "url?name=[1]&regExp=static/(.*)&limit=10000&mimetype=application/octet-stream"
	},
	{
		test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
		exclude: /(bower_components)/,
		loader: "url?name=[1]&regExp=static/(.*)limit=10000&mimetype=image/svg+xml"
	},
	{
		test: /\.gif/,
		exclude: /(bower_components)/,
		loader: "url-loader?name=[1]&regExp=static/(.*)&limit=10000&mimetype=images/gif"
	},
	{
		test: /\.jpg/,
		exclude: /(node_modules|bower_components)/,
		loader: "url-loader?name=[1]&regExp=static/(.*)&limit=10000&mimetype=images/jpg"
	},
	{
		test: /\.png/,
		exclude: /(node_modules|bower_components)/,
		loader: "url-loader?name=[1]&regExp=static/(.*)&limit=10000&mimetype=images/png"
	},
    {
        test: /\.css/,
        loader: "style-loader!css-loader?root=.&postcss-loader"
    },
];
