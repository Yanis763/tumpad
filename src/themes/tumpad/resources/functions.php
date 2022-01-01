<?php

/**
 * Do not edit anything in this file unless you know what you're doing.
 */

use Magina\StarterTheme\Assets\Helpers as AssetsHelpers;
use Magina\StarterTheme\Settings\Helpers as SettingsHelpers;
use Magina\StarterTheme\Template\Helpers as TemplateHelpers;

/**
 * Helper function for prettying up errors.
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$starter_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Starter theme &rsaquo; Error', 'starter-theme');
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p>";
    wp_die($message, $title);
};

/*
 * Ensure compatible version of PHP is used
 */
if (version_compare('7', phpversion(), '>=')) {
    $starter_error(__('You must be using PHP 7 or greater.', 'starter-theme'), __('Invalid PHP version', 'starter-theme'));
}

/*
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $starter_error(__('You must be using WordPress 4.7.0 or greater.', 'starter-theme'), __('Invalid WordPress version', 'starter-theme'));
}

/*
 * Ensure dependencies are loaded
 */
if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
    $starter_error(
        __('You must run <code>composer install</code> from the Starter theme directory.', 'starter-theme'),
        __('Autoloader not found.', 'starter-theme')
    );
} else {
    require_once $composer;
}

/*
 * Loads and instanciate needed classes
 */
if (!file_exists(__DIR__.'/../app/index.php')) {
    $starter_error(
        sprintf(
            // translators: Completed with file path
            __('Error locating <code>%s</code> for inclusion.', 'starter-theme'),
            $file
        ),
        'File not found'
    );
} else {
    $classes = require __DIR__.'/../app/index.php';

    foreach ($classes as $class) {
        $class::Instance();
    }
}

/*
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/starter-theme/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);

/**
 * Aliases.
 */
function asset_path(string $path): string
{
    return AssetsHelpers::assetPath($path);
}

function settings_option(string $tab, string $key = '', $default = '')
{
    return SettingsHelpers::option($tab, $key, $default);
}

function render_blade(string $template, array $data = []): string
{
    return TemplateHelpers::render(
        TemplateHelpers::locateTemplate($template),
        $data
    );
}
