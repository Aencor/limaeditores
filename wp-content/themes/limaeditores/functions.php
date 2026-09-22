<?php

/**
 * Includes
 *
 * Lima Editores Theme Includes
 */
$theme_includes = [
    "functions/init.php",        // Configuración inicial, soporte de temas y menús
    "functions/config.php",      // Configuración de constantes e imágenes
    "functions/scripts.php",     // Encolado de CSS compilado y JS
    "functions/security.php",    // Endurecimiento y seguridad
    "functions/options.php",     // Opciones globales ACF
    "functions/shortcodes.php",  // Shortcodes personalizados
    "functions/blocks.php",      // Bloques personalizados
    "functions/woocommerce.php", // Funcionalidades de WooCommerce para libros jurídicos
    "functions/ajax-search.php",  // Búsqueda en vivo con AJAX y autocompletado
    "functions/filters.php",      // Sistema de filtros avanzados estilo MercadoLibre
    "functions/account.php"      // Perfil de cliente, foto de avatar y traducciones
];

function limaeditores_include($includes) {
    if (!is_array($includes)) {
        $includes = [$includes];
    }
    foreach ($includes as $file) {
        if (!($filepath = locate_template($file))) {
            trigger_error(
                sprintf(__("Error localizando %s para inclusión", "limaeditores"), $file),
                E_USER_WARNING
            );
            continue;
        }
        require_once $filepath;
    }
}
limaeditores_include($theme_includes);

/*
 * Editor Colors (Paleta Lima Editores)
 */
add_theme_support("disable-custom-colors");

add_theme_support("editor-color-palette", [
    [
        "name" => __("Verde Lima Institucional", "limaeditores"),
        "slug" => "brand-primary",
        "color" => "#74A626"
    ],
    [
        "name" => __("Verde Lima Hover", "limaeditores"),
        "slug" => "brand-primary-hover",
        "color" => "#5E891C"
    ],
    [
        "name" => __("Amarillo Lima Páginas", "limaeditores"),
        "slug" => "brand-accent",
        "color" => "#C4D626"
    ],
    [
        "name" => __("Gris Editorial", "limaeditores"),
        "slug" => "brand-charcoal",
        "color" => "#3A3D40"
    ],
    [
        "name" => __("Verde Oscuro Institucional", "limaeditores"),
        "slug" => "brand-dark",
        "color" => "#1C2518"
    ],
    [
        "name" => __("Fondo Claro Suave", "limaeditores"),
        "slug" => "brand-light",
        "color" => "#F8FAF3"
    ],
    [
        "name" => __("Gris Muted", "limaeditores"),
        "slug" => "brand-muted",
        "color" => "#64748B"
    ]
]);
