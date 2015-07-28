<?php
get_header(); ?>

<section id="docman">
    <h1><a href="<?= home_url() ?>">Categories</a></h1>
    <ul>
        <?php foreach (get_categories() as $category):
            if ($category->parent > 0) continue; ?>
            <li class="category">
                <b><a href="<?= get_category_link($category) ?>"> <?= $category->name ?></a></b>
                <i><a href="<?= get_category_link($category) ?>"><?= $category->description ?></a></i>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php get_footer(); ?>
