<?php
/**
 * Namespace should follow the path of your directory structure
 * for PSR-4 compliance.
 */

namespace App\MyPostType;

/**
 * Registers Metaboxes for MyPostType.
 */
final class Metabox
{
    /**
     * Call this method to get singleton.
     *
     * @return Metabox
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
        add_action('cmb2_init', [$this, 'addMetaboxes']);
    }

    public function addMetaboxes()
    {
        $prefix = '_my_post_type_';

        $box_args = [
            'id' => '_my_post_type__metabox',
            'title' => 'Paramètres',
            'object_types' => ['my-post-type'],
            'context' => 'normal',
            'priority' => 'high',
            'show_names' => true, // Show field names on the left
        ];

        $cmb = new_cmb2_box($box_args);

        $cmb->add_field([
            'name' => 'Example 1',
            'id' => $prefix.'example_1',
            'type' => 'text_medium',
        ]);

        $cmb->add_field([
            'name' => 'Example 2',
            'id' => $prefix.'example_2',
            'type' => 'text_url',
        ]);
    }
}
