const mix = require("laravel-mix");
const glob = require("glob");
const path = require("path");
const url = require("url");
const collect = require("collect.js");

/* ====================================================================== */
/* =================== YOUR VARIABLES GOES HERE ========================= */

const URL = url.parse("https://starter.local"); // set your localhost url

/* ====================================================================== */
/* ====================================================================== */

const directory = path.basename(path.resolve());
const isHttps = URL.protocol === "https:";
const assetsPath = path.join(__dirname, "resources/assets");

/**
 * Tells webpack the url for browserSync
 */
mix.browserSync({
    proxy: URL.href,
    https: isHttps,
    files: [
        "app/**/*.php",
        "resources/views/**/*.php",
        "resources/assets/**/*.scss",
        "resources/assets/**/*.js",
    ],
});

/**
 * Tells webpack where is the output folder
 */
mix.setResourceRoot(`/wp-content/themes/${directory}/dist`);
mix.setPublicPath("./dist");

/**
 * Tells webpack jquery is loaded externally
 */
mix.webpackConfig({
    externals: {
        jquery: "jQuery",
    },
});

/**
 * Update manifest to remove leading slash of key => value pairs
 * @author Elan Ruusamäe <glen@pld-linux.org>
 * @see https://github.com/symfony/symfony/issues/36234
 */
mix.extend("updateManifestPathsRelative", (config) => {
    config.plugins.push(
        new (class {
            apply(compiler) {
                compiler.hooks.done.tap("Fix manifest paths", () => {
                    const manifest = {};
                    collect(Mix.manifest.get()).each((value, key) => {
                        key = this.normalizePath(key);
                        value = this.normalizePath(value);
                        manifest[key] = value;
                    });
                    Mix.manifest.manifest = manifest;
                    Mix.manifest.refresh();
                });
            }

            /**
             * @param {string} filePath
             */
            normalizePath(filePath) {
                if (filePath.startsWith("/")) {
                    filePath = filePath.substring(1);
                }

                return filePath;
            }
        })()
    );
});

// compile js files into separate js files
glob.sync("resources/assets/scripts/**/*.compiled.js").forEach((filename) => {
    const folder = path.dirname(filename).split("/").pop();

    mix.js(filename, "scripts/" + folder + "/");
});

// compile scss files into separate css files
glob.sync("resources/assets/styles/**/*.compiled.scss").forEach((filename) => {
    const folder = path.dirname(filename).split("/").pop();

    mix.sass(filename, "styles/" + folder + "/", {
        prependData: `@import 'resources/assets/styles/required';`,
    });
});

mix.copyDirectory("resources/assets/images", "dist/images")
    .updateManifestPathsRelative()
    .disableNotifications()
    .version();
