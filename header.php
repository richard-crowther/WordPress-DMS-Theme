<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

    <div id="sidebar" class="sidebar">
        <header id="masthead" class="site-header" role="banner">
            <div class="site-branding">
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                <?php
                $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview()) : ?>
                    <p class="site-description"><?php echo $description; ?></p>
                <?php endif;
                ?>
                <button class="secondary-toggle"><?php _e('Menu and widgets', 'twentyfifteen'); ?></button>
            </div>
            <!-- .site-branding -->
        </header>
        <!-- .site-header -->
        <div class="widget-area">
            <aside class="widget widget_categories">
                <h2 class="widget-title">Categories</h2>
                <ul>
                    <?php foreach (get_categories() as $category):
                        if ($category->parent > 0) continue; ?>
                        <li class="cat-tem">
                            <a href="<?= get_category_link($category) ?>"> <?= $category->name ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>


        <?php get_sidebar(); ?>

    </div>
    <!-- .sidebar -->

    <div id="content" class="site-content">
