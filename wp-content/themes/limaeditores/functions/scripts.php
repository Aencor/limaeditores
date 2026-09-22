<?php

function limaeditores_theme_scripts() {
    if (is_singular() && comments_open() && get_option("thread_comments")) {
        wp_enqueue_script("comment-reply");
    }

    // Google Fonts: Merriweather (Serif elegante) & Inter (Sans moderna)
    wp_enqueue_style(
        "limaeditores-fonts",
        "https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:ital,wght@0,300;0,400;0,700;1,400&display=swap",
        [],
        null
    );

    // Font Awesome 6 Icons
    wp_enqueue_style(
        "font-awesome-6",
        "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css",
        [],
        "6.6.0"
    );

    // Main Compiled Stylesheet
    $style_path = get_template_directory() . "/assets/build/style.css";
    $style_ver = file_exists($style_path) ? filemtime($style_path) : '1.0.0';
    wp_enqueue_style(
        "limaeditores-main-style",
        get_template_directory_uri() . "/assets/build/style.css",
        [],
        $style_ver,
        "all"
    );

    // Main Compiled Script
    $js_path = get_template_directory() . "/assets/build/main.js";
    $js_ver = file_exists($js_path) ? filemtime($js_path) : '1.0.0';
    wp_register_script(
        "limaeditores-main-script",
        get_template_directory_uri() . "/assets/build/main.js",
        ['jquery'],
        $js_ver,
        true
    );

    wp_localize_script("limaeditores-main-script", "limaeditores_vars", [
        'ajax_url' => admin_url('admin-ajax.php'),
        'site_url' => home_url('/'),
    ]);

    wp_enqueue_script("limaeditores-main-script");
}
add_action("wp_enqueue_scripts", "limaeditores_theme_scripts", 9999);
