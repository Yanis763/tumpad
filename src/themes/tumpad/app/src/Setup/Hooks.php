<?php

/**
 * Namespace should follow the path of your directory structure
 * for PSR-4 compliance.
 */

namespace App\Setup;

use Magina\StarterTheme\Assets\Hooks as AssetsHooks;

/**
 * Registers setup filters.
 */
final class Hooks
{
    /**
     * Call this method to get singleton.
     *
     * @return Hooks
     */
    public static function Instance()
    {
        static $inst = null;
        if (null === $inst) {
            $inst = new self();
        }

        return $inst;
    }

    private function __construct()
    {
        // theme assets
        add_action('wp_enqueue_scripts', [$this, 'enqueueAssets'], 100);
        add_filter(AssetsHooks::FILTER_ASSET_DEPENDENCIES, [$this, 'enqueueAssetsDependencies'], 10, 3);

        // theme config
        add_action('after_setup_theme', [$this, 'configureTheme'], 20);

        // register sidebars
        // add_action('widgets_init', [$this, 'registerSidebars']);

        // disable wp emoji
        add_action('init', [$this, 'disableEmoji']);

        // Hides admin bar on front
        // add_filter('show_admin_bar', '__return_false');

        // Remove Meta Generator (WP)
        remove_action('wp_head', 'wp_generator');

        //prevents text to break line before :!?;
        // add_filter("the_content", [$this, "preventHyphensBeforeDoubleChar"], 100, 1);

        /**
         * Send a HTTP header to limit rendering of pages to same origin iframes.
         * (Prevents clickjacking. Disable it if website needs to be loaded in iframe.)
         * @see https://developer.wordpress.org/reference/functions/send_frame_options_header/
         */
        add_action( 'send_headers', 'send_frame_options_header', 10, 0 );

    }

    /**
     * Theme assets.
     */
    public function enqueueAssets(): void
    {
        // register jquery from CDN for front
        if (!is_admin()) {
            wp_deregister_script('jquery');
            wp_register_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', false, '3.4.1', true);
        }

        // remove embed script from front
        if (!is_admin()) {
            wp_deregister_script('wp-embed');
        }

        // Dequeue Gutenberg Blocks :
        //wp_dequeue_style('wp-block-library');

        // load google font
        //wp_register_style( 'raleway-google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:300,400,700' );
    }

    /**
     * This is an example on how to add custom dependencies
     * to autoloaded compiled assets.
     */
    public function enqueueAssetsDependencies(array $deps, string $name, string $file): array
    {
        if ('styles/pages/app.compiled.css' === $file) {
            // $deps[] = 'dependency-style';
        } elseif ('scripts/pages/app.compiled.js' === $file) {
            // $deps[] = 'dependency-script';
        }

        return $deps;
    }

    /**
     * Theme setup.
     */
    public function configureTheme(): void
    {
        /*
        * Load text domains from languages directory
        */
        load_theme_textdomain('starter-theme', get_template_directory().'/languages');

        /*
        * Enable plugins to manage the document title
        * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
        */
        add_theme_support('title-tag');

        /*
        * Register navigation menus
        * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
        */
        register_nav_menus([
            'primary_navigation' => __('Primary Navigation', 'starter-theme'),
        ]);

        /*
        * Enable post thumbnails
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
        add_theme_support('post-thumbnails');

        /*
        * Enable HTML5 markup support
        * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
        */
        add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

        /*
         * Enable custom logo support
         * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-logo
         */
        add_theme_support('custom-logo', [
            // 'height'      => 100,
            // 'width'       => 400,
            'flex-height' => true,
            'flex-width' => true,
        ]);

        /*
        * Add image sizes needed for the theme
        */
        //add_image_size ( 'medium-large', 800, 400, true );

        /*
        * Use main stylesheet for visual editor
        * @see resources/assets/styles/layouts/_tinymce.scss
        */
        // add_editor_style(Helpers::assetPath('styles/main.css'));

        /*
         * Adds woocommerce suppport.
         *
         * Please also add "magina/starter-theme-woocommerce-module" to your composer.json
         * for templates loading to work properly.
         *
         * `composer require magina/starter-theme-woocommerce-module`
         *
         * Your woocommerce templates should be located in :
         * resources/views/woocommerce
         *
         * `magina/starter-theme-woocommerce-module` contains examples
         * archive-product.blade.php and single-product.blade.php that you can
         * copy in your woocommerce folder for a quick start.
         */
        // add_theme_support('woocommerce');
    }

    /**
     * Registers theme sidebars.
     */
    public function registerSidebars(): void
    {
        $config = [
            'before_widget' => '<section class="widget %1$s %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ];
        register_sidebar([
            'name' => __('Primary', 'starter-theme'),
            'id' => 'sidebar-primary',
        ] + $config);
        register_sidebar([
            'name' => __('Footer', 'starter-theme'),
            'id' => 'sidebar-footer',
        ] + $config);
    }

    /**
     * Disable wp emojicons on front.
     *
     * @return void
     */
    public function disableEmoji()
    {
        if (is_admin()) {
            return;
        }

        // all actions related to emojis
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');

        // filter to remove TinyMCE emojis
        add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
    }

    /**
     * Prevents line break to happen before any double character punctuation.
     *
     * @return string
     */
    public function preventHyphensBeforeDoubleChar($content)
    {
        $scripts = [];
        //first we remove all inline scripts to avoid bugs in javascript replacements
        $regexAllJavascriptTags = '#<script[^>]*>.*?</script[^>]*>#s';
        preg_match_all($regexAllJavascriptTags, $content, $scripts);
        $content = preg_replace($regexAllJavascriptTags, '', $content);
        $afterFooter = '';
        foreach ($scripts[0] ?? [] as $script) {
            //echo var_export($script,1);
            $afterFooter .= $script;
        }

        //the we replace all " [doubled characters] by &nbsp;[doubled characters]"
        //$content = str_replace([" :"," !"," ?"," ;"],["&nbsp;:","&nbsp;!","&nbsp;?","&nbsp;;"],$content);
        //better with a regex (# is the delemiter, if we forget it, the images or links should be broken)
        $regex = '# ([:;?!])#';
        $content = preg_replace($regex, '&nbsp;$0', $content);

        //we put scripts again before the body ends
        $content = str_replace('</body>', "$afterFooter</body>", $content);
        //the same as line below but faster

        return $content;
    }
}
