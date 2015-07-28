<?php
// Load the Parent Theme styles.
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
});


add_action('pre_get_posts', function (WP_Query $query) {

    if (!$query->is_admin) {
        // Order by Post Title.
        $query->set('orderby', array('post_title' => 'ASC'));

        //exclude the posts in child categories
        $queried_object = get_queried_object();
        $child_cats = (array)get_term_children($queried_object->term_id, 'category');
        $query->set('category__not_in', array_merge($child_cats));

    }
});

add_action('comments_open', function () {
    return false;
});


/**
 * Remove unused menu items
 */
function custom_menu_page_removing()
{
    global $menu;
    foreach (['edit-comments.php', 'upload.php', 'edit.php?post_type=page'] as $m)
        remove_menu_page($m);

}

add_action('admin_menu', 'custom_menu_page_removing');