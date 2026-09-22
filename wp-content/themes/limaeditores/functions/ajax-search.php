<?php
/**
 * AJAX Live Search Handler for Lima Editores Bookstore
 */

add_action('wp_ajax_limaeditores_ajax_search', 'limaeditores_ajax_search_callback');
add_action('wp_ajax_nopriv_limaeditores_ajax_search', 'limaeditores_ajax_search_callback');

function limaeditores_ajax_search_callback() {
    $term = sanitize_text_field($_REQUEST['term'] ?? '');

    if (strlen(trim($term)) < 2) {
        wp_send_json_success([
            'results' => [],
            'total'   => 0,
            'term'    => $term,
        ]);
    }

    $args = [
        'post_type'      => 'product',
        'post_status'    => 'publish',
        's'              => $term,
        'posts_per_page' => 6,
        'orderby'        => 'relevance',
        'order'          => 'DESC',
    ];

    $query = new WP_Query($args);
    $results = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product_id = get_the_ID();
            $product = wc_get_product($product_id);

            if (!$product) {
                continue;
            }

            // Thumbnail
            $thumb_url = get_the_post_thumbnail_url($product_id, 'thumbnail');
            if (!$thumb_url) {
                $thumb_url = wc_placeholder_img_src('thumbnail');
            }

            // Category
            $categories = wc_get_product_category_list($product_id, ', ');
            $cats_plain = wp_strip_all_tags($categories);

            // Author custom field or attribute if exists
            $author = get_post_meta($product_id, 'autor', true);
            if (!$author) {
                $author = get_post_meta($product_id, '_autor', true);
            }
            if (!$author) {
                $author = $product->get_attribute('pa_autor');
            }

            $results[] = [
                'id'         => $product_id,
                'title'      => get_the_title(),
                'url'        => get_permalink($product_id),
                'thumb'      => $thumb_url,
                'price_html' => $product->get_price_html(),
                'category'   => $cats_plain ? $cats_plain : 'Editorial Jurídica',
                'author'     => $author ? $author : '',
                'in_stock'   => $product->is_in_stock(),
            ];
        }
        wp_reset_postdata();
    }

    wp_send_json_success([
        'results'    => $results,
        'total'      => $query->found_posts,
        'term'       => $term,
        'search_url' => home_url('/?s=' . urlencode($term) . '&post_type=product'),
    ]);
}
