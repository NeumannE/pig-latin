const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const path = require('path');
const devMode = process.env.NODE_ENV !== 'production';

module.exports = {
    entry: './www/assets/js/app.js',
    mode: (devMode) ? 'development' : 'production',
    resolve: {
        extensions: ['.*', '.js', '.jsx']
    },
    plugins: [
        new WebpackManifestPlugin({basePath: '', publicPath: ''}),
        new MiniCssExtractPlugin({
            filename: "[name].[hash].min.css",
        }),
    ],
    output: {
        filename: '[name].[hash].js',
        path: path.join(__dirname, 'www', 'dist'),
    },
    devServer: {
        allowedHosts: [
            'all',
        ],
        hot: true,
        headers: {
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, PATCH, OPTIONS",
            "Access-Control-Allow-Headers": "X-Requested-With, content-type, Authorization"
        },
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: [],
            },
            {
                test: /\.(sa|sc|c)ss$/i,
                exclude: /node_modules/,
                use: [
                    MiniCssExtractPlugin.loader
                    , {
                        loader: 'css-loader',
                    },{
                        loader: 'postcss-loader',
                    }, {
                        loader: 'sass-loader',
                        options: {}
                    }
                ],
            },
            {
                test: /\.(png|jpe?g|gif|svg|eot|ttf|woff|woff2)$/i,
                // More information here https://webpack.js.org/guides/asset-modules/
                type: "asset/inline",
            }
        ],
    },
};