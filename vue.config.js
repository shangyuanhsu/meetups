module.exports = {
    publicPath: './',
    devServer: {
        proxy: {
            '/api': {
                // target: 'http://localhost:80/meetups/api', //API伺服器的地址
                target: 'http://localhost:8888/api', //API伺服器的地址
                changeOrigin: true, // 虛擬的站點需要更管origin
                pathRewrite: {
                    "^/api": ""
                }
            }
        },
    }
}
// autocomplete map

// https://maps.googleapis.com/maps/api/js?key=AIzaSyDzsvI1A7KVhOkKCGk9x-d67_w3nyzHDWs&amp;libraries=places&amp;language=zh-TW