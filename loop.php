<?php
// If no post found, use this markup
if (!have_posts()) :
    ?>

    <div class="post">
        <h1 class="post-title"><?php _e("Oh snap. Houston, looks like we've lost.", 'thoughtplifier'); ?></h1>
        <div class="the-content">
            <h2><?php _e("The page you try to access is not exist. You can go back to <a href='" . get_bloginfo('url') . "'>the homepage</a> or search something else:", 'thoughtplifier'); ?></h2>
            <p>
            <form method="get" id="searchform" action="<?php echo get_option('home'); ?>">
                <input type="text" value="<?php _e("Type keywords and hit enter", 'thoughtplifier'); ?>" name="s" id="s-404" onfocus="if (this.value == '<?php _e("Type keywords and hit enter", 'thoughtplifier'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Type keywords and hit enter", 'thoughtplifier'); ?>';}" />
                <input type="hidden" id="searchsubmit" value="<?php _e("Search", 'thoughtplifier'); ?>" />
            </form>
            </p>
        </div>
    </div>

<?php endif;
while (have_posts()) : the_post(); ?>

    <?php if (is_single()) : // single post loop  ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="title">
                <?php the_title(); ?>
            </h1>
            <p class="author">
                <?php _e('Written by ', 'thoughtplifier');
                the_author_link(); ?>
            </p>
            <div class="content">
                <?php
                echo of_get_option('tp_before_content', '');
                the_content();
                echo of_get_option('tp_after_content', '');
                ?>
            </div><!-- .content -->

            <div id="author-box" class="clearfix">
                <?php tp_author_box(); ?>
            </div><!-- .author-box -->

            <?php tp_subscribe_box(); ?>

            <div class="meta clearfix">
                <div class="meta-item tags">
                    <h4 class="section-title"><?php _e('Tags', 'thoughtplifier'); ?></h4>
                    <?php the_tags('<ul><li>', '</li><li>', '</li></ul>'); ?>
                </div>
                <div class="meta-item categories">
                    <h4 class="section-title"><?php _e('Categories', 'thoughtplifier'); ?></h4>
                    <?php the_category(); ?>
                </div>
                <div class="meta-item info">
                    <h4 class="section-title"><?php _e('Post Info', 'thoughtplifier'); ?></h4>
                    <?php tp_post_date(); ?>                    
                </div>
            </div><!-- .meta -->

            <div id="related-posts" class="clearfix">
                <?php tp_related_posts(5); ?>
            </div><!-- #related-posts -->

            <div id="comment-wrap" class="clearfix">
                <?php comments_template('', true); ?>
            </div><!-- #comment-wrap -->

        </div><!-- #post -->

    <?php elseif (is_page()) : ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="title">
                <?php the_title(); ?>
            </h1>
            <p class="author">
                <?php _e('Written by ', 'thoughtplifier');
                the_author_link(); ?>
            </p>
            <div class="content">
                <?php the_content(); ?>
            </div><!-- .content -->

            <div id="comment-wrap" class="clearfix">
                <?php comments_template('', true); ?>
            </div><!-- #comment-wrap -->

        </div><!-- #post -->
    <?php else : // else's loop: search, archive, home, etc  ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2 class="title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <p class="author">
                <?php
                _e('Written by ', 'thoughtplifier');
                the_author_link();
                _e(' at ', 'thoughtplifier');
                tp_post_date();
                ?>
            </p>

            <div class="content clearfix">
                <?php if (of_get_option('tp_index_content', 'excerpt') == 'excerpt'): ?>
                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail("main-image");
                    }
                    ?>
                    <p><?php echo tp_excerpt(40); ?>...</p>
                    <p><a href="<?php the_permalink(); ?>" class="more-link"><?php _e('read more &rarr;', 'thoughtplifier'); ?></a></p>
                    <?php
                else :
                    the_content(__('read more', 'thoughtplifier'));
                endif;
                ?>                
            </div><!-- .content -->

        </div><!-- #post -->


    <?php endif; ?>

<?php endwhile; ?>