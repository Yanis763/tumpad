<?php
/**
 * Namespace should follow the path of your directory structure
 * for PSR-4 compliance.
 */

namespace App\MyPostType;

/**
 * Registers MyPostType related filters.
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
        // adds body class on single page
        add_filter('body_class', [$this, 'addClassOnSingular']);
    }

    /**
     * Adds class "hell-yeah" to body on "my-post-type"
     * singular page.
     *
     * @param [type] $query [description]
     */
    public function addClassOnSingular($classes)
    {
        if (
            !is_admin()
            && is_singular('my-post-type')
        ) {
            $classes[] = 'hell-yeah';
        }

        return $classes;
    }
}
