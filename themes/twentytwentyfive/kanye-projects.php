<?php
/**
 * Template Name: Kanye Projects
 */
get_header();
?>

<main class="wp-site-blocks">
    <div class="wp-block-group alignwide">
        <!-- Image at the top -->
        <img src="https://via.placeholder.com/800x300" alt="Top Image" class="top-image" />

        <h1>Projects</h1>

        <div class="wp-block-query">
            <?php
            $projects = new WP_Query([
                'post_type'      => 'projects',
                'posts_per_page' => 6,
                'paged'          => get_query_var('paged') ? get_query_var('paged') : 1
            ]);

            if ($projects->have_posts()) :
                while ($projects->have_posts()) :
                    $projects->the_post();
                    ?>
                    <div class="project-entry">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="wp-block-post-excerpt"><?php the_excerpt(); ?></div>
                    </div>
                    <?php
                endwhile;
                the_posts_pagination();
                wp_reset_postdata();
            else :
                echo '<p>No projects found.</p>';
            endif;
            ?>
        </div>

        <!-- Kanye Quotes Section -->
        <h2>Kanye's Wisdom</h2>
        <ul id="kanye-quotes"></ul>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let quotesList = document.getElementById("kanye-quotes");
                for (let i = 0; i < 5; i++) {
                    fetch('https://api.kanye.rest/')
                        .then(response => response.json())
                        .then(quoteData => {
                            let li = document.createElement("li");
                            li.textContent = quoteData.quote;
                            quotesList.appendChild(li);
                        });
                }
            });
        </script>

        <style>
            .top-image {
                display: block;
                max-width: 100%;
                height: auto;
                margin-bottom: 20px;
            }
            .project-entry {
                margin-bottom: 25px;
                border-bottom: 1px solid #ddd;
                padding-bottom: 15px;
            }
            #kanye-quotes {
                list-style: disc;
                padding-left: 20px;
            }
        </style>
    </div>
</main>

<?php get_footer(); ?>
