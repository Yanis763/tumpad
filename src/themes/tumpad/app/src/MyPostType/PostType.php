<?php
/**
 * Namespace should follow the path of your directory structure
 * for PSR-4 compliance.
 */

namespace App\MyPostType;

/**
 * Custom post type `my-post-type` registration
 * ( Singleton ).
 */
final class PostType
{
    /**
     * Call this method to get singleton.
     *
     * @return PostType
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
        add_action('init', [$this, 'registerPostType'], 0);
    }

    public function registerPostType()
    {
        $labels = [
            'name' => _x('MyPostTypes', 'Post Type General Name', 'starter-theme'),
            'singular_name' => _x('MyPostType', 'Post Type Singular Name', 'starter-theme'),
            'menu_name' => __('MyPostTypes', 'starter-theme'),
            'name_admin_bar' => __('MyPostTypes', 'starter-theme'),
            'archives' => __('Archives des MyPostTypes', 'starter-theme'),
            'attributes' => __('Archives des MyPostTypes', 'starter-theme'),
            'parent_item_colon' => __('MyPostType parent', 'starter-theme'),
            'all_items' => __('Tous les MyPostType', 'starter-theme'),
            'add_new_item' => __('Ajouter nouveau MyPostType', 'starter-theme'),
            'add_new' => __('Ajouter nouveau', 'starter-theme'),
            'new_item' => __('Ajouter MyPostType', 'starter-theme'),
            'edit_item' => __('Éditer MyPostType', 'starter-theme'),
            'update_item' => __('Mettre à jour MyPostType', 'starter-theme'),
            'view_item' => __('Voir MyPostType', 'starter-theme'),
            'view_items' => __('Voir MyPostType', 'starter-theme'),
            'search_items' => __('Rechercher MyPostType', 'starter-theme'),
            'not_found' => __('Aucun MyPostType trouvé', 'starter-theme'),
            'not_found_in_trash' => __('Pas trouvé dans la corbeille', 'starter-theme'),
            'featured_image' => __('Vignette principale', 'starter-theme'),
            'set_featured_image' => __('Choisir la vignette', 'starter-theme'),
            'remove_featured_image' => __('Retirer la vignette', 'starter-theme'),
            'use_featured_image' => __('Utiliser comme vignette', 'starter-theme'),
            'insert_into_item' => __('Insérer dans le MyPostType', 'starter-theme'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'starter-theme'),
            'items_list' => __('Items list', 'starter-theme'),
            'items_list_navigation' => __('Items list navigation', 'starter-theme'),
            'filter_items_list' => __('Filter items list', 'starter-theme'),
        ];
        $args = [
            'label' => __('MyPostType', 'starter-theme'),
            'description' => __('Post Type Description', 'starter-theme'),
            'labels' => $labels,
            'supports' => ['title', 'editor', 'thumbnail'],
            'taxonomies' => [],
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-redo',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => false,
            'can_export' => true,
            'rewrite' => false,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'page',
        ];
        register_post_type('my-post-type', $args);
    }
}
