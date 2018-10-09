// webpack.config.js
const Encore = require('@symfony/webpack-encore');

Encore
  .configureRuntimeEnvironment('development')
  .cleanupOutputBeforeBuild()
  // read main.js     -> output as web/build/app.js
  .addEntry('app', './src/main.ts')
  .enableTypeScriptLoader()
  // read global.scss -> output as web/build/global.css
  //.addStyleEntry('appcss', './css/sampleapp.scss')

  // enable features!
  .enableSourceMaps(!Encore.isProduction())
  //.enableSassLoader()
  //.enableVersioning() // hashed filenames (e.g. main.abc123.js)
  .setOutputPath('../public/build/')
  .setPublicPath('/build/');

module.exports = Encore.getWebpackConfig();
