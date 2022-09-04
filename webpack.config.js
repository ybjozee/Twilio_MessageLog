const Encore = require("@symfony/webpack-encore");

if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || "dev");
}

Encore
  // directory where compiled assets will be stored
  .setOutputPath("public/build/")
  // public path used by the web server to access the output path
  .setPublicPath("/build")
  .addLoader({
    test: /\.svelte$/,
    loader: "svelte-loader",
  })
  /*
   * ENTRY CONFIG
   *
   * Each entry will result in one JavaScript file (e.g. app.js)
   * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
   */
  .addEntry("app", "./svelte/app.js")

  // When enabled, Webpack "splits" your files into smaller pieces
  // for greater optimization.
  .splitEntryChunks()
  .enableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())

  .configureBabel((config) => {
    config.plugins.push("@babel/plugin-proposal-class-properties");
  })

  // enables @babel/preset-env polyfills
  .configureBabelPresetEnv((config) => {
    config.useBuiltIns = "usage";
    config.corejs = 3;
  });

let config = Encore.getWebpackConfig();
config.resolve.mainFields = ["svelte", "browser", "module", "main"];
config.resolve.extensions = [".mjs", ".js", ".svelte"];

let svelte = config.module.rules.pop();
config.module.rules.unshift(svelte);

module.exports = config;
