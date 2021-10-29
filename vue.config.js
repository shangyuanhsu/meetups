module.exports = {
    publicPath: './',
    devServer: {
        proxy: {
            '/api': {
                target: 'http://localhost:80/api', //API伺服器的地址
                changeOrigin: true, // 虛擬的站點需要更管origin
                pathRewrite: {
                    "^/api": ""
                }
            }
        },
    }
}