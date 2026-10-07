<?php
/**
 * Create the 2 official products for Lima Editores
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');

echo "=== INICIANDO CREACIÓN DE PRODUCTOS OFICIALES ===\n";

// 1. Eliminar productos de prueba / semillas anteriores
$existing_products = get_posts([
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'any',
    'fields'         => 'ids'
]);

foreach ($existing_products as $p_id) {
    wp_delete_post($p_id, true);
    echo "Eliminado producto anterior ID: {$p_id}\n";
}

// 2. Crear / Asegurar Categorías
$categories = [
    'Derecho Agrario' => 'Obras sobre régimen ejidal, comunal, propiedad de la tierra y derecho rural.',
    'Derecho Civil' => 'Tratados de obligaciones, contratos, derechos reales, personas y familia.',
    'Derecho Penal' => 'Obras de teoría del delito, criminología, derecho penal especial y compliance.',
    'Derecho Corporativo' => 'Sociedades mercantiles, derecho financiero, prevención de lavado de dinero y compliance.',
    'Derecho Administrativo' => 'Marco regulatorio, procedimiento administrativo y contrataciones.'
];

$cat_ids = [];
foreach ($categories as $cat_name => $cat_desc) {
    $term = term_exists($cat_name, 'product_cat');
    if (!$term) {
        $term = wp_insert_term($cat_name, 'product_cat', ['description' => $cat_desc]);
    }
    $cat_ids[$cat_name] = is_array($term) ? $term['term_id'] : $term;
}

$upload_dir = wp_upload_dir();
$source_dir = WP_CONTENT_DIR . '/uploads/source_books';

// Función para subir una imagen a la librería de medios
function import_image_to_media($source_file, $title, $parent_id = 0) {
    if (!file_exists($source_file)) {
        return false;
    }
    $filename = basename($source_file);
    $upload_dir = wp_upload_dir();
    $dest_file = $upload_dir['path'] . '/' . wp_unique_filename($upload_dir['path'], $filename);
    copy($source_file, $dest_file);

    $file_type = wp_check_filetype($dest_file, null);
    $attachment = [
        'post_mime_type' => $file_type['type'] ?: 'image/png',
        'post_title'     => sanitize_text_field($title),
        'post_content'   => '',
        'post_status'    => 'inherit'
    ];

    $attach_id = wp_insert_attachment($attachment, $dest_file, $parent_id);
    $attach_data = wp_generate_attachment_metadata($attach_id, $dest_file);
    wp_update_attachment_metadata($attach_id, $attach_data);

    return $attach_id;
}

// 3. Definición de los dos productos con sus mockups JPEG y galería
$products_data = [
    [
        'title'          => 'La Propiedad Social. Una propiedad amarga',
        'author'         => 'Dr. Pascual Alberto Orozco Garibay',
        'categories'     => ['Derecho Agrario', 'Derecho Civil'],
        'price'          => '500',
        'sale_price'     => '',
        'isbn'           => '978-970-96861-2-8',
        'pages'          => '380',
        'year'           => '2026',
        'edition'        => '1ª Edición',
        'sku'            => 'LIMA-PROP-001',
        'stock'          => 50,
        'front_image'    => $source_dir . '/00 PORTADA_LA PROPIEDAD [010926].jpeg',
        'gallery_images' => [
            $source_dir . '/propiedad_social_front.png',
            $source_dir . '/00 PORTADA_LA PROPIEDAD [010926].pdf.png'
        ],
        'short_desc'     => 'Estudio jurídico, económico y social sobre la evolución del régimen ejidal y comunal, el artículo 27 constitucional y las reformas a la propiedad social en México.',
        'desc'           => "<p>La propiedad social constituye uno de los temas más complejos y trascendentes del derecho mexicano. En esta obra, el <strong>Dr. Pascual Alberto Orozco Garibay</strong> reconstruye su evolución desde el siglo XIX hasta nuestros días, examinando las transformaciones constitucionales y legislativas que dieron origen al régimen ejidal y comunal. A partir de este recorrido histórico, el autor muestra cómo las decisiones jurídicas y políticas adoptadas en torno a la tierra han incidido profundamente en la vida económica y social de ejidatarios, comuneros y comunidades indígenas.</p>\n\n<p>Con una perspectiva jurídica, económica y social, el libro analiza críticamente el artículo 27 constitucional, el reparto agrario, las restricciones a la propiedad y transmisión de las tierras, así como las reformas de 1992 y 2001. El estudio pone particular atención en sus consecuencias: pobreza, migración rural, baja productividad, inseguridad jurídica y dependencia alimentaria. La propiedad social aparece así ante una paradoja: un régimen concebido como instrumento de justicia y reivindicación social que, al limitar la libertad y seguridad jurídica de quienes trabajan la tierra, puede convertirse en un obstáculo para su desarrollo.</p>\n\n<p>Frente a este panorama, <em>La propiedad social. Una propiedad amarga</em> no se limita al diagnóstico. En su último capítulo plantea alternativas y propuestas de reforma constitucional y legislativa encaminadas a fortalecer la seguridad jurídica, reconocer plenamente los derechos de los sujetos agrarios, impulsar la productividad del campo y favorecer una mayor circulación de los inmuebles, sin desconocer la naturaleza y protección especial de las comunidades indígenas. Se trata, en suma, de una obra que invita a reconsiderar uno de los problemas históricos aún pendientes de México: cómo hacer de la propiedad de la tierra un verdadero instrumento de libertad, dignidad y desarrollo económico y social.</p>"
    ],
    [
        'title'          => 'Ley Federal para la Prevención e Identificación de Operaciones con Recursos de Procedencia Ilícita',
        'author'         => 'Lima Editorial',
        'categories'     => ['Derecho Penal', 'Derecho Corporativo'],
        'price'          => '500',
        'sale_price'     => '',
        'isbn'           => '978-970-96861-1-1',
        'pages'          => '320',
        'year'           => '2026',
        'edition'        => 'Edición Oficial Actualizada',
        'sku'            => 'LIMA-LFP-002',
        'stock'          => 50,
        'front_image'    => $source_dir . '/Portada_Ley_Federal.jpeg',
        'gallery_images' => [
            $source_dir . '/ley_federal_front.png',
            $source_dir . '/Portada_Ley_Federal.pdf.png'
        ],
        'short_desc'     => 'Texto vigente y actualizado con Reglamento y Reglas de Carácter General (Ley Antilavado). Herramienta indispensable para el cumplimiento normativo en México.',
        'desc'           => "<p>La lucha contra el lavado de dinero constituye uno de los mayores retos de los Estados modernos. En México, la <strong>Ley Federal para la Prevención e Identificación de Operaciones con Recursos de Procedencia Ilícita</strong> se erige como un pilar normativo esencial para blindar al sistema financiero y a la economía nacional frente a los riesgos que representan las organizaciones delictivas.</p>\n\n<p>Esta obra presenta el texto vigente de la Ley, junto con su Reglamento y las Reglas de Carácter General; incorporando las reformas más recientes —incluida la del 16 de julio de 2025— y ofrece una herramienta indispensable para profesionales del derecho, fedatarios públicos, autoridades financieras, académicos y toda persona interesada en comprender a fondo el marco jurídico que rige las operaciones económicas en nuestro país.</p>\n\n<h3>Contenido y Estructura:</h3>\n<ul>\n  <li><strong>Ley Federal para la Prevención e Identificación de Operaciones con Recursos de Procedencia Ilícita</strong> íntegra y sistematizada.</li>\n  <li><strong>Reglamento de la Ley Federal</strong> con concordancias directas a los artículos aplicables.</li>\n  <li><strong>Reglas de Carácter General</strong> expedidas por la SHCP y la UIF.</li>\n  <li>Catálogo completo de Actividades Vulnerables y obligaciones de reporte e identificación.</li>\n</ul>"
    ]
];

foreach ($products_data as $data) {
    $product = new WC_Product_Simple();
    $product->set_name($data['title']);
    $product->set_status('publish');
    $product->set_catalog_visibility('visible');
    $product->set_short_description($data['short_desc']);
    $product->set_description($data['desc']);
    $product->set_sku($data['sku']);
    $product->set_regular_price($data['price']);
    if (!empty($data['sale_price'])) {
        $product->set_sale_price($data['sale_price']);
    }
    $product->set_manage_stock(true);
    $product->set_stock_quantity($data['stock']);
    $product->set_stock_status('instock');

    // Categorías
    $product_cat_ids = [];
    foreach ($data['categories'] as $cat_name) {
        if (isset($cat_ids[$cat_name])) {
            $product_cat_ids[] = $cat_ids[$cat_name];
        }
    }
    $product->set_category_ids($product_cat_ids);

    $product_id = $product->save();

    // Metadatos específicos de libros jurídicos
    update_post_meta($product_id, '_book_author', $data['author']);
    update_post_meta($product_id, '_book_isbn', $data['isbn']);
    update_post_meta($product_id, '_book_pages', $data['pages']);
    update_post_meta($product_id, '_book_year', $data['year']);
    update_post_meta($product_id, '_book_edition', $data['edition']);
    update_post_meta($product_id, '_book_law_branch', implode(', ', $data['categories']));

    update_post_meta($product_id, 'book_author', $data['author']);
    update_post_meta($product_id, 'book_isbn', $data['isbn']);
    update_post_meta($product_id, 'book_pages', $data['pages']);
    update_post_meta($product_id, 'book_year', $data['year']);
    update_post_meta($product_id, 'book_edition', $data['edition']);
    update_post_meta($product_id, 'book_law_branch', implode(', ', $data['categories']));

    // Si ACF está disponible
    if (function_exists('update_field')) {
        update_field('book_author', $data['author'], $product_id);
        update_field('book_isbn', $data['isbn'], $product_id);
        update_field('book_pages', $data['pages'], $product_id);
        update_field('book_year', $data['year'], $product_id);
        update_field('book_edition', $data['edition'], $product_id);
        update_field('book_law_branch', implode(', ', $data['categories']), $product_id);
    }

    // Subir imagen destacada (Mockup JPEG 3D oficial)
    $front_thumb_id = import_image_to_media($data['front_image'], 'Portada ' . $data['title'], $product_id);
    if ($front_thumb_id) {
        set_post_thumbnail($product_id, $front_thumb_id);
    }

    // Subir imágenes a la galería
    $gallery_ids = [];
    foreach ($data['gallery_images'] as $idx => $g_img) {
        $g_thumb_id = import_image_to_media($g_img, $data['title'] . ' - Vista ' . ($idx + 1), $product_id);
        if ($g_thumb_id) {
            $gallery_ids[] = $g_thumb_id;
        }
    }
    if (!empty($gallery_ids)) {
        $product->set_gallery_image_ids($gallery_ids);
        $product->save();
    }

    echo "✓ Creado producto ID {$product_id}: {$data['title']} - Precio: $ {$data['price']} MXN (Portada Destacada ID: {$front_thumb_id})\n";
}

echo "\n¡Los dos productos fueron creados y configurados exitosamente a $500 pesos cada uno!\n";
