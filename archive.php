<?php
get_header(); ?>

<section id="docman">

    <h1><a href="<?= home_url() ?>">Categories</a><?= ($cat ? ' // ' . trim(get_category_parents($cat, true, ' // '), '// ') : ''); ?></h1>
    <?php the_archive_description('<p>', '</p>'); ?>

    <?php $category_list = get_categories(['parent' => $cat, 'hierarchical' => 0]);
    if ($category_list): ?>
        <ul>
            <?php foreach (get_categories(['parent' => $cat, 'hierarchical' => 0]) as $category): ?>
                <li class="category">
                    <b><a href="<?= get_category_link($category) ?>"> <?= $category->name ?></a></b>
                    <i><a href="<?= get_category_link($category) ?>"><?= $category->description ?></a></i>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

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
    <?php endif;

    // Previous/next page navigation.
    the_posts_pagination();

    ?>

</section>

<?php get_footer(); ?>
