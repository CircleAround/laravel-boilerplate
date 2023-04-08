const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
    devServer: {
        proxy: "http://laravel.test",
    },

    transpileDependencies: true,
});
