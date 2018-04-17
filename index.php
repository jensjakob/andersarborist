<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed" rel="stylesheet">
    <?php wp_head() ?>
</head>
<body>
    <div id="navbar">
        <div id="logo"><a href="/"><img class="fill" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/andersarborist-logo.jpg" alt="Anders Arborist" /></a></div>
        <div id="show-menu"><a href="#" onClick="document.getElementById('nav-items').style.display = 'block'; return false;">&equiv;</a></div>
        <div id="nav-items">
            <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
        </div>
    </div>
    <div id="header">
        <div id="featured-image">
            <?php the_post_thumbnail('header-phone', ['class' => 'phone fill']); ?>
            <?php the_post_thumbnail('header-desktop', ['class' => 'desktop']); ?>
        </div>
        <div class="caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></div>
    </div>
    <div id="column">
        <div id="content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            <?php endwhile; else : ?>
                <p><?php esc_html_e( 'Sorry, no page content.' ); ?></p>
            <?php endif; ?>

            <?php
                if (get_the_ID() == 16) {
                    // Doesn't work, I will use ID 16 instead;
                    // $gallery_post = get_page_by_path('foton', OBJECT, 'post_type');
                    // echo $gallery_post->ID;

                    $images =& get_children( array (
                        'post_parent' => 16, // << here
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image'
                    ));

                    if ( empty($images) ) {
                        // no attachments here
                    } else {
                        foreach ( $images as $attachment_id => $attachment ) {
                            echo wp_get_attachment_image( $attachment_id, 'album-preview', false, ['class' => 'fill'] );
                        }
                    }
                }
            ?>
        </div>


        <div id="profile" class="clearfix">
            <img class="photo" src="https://placeimg.com/200/250/people" alt="Karl Anders Boström" />
            <span class="name">Karl Anders Boström</span>
            <a class="email" href="mailto:info@andersarborist.se">info@andersarborist.se</a>
            <a class="phone" href="tel:+46702337561" title="Klicka för att ringa">070-233 75 61</a>
            <a class="location" href="https://goo.gl/maps/mqg1a53uoRx" title="Klicka för karta">📍Gotland</a>
        </div>

        <?php $the_query = new WP_Query( 'posts_per_page=5' ); ?>
        <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

            <div class="infobox">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </div>

        <?php
        endwhile;
        wp_reset_postdata();
        ?>

    <?php
        if (get_the_ID() != 16) {

    ?>
        <div id="album-preview">
            <a href="/foton">
            <?php
                // Doesn't work, I will use ID 16 instead;
                // $gallery_post = get_page_by_path('foton', OBJECT, 'post_type');
                // echo $gallery_post->ID;

                $images =& get_children( array (
                    'post_parent' => 16, // << here
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'posts_per_page' => 1,
                    'orderby' => 'rand',
                    'order' => 'ASC'
                ));

                if ( empty($images) ) {
                    // no attachments here
                } else {
                    foreach ( $images as $attachment_id => $attachment ) {
                        echo wp_get_attachment_image( $attachment_id, 'album-preview', false, ['class' => 'fill'] );
                    }
                }
            ?>
            </a>
            <div class="caption"><a href="/foton">Visa galleriet.</a></div>
        </div>
    <?php
    }
    ?>

        <?php 
        $args = array(
            'post_type' => 'page',
            'orderby' => 'menu_order',
            'order' => 'asc'
        );
        
        $the_query = new WP_Query( $args );
        ?>
        <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

            <div class="page-preview">
                <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?> &rarr;</a></h2>
                <p><?php the_excerpt(__('…')); ?></p>
            </div>

        <?php
        endwhile;
        wp_reset_postdata();
        ?>

    </div><!-- /#column -->
    <?php wp_footer() ?>
</body>
</html>