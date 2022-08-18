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
 * Copy necessary asset files from local resource to proper destination
 * ------------------------------------------------------------------------------
 * ------------------------------------------------------------------------------
 */

// copy all fonts
var out = folder.dist_assets + "fonts";
mix.copyDirectory(folder.src + "fonts", out);

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

mix.combine('resources/js/app.js', folder.dist_assets + "js/app.js").minify([folder.dist_assets + "js/app.js"]);


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
