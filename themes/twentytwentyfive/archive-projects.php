<?php
get_header();

// Load the Block Editor Header
echo do_blocks('<!-- wp:template-part {"slug":"header","theme":"twentytwentyfive"} /-->'); 
?>

<main class="wp-site-blocks">
    <div class="wp-block-group alignwide">
        <h1 class="archive-title"><?php echo get_the_archive_title(); ?></h1>

        <div class="wp-block-query">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    echo do_blocks('
                        <!-- wp:group {"className":"project-entry"} -->
                        <div class="wp-block-group project-entry">
                            <h2 class="wp-block-heading"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
                            <div class="wp-block-post-excerpt">' . get_the_excerpt() . '</div>
                        </div>
                        <!-- /wp:group -->
                    ');
                endwhile;

                // Pagination
                the_posts_pagination();
            else :
                echo '<p>No projects found.</p>';
            endif;
            ?>
        </div>
        <style>
            body .is-layout-flex{
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }
            div#header, div#footer, hr {
                display: none;
            }
            .wp-site-blocks{
                max-width: 800px !important;
                width: 100% !important;
                margin: auto;
            }
            .wp-block-group {
                margin-bottom: 25px !important;
            }
        </style>
    </div>
</main>

<?php
// Load the Block Editor Footer
echo do_blocks('<!-- wp:template-part {"slug":"footer","theme":"twentytwentyfive"} /-->');

get_footer();
?>
