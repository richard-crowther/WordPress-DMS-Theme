<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="docman" class="post">

    <?php
    if (class_exists('RCrowt\WPDocMan\PostMetaDocument')) $doc = new RCrowt\WPDocMan\PostMetaDocument($post);
    else $doc = null;

    the_title('<h1>', '</h1>');
    ?>

    <?php the_content(); ?>

    <?php if ($doc && $doc->isFile()): ?>
        <p><a href="<?= $doc->getFileUrl() ?>" class="download">Download <?= strtoupper($doc->getFileExtension()) ?> File (<?= $doc->getFileSize() ?>)</a></p>
    <?php endif; ?>

    <hr/>

    <?php
    // Author bio.
    if (is_single() && get_the_author_meta('description')) :
        get_template_part('author-bio');
    endif;


    // Show Category links and Edit Links
    twentyfifteen_entry_meta();
    edit_post_link(__('Edit', 'twentyfifteen'), '<span class="edit-link">', '</span>');


    ?>


</article>
