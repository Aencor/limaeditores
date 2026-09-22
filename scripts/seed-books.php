<?php
/**
 * Seed 15 Legal Book Products for Lima Editores
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Create Legal Categories
$categories = [
    'Derecho Penal' => 'Obras de teoría del delito, criminología, parte general y especial del derecho penal.',
    'Derecho Civil' => 'Tratados de obligaciones, contratos, derechos reales, personas y familia.',
    'Derecho Procesal' => 'Litigación oral, derecho procesal civil, procesal penal y teoría general del proceso.',
    'Derecho Constitucional' => 'Derechos fundamentales, jurisprudencia del Tribunal Constitucional y procesos de amparo.',
    'Derecho Laboral' => 'Relaciones individuales y colectivas de trabajo, regímenes laborales y seguridad social.',
    'Derecho Administrativo' => 'Contrataciones del Estado, procedimiento sancionador y gestión pública.',
    'Derecho Corporativo' => 'Sociedades mercantiles, derecho tributario, finanzas y compliance empresarial.'
];

$cat_ids = [];
foreach ($categories as $cat_name => $cat_desc) {
    $term = term_exists($cat_name, 'product_cat');
    if (!$term) {
        $term = wp_insert_term($cat_name, 'product_cat', ['description' => $cat_desc]);
    }
    $cat_ids[$cat_name] = is_array($term) ? $term['term_id'] : $term;
}

// 2. 15 Legal Books Data
$books = [
    [
        'title'       => 'Tratado de Derecho Penal - Parte General (Tomo I y II)',
        'author'      => 'Claus Roxin',
        'category'    => 'Derecho Penal',
        'price'       => '280.00',
        'sale_price'  => '245.00',
        'isbn'        => '978-612-48291-0-1',
        'pages'       => '1150',
        'year'        => '2026',
        'edition'     => '4ª Edición Aumentada',
        'sku'         => 'DP-ROX-001',
        'short_desc'  => 'Obra cumbre de la dogmática penal moderna. Fundamentos de la teoría de la imputación objetiva y culpabilidad.',
        'desc'        => 'El Tratado de Derecho Penal de Claus Roxin constituye el referente doctrinal más trascendente del derecho penal contemporáneo. En esta nueva edición revisada y anotada, se desarrollan con profundidad sistemática las bases del injusto penal, la imputación al tipo objetivo, el dolo, la autoría y participación, y las causas de justificación conforme a la jurisprudencia más reciente.'
    ],
    [
        'title'       => 'Código Procesal Civil Comentado y Concordado',
        'author'      => 'Juan Monroy Gálvez & Colectivo Procesal',
        'category'    => 'Derecho Procesal',
        'price'       => '195.00',
        'sale_price'  => '',
        'isbn'        => '978-612-48291-0-2',
        'pages'       => '890',
        'year'        => '2026',
        'edition'     => '3ª Edición Oficial',
        'sku'         => 'DPR-MON-002',
        'short_desc'  => 'Análisis artículo por artículo con plenos casatorios civiles y doctrina procesal actualizada.',
        'desc'        => 'Exégesis rigurosa del Código Procesal Civil con doctrina comparada, esquemas procesales y sumillas de las casaciones más relevantes de la Corte Suprema. Una herramienta indispensable para jueces, litigantes y procuradores públicos.'
    ],
    [
        'title'       => 'Derecho Constitucional y Garantías Fundamentales',
        'author'      => 'Domingo García Belaunde',
        'category'    => 'Derecho Constitucional',
        'price'       => '150.00',
        'sale_price'  => '130.00',
        'isbn'        => '978-612-48291-0-3',
        'pages'       => '620',
        'year'        => '2025',
        'edition'     => '2ª Edición',
        'sku'         => 'DC-GAR-003',
        'short_desc'  => 'Estudio integral del constitucionalismo, separación de poderes y control de constitucionalidad.',
        'desc'        => 'Esta obra aborda las instituciones capitales del Derecho Constitucional: el Estado Constitucional de Derecho, la interpretación conforme a los tratados de DD.HH., los precedentes vinculantes y la defensa de las libertades fundamentales frente al poder punitivo.'
    ],
    [
        'title'       => 'Teoría General del Acto Jurídico y Negocio Jurídico',
        'author'      => 'Fernando Vidal Ramírez',
        'category'    => 'Derecho Civil',
        'price'       => '135.00',
        'sale_price'  => '',
        'isbn'        => '978-612-48291-0-4',
        'pages'       => '540',
        'year'        => '2026',
        'edition'     => '10ª Edición Homenaje',
        'sku'         => 'DCIV-VID-004',
        'short_desc'  => 'El texto clásico del derecho civil sobre la manifestación de voluntad, validez y eficacia negociar.',
        'desc'        => 'Análisis exhaustivo de la estructura del acto jurídico, vicios de la voluntad, simulación, fraude a los acreedores, nulidad y anulabilidad. Texto de consulta obligada para la redacción de contratos complejos y litigación civil.'
    ],
    [
        'title'       => 'El Proceso de Amparo y Tutela de Urgencia',
        'author'      => 'Samuel Abad Yupanqui',
        'category'    => 'Derecho Constitucional',
        'price'       => '140.00',
        'sale_price'  => '120.00',
        'isbn'        => '978-612-48291-0-5',
        'pages'       => '480',
        'year'        => '2026',
        'edition'     => '2ª Edición',
        'sku'         => 'DC-ABA-005',
        'short_desc'  => 'Guía práctica para la interposición de demandas constitucionales y medidas cautelares.',
        'desc'        => 'Manual práctico y dogmático enfocado en la procedencia del amparo contra resoluciones judiciales, actos administrativos y violaciones de derechos fundamentales en el ámbito laboral y corporativo.'
    ],
    [
        'title'       => 'Manual de Litigación Penal Oral en el Nuevo Código',
        'author'      => 'Baytelman & Duce',
        'category'    => 'Derecho Procesal',
        'price'       => '160.00',
        'sale_price'  => '',
        'isbn'        => '978-612-48291-0-6',
        'pages'       => '510',
        'year'        => '2025',
        'edition'     => '5ª Edición',
        'sku'         => 'DPR-BAY-006',
        'short_desc'  => 'Estrategias de examen directo, contraexamen, objeciones y alegatos de clausura.',
        'desc'        => 'El libro de cabecera para litigantes del sistema penal acusatorio. Enseña a construir teorías del caso sólidas, interrogar testigos y peritos, desacreditar testimonios y formular alegatos persuasivos ante los tribunales.'
    ],
    [
        'title'       => 'Derecho Administrativo Sancionador y Procedimiento Trilateral',
        'author'      => 'Juan Carlos Morón Urbina',
        'category'    => 'Derecho Administrativo',
        'price'       => '210.00',
        'sale_price'  => '185.00',
        'isbn'        => '978-612-48291-0-7',
        'pages'       => '780',
        'year'        => '2026',
        'edition'     => '16ª Edición',
        'sku'         => 'DA-MOR-007',
        'short_desc'  => 'Comentarios a la Ley del Procedimiento Administrativo General (TUO Ley N° 27444).',
        'desc'        => 'Explicación minuciosa de los principios de la potestad sancionadora, non bis in idem, presunción de licitud, caducidad, prescripción y los medios impugnatorios ante entidades públicas y organismos reguladores.'
    ],
    [
        'title'       => 'Derecho Laboral Individual, Colectivo y Procesal del Trabajo',
        'author'      => 'Jorge Toyama Miyagusuku',
        'category'    => 'Derecho Laboral',
        'price'       => '175.00',
        'sale_price'  => '',
        'isbn'        => '978-612-48291-0-8',
        'pages'       => '690',
        'year'        => '2026',
        'edition'     => '6ª Edición',
        'sku'         => 'DL-TOY-008',
        'short_desc'  => 'Guía integral para asesores corporativos, sindicatos y gestión de recursos humanos.',
        'desc'        => 'Abarca contratos laborales, teletrabajo, despidos y ceses colectivos, indemnizaciones, inspecciones de SUNAFIL, convenios colectivos y litigación en la Nueva Ley Procesal del Trabajo.'
    ],
    [
        'title'       => 'Tratado de las Obligaciones y Responsabilidad Civil',
        'author'      => 'Felipe Osterling Parodi & Mario Castillo Freyre',
        'category'    => 'Derecho Civil',
        'price'       => '310.00',
        'sale_price'  => '270.00',
        'isbn'        => '978-612-48291-0-9',
        'pages'       => '1420',
        'year'        => '2025',
        'edition'     => 'Edición Conmemorativa',
        'sku'         => 'DCIV-OST-009',
        'short_desc'  => 'La obra monumental del derecho obligacional peruano e hispanoamericano.',
        'desc'        => 'Desarrollo sistemático de los modos de extinción de las obligaciones, el dolo, la culpa inexcusable, el daño patrimonial y extrapatrimonial, y las tendencias contemporáneas de la responsabilidad extracontractual.'
    ],
    [
        'title'       => 'Compliance Penal y Prevención de Delitos Corporativos',
        'author'      => 'Eduardo Demetrio Crespo & Dino Carlos Caro Coria',
        'category'    => 'Derecho Corporativo',
        'price'       => '180.00',
        'sale_price'  => '',
        'isbn'        => '978-612-48291-0-10',
        'pages'       => '580',
        'year'        => '2026',
        'edition'     => '1ª Edición',
        'sku'         => 'DCOR-CAR-010',
        'short_desc'  => 'Modelos de prevención de lavado de activos, corrupción y responsabilidad de las personas jurídicas.',
        'desc'        => 'Aborda la responsabilidad penal de los directores, oficiales de cumplimiento (Compliance Officers), investigaciones internas corporativas y programas de debida diligencia según la Ley N° 30424 e ISO 37001.'
    ],
    [
        'title'       => 'Derecho Tributario Empresarial y Fiscalización de SUNAT',
        'author'      => 'Walker Villanueva Gutiérrez',
        'category'    => 'Derecho Corporativo',
        'price'       => '165.00',
        'sale_price'  => '145.00',
        'isbn'        => '978-612-48291-0-11',
        'pages'       => '610',
        'year'        => '2026',
        'edition'     => '4ª Edición',
        'sku'         => 'DCOR-VIL-011',
        'short_desc'  => 'Estrategias de defensa tributaria en el Impuesto a la Renta, IGV y Tribunal Fiscal.',
        'desc'        => 'Enfoque práctico y jurisprudencial sobre deducción de gastos, bancarización, norma XVI antielusiva, precios de transferencia y reclamaciones frente a acotaciones tributarias.'
    ],
    [
        'title'       => 'Argumentación Jurídica y Motivación de Resoluciones Judiciales',
        'author'      => 'Manuel Atienza Rodríguez',
        'category'    => 'Derecho Procesal',
        'price'       => '125.00',
        'sale_price'  => '',
        'isbn'        => '978-612-48291-0-12',
        'pages'       => '430',
        'year'        => '2025',
        'edition'     => '3ª Edición',
        'sku'         => 'DPR-ATI-012',
        'short_desc'  => 'Criterios de lógica jurídica, ponderación de derechos y justificación de sentencias.',
        'desc'        => 'Un tratado fundamental para jueces, fiscales y abogados que buscan estructurar alegatos y fallos libres de falacias, con estricto apego al deber constitucional de debida motivación.'
    ],
    [
        'title'       => 'Derechos Reales y Garantías Mobiliarias',
        'author'      => 'Gunther Gonzales Barrón',
        'category'    => 'Derecho Civil',
        'price'       => '190.00',
        'sale_price'  => '165.00',
        'isbn'        => '978-612-48291-0-13',
        'pages'       => '760',
        'year'        => '2026',
        'edition'     => '5ª Edición',
        'sku'         => 'DCIV-GON-013',
        'short_desc'  => 'Posesión, propiedad, fe pública registral, hipoteca y el nuevo régimen de garantías.',
        'desc'        => 'Estudio crítico y profundo sobre la protección de la propiedad inmobiliaria frente al fraude registral, desalojo preventivo y ejecuciones extrajudiciales.'
    ],
    [
        'title'       => 'Derecho Penal Económico y Delitos Financieros',
        'author'      => 'Percy García Cavero',
        'category'    => 'Derecho Penal',
        'price'       => '220.00',
        'sale_price'  => '',
        'isbn'        => '978-612-48291-0-14',
        'pages'       => '820',
        'year'        => '2026',
        'edition'     => '3ª Edición',
        'sku'         => 'DP-PER-014',
        'short_desc'  => 'Fraude en la administración de personas jurídicas, delitos contables y bursátiles.',
        'desc'        => 'Análisis dogmático y procesal de los delitos societarios, quiebras fraudulentas, lavado de activos y delitos aduaneros con abundante jurisprudencia de las salas penales supremas.'
    ],
    [
        'title'       => 'Contratación Pública y Arbitraje con el Estado',
        'author'      => 'Christian Guzmán Napurí',
        'category'    => 'Derecho Administrativo',
        'price'       => '170.00',
        'sale_price'  => '148.00',
        'isbn'        => '978-612-48291-0-15',
        'pages'       => '670',
        'year'        => '2026',
        'edition'     => '4ª Edición',
        'sku'         => 'DA-GUZ-015',
        'short_desc'  => 'Procedimientos de selección, ejecución contractual y resolución de controversias ante el OSCE.',
        'desc'        => 'Manual indispensable para licitadores y árbitros. Trata las ampliaciones de plazo, adicionales de obra, penalidades, nulidad de contratos públicos y anulación de laudos arbitrales.'
    ]
];

// Helper to generate a styled book cover image
function create_book_cover_svg($title, $author, $category, $year) {
    $bg_colors = [
        'Derecho Penal' => ['#0F172A', '#1E293B', '#C59B27'],
        'Derecho Civil' => ['#1E3A8A', '#1E40AF', '#D97706'],
        'Derecho Procesal' => ['#0A192F', '#1E3A8A', '#F59E0B'],
        'Derecho Constitucional' => ['#581C87', '#3B0764', '#EAB308'],
        'Derecho Laboral' => ['#14532D', '#166534', '#FCD34D'],
        'Derecho Administrativo' => ['#7C2D12', '#9A3412', '#FDE047'],
        'Derecho Corporativo' => ['#1E293B', '#0F172A', '#38BDF8'],
    ];

    $palette = $bg_colors[$category] ?? ['#0A192F', '#1E3A8A', '#C59B27'];
    $bg1 = $palette[0];
    $bg2 = $palette[1];
    $accent = $palette[2];

    $wrapped_title = wordwrap(strtoupper($title), 24, "\n");
    $lines = explode("\n", $wrapped_title);
    $title_svg = '';
    $y = 230;
    foreach ($lines as $i => $line) {
        if ($i < 4) {
            $title_svg .= '<text x="175" y="' . ($y + ($i * 24)) . '" font-family="Georgia, serif" font-size="16" font-weight="bold" fill="#FFFFFF" text-anchor="middle">' . htmlspecialchars($line) . '</text>';
        }
    }

    $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="350" height="500" viewBox="0 0 350 500">
  <defs>
    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:{$bg1};stop-opacity:1" />
      <stop offset="100%" style="stop-color:{$bg2};stop-opacity:1" />
    </linearGradient>
    <filter id="shadow" x="-5%" y="-5%" width="110%" height="110%">
      <feDropShadow dx="2" dy="4" stdDeviation="4" flood-color="#000" flood-opacity="0.3"/>
    </filter>
  </defs>
  <!-- Book Background -->
  <rect width="350" height="500" rx="12" fill="url(#grad)" filter="url(#shadow)" />
  
  <!-- Left Book Spine Accent -->
  <rect x="0" y="0" width="18" height="500" rx="4" fill="#000000" opacity="0.25" />
  <line x1="22" y1="0" x2="22" y2="500" stroke="{$accent}" stroke-width="1.5" opacity="0.6" />
  
  <!-- Inner Border Frame -->
  <rect x="35" y="30" width="280" height="440" rx="6" fill="none" stroke="{$accent}" stroke-width="1.5" opacity="0.75" />
  
  <!-- Header / Category -->
  <text x="175" y="70" font-family="'Inter', sans-serif" font-size="11" font-weight="700" fill="{$accent}" letter-spacing="2" text-anchor="middle">COLECCIÓN JURÍDICA</text>
  <text x="175" y="90" font-family="'Inter', sans-serif" font-size="9" font-weight="600" fill="#CBD5E1" letter-spacing="1" text-anchor="middle">LIMA EDITORES</text>
  
  <!-- Decorative Scale / Law Emblem -->
  <circle cx="175" cy="145" r="28" fill="{$accent}" opacity="0.15" />
  <path d="M175 125 v35 M160 135 h30 M155 135 l-10 15 h20 z M195 135 l-10 15 h20 z" stroke="{$accent}" stroke-width="2" fill="none" />
  
  <!-- Title -->
  {$title_svg}
  
  <!-- Separator -->
  <line x1="120" y1="340" x2="230" y2="340" stroke="{$accent}" stroke-width="1.5" />
  
  <!-- Author -->
  <text x="175" y="375" font-family="Georgia, serif" font-size="14" font-style="italic" fill="#F8FAFC" text-anchor="middle">{$author}</text>
  
  <!-- Footer details -->
  <text x="175" y="440" font-family="'Inter', sans-serif" font-size="10" font-weight="600" fill="{$accent}" letter-spacing="1" text-anchor="middle">EDICIÓN {$year}</text>
</svg>
SVG;

    return $svg;
}

$upload_dir = wp_upload_dir();
wp_mkdir_p($upload_dir['path']);

$created_count = 0;
foreach ($books as $data) {
    // Check if product already exists by title
    $existing = get_page_by_title($data['title'], OBJECT, 'product');
    $product = $existing ? wc_get_product($existing->ID) : new WC_Product_Simple();

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
    $product->set_stock_quantity(rand(10, 45));
    $product->set_stock_status('instock');

    // Assign Category
    if (isset($cat_ids[$data['category']])) {
        $product->set_category_ids([$cat_ids[$data['category']]]);
    }

    $product_id = $product->save();

    // Set custom book meta
    update_post_meta($product_id, '_book_author', $data['author']);
    update_post_meta($product_id, '_book_isbn', $data['isbn']);
    update_post_meta($product_id, '_book_pages', $data['pages']);
    update_post_meta($product_id, '_book_year', $data['year']);
    update_post_meta($product_id, '_book_edition', $data['edition']);
    update_post_meta($product_id, '_book_law_branch', $data['category']);

    // Generate & Attach SVG Cover if not already attached
    if (!has_post_thumbnail($product_id)) {
        $filename = sanitize_title($data['title']) . '.svg';
        $filepath = $upload_dir['path'] . '/' . $filename;
        $svg_content = create_book_cover_svg($data['title'], $data['author'], $data['category'], $data['year']);
        file_put_contents($filepath, $svg_content);

        $attachment = [
            'post_mime_type' => 'image/svg+xml',
            'post_title'     => sanitize_file_name($filename),
            'post_content'   => '',
            'post_status'    => 'inherit'
        ];
        $attach_id = wp_insert_attachment($attachment, $filepath, $product_id);
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $filepath);
        wp_update_attachment_metadata($attach_id, $attach_data);
        set_post_thumbnail($product_id, $attach_id);
    }

    $created_count++;
    echo "✓ [{$created_count}/15] Creado: {$data['title']} (S/ {$data['price']})\n";
}

// Ensure default shop pages are created
if (function_exists('wc_create_pages')) {
    wc_create_pages();
}

echo "\n¡Se crearon y configuraron exitosamente {$created_count} libros jurídicos en WooCommerce!\n";
