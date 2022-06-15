const mix = require('laravel-mix');
const lodash = require("lodash");
// const WebpackRTLPlugin = require('webpack-rtl-plugin');
const folder = {
    src: "resources/", // source files
    domain_src: "app/domains/", // domain source path
    dist: "public/", // build files
    dist_assets: "public/assets/", //build assets files
};

/**
 * ------------------------------------------------------------------------------
 * ------------------------------------------------------------------------------
 * Copy necessary asset files from third-party npm packages to proper destination
 * ------------------------------------------------------------------------------
 * ------------------------------------------------------------------------------
 */
var third_party_assets = {
    css_js: [
        { "name": "jquery", "assets": ["./node_modules/jquery/dist/jquery.min.js"] },
        { "name": "popperjs", "assets": ["./node_modules/@popperjs/core/dist/cjs/popper.js"] },
        { "name": "toastr", "assets": ["./node_modules/toastr/build/toastr.min.js", "./node_modules/toastr/build/toastr.min.css"] },
        { "name": "sweetalert2", "assets": ["./node_modules/sweetalert2/dist/sweetalert2.min.js", "./node_modules/sweetalert2/dist/sweetalert2.min.css"] },
        { "name": "jquery-validation", "assets": ["./node_modules/jquery-validation/dist/jquery.validate.min.js"] },
    ]
};

//copying third party assets
lodash(third_party_assets).forEach(function (assets, type)
{
    if (type == "css_js") {
        lodash(assets).forEach(function (plugin)
        {
            var name = plugin['name'],
                assetlist = plugin['assets'],
                css = [],
                js = [];
            lodash(assetlist).forEach(function (asset)
            {
                var ass = asset.split(',');
                for (let i = 0; i < ass.length; ++i) {
                    if (ass[i].substring(ass[i].length - 3) == ".js") {
                        js.push(ass[i]);
                    } else {
                        css.push(ass[i]);
                    }
                };
            });
            if (js.length > 0) {
                mix.combine(js, folder.dist_assets + "/libs/" + name + "/" + name + ".min.js");
            }
            if (css.length > 0) {
                mix.combine(css, folder.dist_assets + "/libs/" + name + "/" + name + ".min.css");
            }
        });
    }
});

/**
 * ------------------------------------------------------------------------------
 * ------------------------------------------------------------------------------
 * Copy necessary asset directories from third-party npm packages to proper destination
 * ------------------------------------------------------------------------------
 * ------------------------------------------------------------------------------
 */
mix.copyDirectory("./node_modules/bootstrap/dist/", folder.dist_assets + "/libs/bootstrap");

/**
 * ------------------------------------------------------------------------------
 * ------------------------------------------------------------------------------
 * Copy necessary asset files from local resource to proper destination
 * ------------------------------------------------------------------------------
 * ------------------------------------------------------------------------------
 */
// copy all fonts
var out = folder.dist_assets + "fonts";
mix.copyDirectory(folder.src + "fonts", out);

// copy all css
var out = folder.dist_assets + "css";
mix.copyDirectory(folder.src + "css", out);

// copy all images
var out = folder.dist_assets + "images";
mix.copyDirectory(folder.src + "images", out);

/**
 * ------------------------------------------------------------------------------
 * ------------------------------------------------------------------------------
 * Compile and generate required CSS & JS files from local resource to proper destination
 * ------------------------------------------------------------------------------
 * ------------------------------------------------------------------------------
 */
mix.sass('resources/scss/app.scss', folder.dist_assets + "css").options({ processCssUrls: false }).minify(folder.dist_assets + "css/app.css");

mix.combine('resources/js/app.js', folder.dist_assets + "js/app.js");
mix.minify([folder.dist_assets + "js/app.js"]);


/**
 * --------------------------------------------------------------
 * --------------------------------------------------------------
 * Copy necessary JS Script files to their respective directories
 * --------------------------------------------------------------
 * --------------------------------------------------------------
 */
var app_pages_assets = {
    pages: [
    ],
    plugins: [
        "js/plugin/demo.js",
    ]
};

var out = folder.dist_assets + "js/";
lodash(app_pages_assets).forEach(function (assets, type)
{
    for (let i = 0; i < assets.length; ++i) {
        // console.log(type)
        mix.js(folder.src + assets[i], folder.dist_assets + 'js/' + type);
    };
});

/**
 * ----------------------------------------------------------------------------------------
 * ----------------------------------------------------------------------------------------
 * Compile and generate required CSS & JS files from domain resources to proper destination
 * ----------------------------------------------------------------------------------------
 * ----------------------------------------------------------------------------------------
 */
let fs = require('fs');
const { trim } = require('lodash');

function discover(dir, type)
{
    let targetFiles = []
    fs.readdirSync(dir).forEach(file =>
    {
        let fileName = `${dir}/${file}`
        if (fs.statSync(fileName).isFile()) {
            if (fileName.endsWith(type)) {
                targetFiles.push(fileName)
            }
        } else {
            targetFiles = targetFiles.concat(discover(fileName, type))
        }
    })
    return targetFiles
}

function getDomainBetween(str, start, end)
{
    const result = str.match(new RegExp(start + "(.*)" + end));

    return result[1];
}

var getFileName = function (str)
{
    return str.split('\\').pop().split('/').pop().split('.').slice(0, -1).join('.');
}


const domainCss = discover(folder.domain_src, '.css');
domainCss.forEach(file =>
{
    if (file.includes('resources/css/')) {
        let domain = trim(getDomainBetween(file, folder.domain_src, 'resources/css/'), '/');
        if (domain && !domain.includes('/')) {
            domain = domain.replace(/[A-Z][a-z]*/g, str => '-' + str.toLowerCase() + '-')
                .replace('--', '-')
                .replace(/(^-)|(-$)/g, '');

            if (!file.includes('.min.css')) {
                let minCssFile = folder.dist_assets + 'css/module/' + domain + '/' + getFileName(file) + '.min.css';
                mix.postCss(file, minCssFile, []);

            } else {
                mix.copy(file, folder.dist_assets + 'css/module/' + domain);
            }

        }
    }
})

const domainJS = discover(folder.domain_src, '.js');
domainJS.forEach(file =>
{
    if (file.includes('resources/js/')) {
        let domain = trim(getDomainBetween(file, folder.domain_src, 'resources/js/'), '/');
        if (domain && !domain.includes('/')) {
            domain = domain.replace(/[A-Z][a-z]*/g, str => '-' + str.toLowerCase() + '-')
                .replace('--', '-')
                .replace(/(^-)|(-$)/g, '');

            mix.js(file, folder.dist_assets + 'js/module/' + domain);
            if (!file.includes('.min.js')) {
                mix.minify(folder.dist_assets + 'js/module/' + domain + '/' + getFileName(file) + '.js');
            }

        }
    }
})