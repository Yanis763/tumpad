<?php

return [
    App\Setup\Hooks::class,
    App\MyPostType\Hooks::class,
    App\MyPostType\PostType::class,
    Magina\StarterTheme\Assets\Hooks::class,
    Magina\StarterTheme\Assets\Admin::class,
    Magina\StarterTheme\Settings\Hooks::class,
    Magina\StarterTheme\Settings\Fields::class,
    Magina\StarterTheme\Template\Hooks::class,
    Magina\StarterTheme\Template\Directives::class,
    Magina\StarterTheme\Initializer\Hooks::class,
    Magina\StarterTheme\Admin\Hooks::class,
    Magina\StarterTheme\Gutenberg\Blocks::class,
    Magina\StarterTheme\Gutenberg\Hooks::class,
];