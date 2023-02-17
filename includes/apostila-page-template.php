<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <!-- the loop -->
    <?php while (have_posts()) : the_post(); ?>

        <article>
            <div class="apostila_intro bg-primary">
                <div class="container">
                    <div class="row py-5">
                        <div class="offset-md-2 col-md-8 text-light">

                            <h1><?php the_title(); ?></h1>

                            <div>
                                <?php
                                $categories = get_the_terms($post->ID, 'category');

                                foreach ($categories as $category) {
                                    echo '<a class="text-light" href="' . esc_url(get_category_link($category->parent)) . '">' . esc_html(get_cat_name($category->parent)) . '</a>' . ' > <a class="text-light" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="apostila_content bg-light">
                <div class="container">
                    <div class="row py-5">
                        <div class="offset-md-2 col-md-8">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </article><!-- .post -->

    <?php endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->

    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>