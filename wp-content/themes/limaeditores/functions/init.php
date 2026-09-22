<?php
/**
 * Initial setup and constants for Lima Editores
 */
function limaeditores_theme_setup() {
    // Enable plugins to manage the document title
    add_theme_support("title-tag");

    // Add post thumbnails with bookstore aspect ratios
    add_theme_support("post-thumbnails");
    add_image_size("book-cover", 400, 600, true);
    add_image_size("book-cover-large", 800, 1200, false);
    add_image_size("book-thumbnail", 120, 180, true);

    // Add Menus
    register_nav_menus([
        'primary'    => __('Menú Principal (Cabecera)', 'limaeditores'),
        'categories' => __('Menú de Ramas del Derecho / Categorías', 'limaeditores'),
        'footer'     => __('Menú del Pie de Página', 'limaeditores'),
        'legal'      => __('Menú Legal y Políticas', 'limaeditores'),
    ]);

    // Add HTML5 markup
    add_theme_support("html5", [
        "search-form",
        "comment-form",
        "comment-list",
        "gallery",
        "caption",
        "style",
        "script"
    ]);

    // Custom Logo
    add_theme_support("custom-logo", [
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
}
add_action("after_setup_theme", "limaeditores_theme_setup");
