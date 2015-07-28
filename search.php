<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<section id="docman">

    <h1>Search</h1>
    <p><?php printf('Search Results for: %s', get_search_query()); ?></p>

    <?php if (have_posts()): ?>
        <ul class="docman-post-list">
            <?php
            while (have_posts()) :

                the_post();

                /** @var $post WP_Post */
                if (class_exists('RCrowt\WPDocMan\PostMetaDocument')) $doc = new RCrowt\WPDocMan\PostMetaDocument($post);
                else $doc = null;
                ?>

                <li <?= ($doc && $doc->isFile() ? 'style="background-image:url(' . $doc->getFileIconUrl() . ');"' : '') ?> class="post">
                    <b><a href="<?= esc_url(get_permalink()) ?>"> <?= $post->post_title ?></a></b>
                    <i><?php

                        // Page Links
                        echo '<a href="' . esc_url(get_permalink()) . '">Details</a>';

                        // Edit Link
                        edit_post_link('Edit', ', ');

                        // Download Link
                        if ($doc && $doc->isFile()) echo ', <a href="' . $doc->getFileUrl() . '">Download (' . $doc->getFileSize() . ', ' . $doc->getFileExtension() . ')</a>';

                        ?>
                    </i>
                </li>
            <?php endwhile; ?>
        </ul>

    <?php else: ?>
        <p>No results found!</p>
    <?php endif;

    // Previous/next page navigation.
    the_posts_pagination();

    ?>

</section>

<?php get_footer(); ?>
