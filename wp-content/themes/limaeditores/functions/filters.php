<?php
/**
 * Advanced MercadoLibre-Style Filter System for Lima Editores Bookstore
 */

// Include in main query
add_action('pre_get_posts', 'limaeditores_filter_products_query');

function limaeditores_filter_products_query($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() || (is_search() && $query->get('post_type') === 'product')) {
        $meta_query = $query->get('meta_query') ? (array)$query->get('meta_query') : [];
        $tax_query  = $query->get('tax_query') ? (array)$query->get('tax_query') : [];

        // 1. Price Filter (MXN)
        $min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : 0;
        $max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : 0;

        if ($min_price > 0 && $max_price > 0) {
            $meta_query[] = [
                'key'     => '_price',
                'value'   => [$min_price, $max_price],
                'type'    => 'NUMERIC',
                'compare' => 'BETWEEN',
            ];
        } elseif ($min_price > 0) {
            $meta_query[] = [
                'key'     => '_price',
                'value'   => $min_price,
                'type'    => 'NUMERIC',
                'compare' => '>=',
            ];
        } elseif ($max_price > 0) {
            $meta_query[] = [
                'key'     => '_price',
                'value'   => $max_price,
                'type'    => 'NUMERIC',
                'compare' => '<=',
            ];
        }

        // 2. Rating Filter (Calificaciones)
        if (!empty($_GET['rating'])) {
            $rating = floatval($_GET['rating']);
            $meta_query[] = [
                'key'     => '_wc_average_rating',
                'value'   => $rating,
                'type'    => 'DECIMAL(3,2)',
                'compare' => '>=',
            ];
        }

        // 3. Author Filter (Autor Jurídico)
        if (!empty($_GET['author_name'])) {
            $author = sanitize_text_field($_GET['author_name']);
            $meta_query[] = [
                'key'     => '_book_author',
                'value'   => $author,
                'compare' => 'LIKE',
            ];
        }

        // 4. Edition Year Filter (Año de Edición / Novedades)
        if (!empty($_GET['book_year'])) {
            $year = sanitize_text_field($_GET['book_year']);
            $meta_query[] = [
                'key'     => '_book_year',
                'value'   => $year,
                'compare' => '=',
            ];
        }

        // 5. On Sale Filter (Ofertas)
        if (!empty($_GET['on_sale']) && $_GET['on_sale'] === '1') {
            $product_ids_on_sale = wc_get_product_ids_on_sale();
            $query->set('post__in', !empty($product_ids_on_sale) ? $product_ids_on_sale : [0]);
        }

        // 6. Sorting Order
        if (!empty($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'price':
                    $query->set('orderby', 'meta_value_num');
                    $query->set('meta_key', '_price');
                    $query->set('order', 'ASC');
                    break;
                case 'price-desc':
                    $query->set('orderby', 'meta_value_num');
                    $query->set('meta_key', '_price');
                    $query->set('order', 'DESC');
                    break;
                case 'rating':
                    $query->set('orderby', 'meta_value_num');
                    $query->set('meta_key', '_wc_average_rating');
                    $query->set('order', 'DESC');
                    break;
                case 'date':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
            }
        }

        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }
        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }
    }
}

/**
 * Seed realistic ratings and authors for bookstore catalog demo
 */
add_action('init', function() {
    static $seeded = false;
    if ($seeded) return;
    $seeded = true;

    $authors_map = [
        10 => ['author' => 'Claus Roxin', 'year' => '2026', 'rating' => 5.0, 'reviews' => 14],
        12 => ['author' => 'Luigi Ferrajoli', 'year' => '2025', 'rating' => 4.8, 'reviews' => 9],
        14 => ['author' => 'Marcial Rubio Correa', 'year' => '2026', 'rating' => 4.9, 'reviews' => 12],
        16 => ['author' => 'Aníbal Torres Vásquez', 'year' => '2024', 'rating' => 4.6, 'reviews' => 8],
        18 => ['author' => 'Samuel Abad Yupanqui', 'year' => '2025', 'rating' => 4.7, 'reviews' => 11],
        20 => ['author' => 'César San Martín Castro', 'year' => '2026', 'rating' => 5.0, 'reviews' => 21],
        22 => ['author' => 'Juan Carlos Morón Urbina', 'year' => '2025', 'rating' => 4.5, 'reviews' => 7],
        24 => ['author' => 'Javier Neves Mujica', 'year' => '2024', 'rating' => 4.4, 'reviews' => 6],
        26 => ['author' => 'Felipe Osterling Parodi', 'year' => '2026', 'rating' => 4.9, 'reviews' => 15],
        28 => ['author' => 'Dino Carlos Caro Coria', 'year' => '2026', 'rating' => 4.8, 'reviews' => 10],
        30 => ['author' => 'Walker Villanueva Gutiérrez', 'year' => '2025', 'rating' => 4.6, 'reviews' => 5],
        32 => ['author' => 'Manuel Atienza Rodríguez', 'year' => '2026', 'rating' => 5.0, 'reviews' => 18],
        34 => ['author' => 'Gunther Gonzales Barrón', 'year' => '2024', 'rating' => 4.7, 'reviews' => 8],
        36 => ['author' => 'Percy García Cavero', 'year' => '2026', 'rating' => 4.8, 'reviews' => 13],
        38 => ['author' => 'Christian Guzmán Napurí', 'year' => '2025', 'rating' => 4.5, 'reviews' => 7],
    ];

    foreach ($authors_map as $p_id => $data) {
        if (get_post($p_id)) {
            if (!get_post_meta($p_id, '_book_author', true)) {
                update_post_meta($p_id, '_book_author', $data['author']);
            }
            if (!get_post_meta($p_id, '_book_year', true)) {
                update_post_meta($p_id, '_book_year', $data['year']);
            }
            update_post_meta($p_id, '_wc_average_rating', $data['rating']);
            update_post_meta($p_id, '_wc_review_count', $data['reviews']);
        }
    }
});

/**
 * Render Active Filter Chips (MercadoLibre Style)
 */
function limaeditores_render_active_chips() {
    $active_filters = [];
    $base_url = remove_query_arg(['min_price', 'max_price', 'rating', 'author_name', 'book_year', 'on_sale', 'paged']);

    if (!empty($_GET['author_name'])) {
        $active_filters[] = [
            'label' => 'Autor: ' . esc_html($_GET['author_name']),
            'url'   => remove_query_arg('author_name'),
        ];
    }

    if (!empty($_GET['rating'])) {
        $active_filters[] = [
            'label' => esc_html($_GET['rating']) . '★ o más',
            'url'   => remove_query_arg('rating'),
        ];
    }

    if (!empty($_GET['book_year'])) {
        $active_filters[] = [
            'label' => 'Año: ' . esc_html($_GET['book_year']),
            'url'   => remove_query_arg('book_year'),
        ];
    }

    if (!empty($_GET['min_price']) || !empty($_GET['max_price'])) {
        $min = !empty($_GET['min_price']) ? '$' . number_format((float)$_GET['min_price'], 0) : '$0';
        $max = !empty($_GET['max_price']) ? '$' . number_format((float)$_GET['max_price'], 0) : 'Más';
        $active_filters[] = [
            'label' => "Precio: {$min} - {$max} MXN",
            'url'   => remove_query_arg(['min_price', 'max_price']),
        ];
    }

    if (!empty($_GET['on_sale'])) {
        $active_filters[] = [
            'label' => 'En Oferta',
            'url'   => remove_query_arg('on_sale'),
        ];
    }

    if (empty($active_filters)) {
        return;
    }

    echo '<div class="flex items-center flex-wrap gap-2 mb-4 p-3 bg-slate-100/80 rounded-xl border border-slate-200/80 text-xs">';
    echo '<span class="font-bold text-slate-700 mr-1 flex items-center gap-1.5"><i class="fa-solid fa-filter text-[#74A626]"></i> Filtros activos:</span>';
    foreach ($active_filters as $filter) {
        echo '<a href="' . esc_url($filter['url']) . '" class="inline-flex items-center gap-1.5 px-3 py-1 bg-white text-slate-800 font-semibold rounded-full border border-slate-300 shadow-xs hover:bg-red-50 hover:text-red-600 hover:border-red-300 transition-colors group">';
        echo '<span>' . $filter['label'] . '</span>';
        echo '<i class="fa-solid fa-xmark text-slate-400 group-hover:text-red-500 text-[10px]"></i>';
        echo '</a>';
    }
    echo '<a href="' . esc_url($base_url) . '" class="text-[#74A626] hover:text-[#5E891C] font-bold underline ml-auto pl-2">Limpiar todos</a>';
    echo '</div>';
}

/**
 * Inner Filter Elements (Reused by Desktop Sidebar & Mobile Drawer)
 */
function limaeditores_render_filter_elements() {
    $current_author = $_GET['author_name'] ?? '';
    $current_rating = $_GET['rating'] ?? '';
    $current_year   = $_GET['book_year'] ?? '';
    $current_min    = $_GET['min_price'] ?? '';
    $current_max    = $_GET['max_price'] ?? '';
    $current_sale   = $_GET['on_sale'] ?? '';

    $categories = get_terms([
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
    ]);

    global $wpdb;
    $authors = $wpdb->get_col("
        SELECT DISTINCT meta_value 
        FROM {$wpdb->postmeta} 
        WHERE meta_key = '_book_author' AND meta_value != ''
        ORDER BY meta_value ASC
    ");
    ?>
    <div class="space-y-6">
      
      <!-- 1. Categories / Ramas del Derecho -->
      <?php if (!empty($categories) && !is_wp_error($categories)): ?>
        <div class="filter-group">
          <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2.5 flex items-center justify-between">
            <span>Ramas del Derecho</span>
          </h4>
          <ul class="space-y-1 text-xs">
            <?php foreach ($categories as $cat): ?>
              <?php 
                $is_active = is_product_category($cat->slug);
                $cat_link = get_term_link($cat);
              ?>
              <li>
                <a href="<?php echo esc_url($cat_link); ?>" class="flex items-center justify-between gap-2 py-1.5 px-2.5 rounded-lg transition-colors <?php echo $is_active ? 'bg-[#74A626] text-white font-bold shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-[#74A626]'; ?>">
                  <span class="truncate flex-1 min-w-0"><?php echo esc_html($cat->name); ?></span>
                  <span class="text-[11px] flex-shrink-0 <?php echo $is_active ? 'text-white/90' : 'text-slate-400'; ?>">(<?php echo $cat->count; ?>)</span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <!-- 2. Price Filter (MXN) -->
      <div class="filter-group pt-4 border-t border-slate-200">
        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2.5">Precio (MXN)</h4>
        
        <!-- Quick Presets -->
        <ul class="space-y-1.5 text-xs mb-3 text-slate-600">
          <li>
            <a href="<?php echo esc_url(add_query_arg(['max_price' => '300', 'min_price' => '0', 'paged' => false])); ?>" class="hover:text-[#74A626] block py-0.5 <?php echo ($current_max == '300' && $current_min == '0') ? 'font-bold text-[#74A626]' : ''; ?>">
              Hasta $300 MXN
            </a>
          </li>
          <li>
            <a href="<?php echo esc_url(add_query_arg(['min_price' => '300', 'max_price' => '600', 'paged' => false])); ?>" class="hover:text-[#74A626] block py-0.5 <?php echo ($current_min == '300' && $current_max == '600') ? 'font-bold text-[#74A626]' : ''; ?>">
              $300 a $600 MXN
            </a>
          </li>
          <li>
            <a href="<?php echo esc_url(add_query_arg(['min_price' => '600', 'max_price' => '', 'paged' => false])); ?>" class="hover:text-[#74A626] block py-0.5 <?php echo ($current_min == '600' && empty($current_max)) ? 'font-bold text-[#74A626]' : ''; ?>">
              Más de $600 MXN
            </a>
          </li>
        </ul>

        <!-- Min & Max Form -->
        <form method="get" action="<?php echo esc_url(remove_query_arg(['min_price', 'max_price', 'paged'])); ?>" class="flex items-center gap-1.5">
          <?php foreach ($_GET as $key => $val): ?>
            <?php if (!in_array($key, ['min_price', 'max_price', 'paged'])): ?>
              <input type="hidden" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($val); ?>" />
            <?php endif; ?>
          <?php endforeach; ?>
          <input type="number" name="min_price" placeholder="Mín" value="<?php echo esc_attr($current_min); ?>" class="w-20 text-xs px-2 py-1.5 bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" />
          <span class="text-slate-400 text-xs">-</span>
          <input type="number" name="max_price" placeholder="Máx" value="<?php echo esc_attr($current_max); ?>" class="w-20 text-xs px-2 py-1.5 bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-[#74A626]" />
          <button type="submit" class="p-1.5 px-2 bg-[#74A626] hover:bg-[#5E891C] text-white rounded-lg text-xs transition-colors flex-shrink-0" title="Aplicar precio">
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
          </button>
        </form>
      </div>

      <!-- 3. Ratings (Estrellas / Calificación) -->
      <div class="filter-group pt-4 border-t border-slate-200">
        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2.5">Calificación</h4>
        <ul class="space-y-1 text-xs">
          <?php 
            $ratings = [
              ['val' => '5', 'label' => '5 estrellas', 'stars' => 5],
              ['val' => '4', 'label' => '4 estrellas o más', 'stars' => 4],
              ['val' => '3', 'label' => '3 estrellas o más', 'stars' => 3],
            ];
          ?>
          <?php foreach ($ratings as $r): ?>
            <?php 
              $is_r_active = ($current_rating === $r['val']);
              $r_url = $is_r_active ? remove_query_arg('rating') : add_query_arg(['rating' => $r['val'], 'paged' => false]);
            ?>
            <li>
              <a href="<?php echo esc_url($r_url); ?>" class="flex items-center gap-2 py-1.5 px-2.5 rounded-lg transition-colors <?php echo $is_r_active ? 'bg-[#74A626]/10 text-[#74A626] font-bold' : 'text-slate-700 hover:bg-slate-100'; ?>">
                <div class="flex text-amber-400 text-[11px] gap-0.5">
                  <?php for ($s = 1; $s <= 5; $s++): ?>
                    <i class="<?php echo $s <= $r['stars'] ? 'fa-solid' : 'fa-regular'; ?> fa-star"></i>
                  <?php endfor; ?>
                </div>
                <span class="text-xs <?php echo $is_r_active ? 'font-bold text-[#74A626]' : ''; ?>"><?php echo esc_html($r['label']); ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- 4. Authors (Autores Jurídicos) -->
      <?php if (!empty($authors)): ?>
        <div class="filter-group pt-4 border-t border-slate-200">
          <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2.5">Autor Jurídico</h4>
          <div class="space-y-1 max-h-48 overflow-y-auto pr-1">
            <?php foreach ($authors as $auth): ?>
              <?php 
                $is_a_active = ($current_author === $auth);
                $a_url = $is_a_active ? remove_query_arg('author_name') : add_query_arg(['author_name' => $auth, 'paged' => false]);
              ?>
              <a href="<?php echo esc_url($a_url); ?>" class="flex items-center gap-2 py-1.5 px-2.5 text-xs rounded-lg transition-colors <?php echo $is_a_active ? 'bg-[#74A626] text-white font-bold shadow-xs' : 'text-slate-700 hover:bg-slate-100 hover:text-[#74A626]'; ?>">
                <i class="fa-regular <?php echo $is_a_active ? 'fa-circle-check' : 'fa-circle'; ?> text-[10px]"></i>
                <span class="truncate flex-1 min-w-0"><?php echo esc_html($auth); ?></span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

      <!-- 5. Year / Novedades -->
      <div class="filter-group pt-4 border-t border-slate-200">
        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2.5">Año de Edición</h4>
        <div class="flex flex-wrap gap-1.5">
          <?php foreach (['2026', '2025', '2024'] as $yr): ?>
            <?php 
              $is_y_active = ($current_year === $yr);
              $y_url = $is_y_active ? remove_query_arg('book_year') : add_query_arg(['book_year' => $yr, 'paged' => false]);
            ?>
            <a href="<?php echo esc_url($y_url); ?>" class="px-2.5 py-1 text-xs rounded-full border transition-colors <?php echo $is_y_active ? 'bg-[#74A626] text-white border-[#74A626] font-bold shadow-xs' : 'bg-white text-slate-700 border-slate-300 hover:border-[#74A626] hover:text-[#74A626]'; ?>">
              <?php echo esc_html($yr); ?> <?php echo $yr === '2026' ? '🔥' : ''; ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- 6. Special Offers Toggle -->
      <div class="filter-group pt-4 border-t border-slate-200">
        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2.5">Ofertas</h4>
        <?php 
          $sale_url = !empty($current_sale) ? remove_query_arg('on_sale') : add_query_arg(['on_sale' => '1', 'paged' => false]);
        ?>
        <a href="<?php echo esc_url($sale_url); ?>" class="flex items-center gap-2 py-2 px-3 text-xs rounded-lg transition-colors <?php echo !empty($current_sale) ? 'bg-amber-500 text-white font-bold shadow-xs' : 'text-slate-700 bg-slate-50 hover:bg-slate-100'; ?>">
          <i class="fa-solid fa-tag <?php echo !empty($current_sale) ? 'text-white' : 'text-amber-500'; ?>"></i>
          <span>Solo libros con descuento</span>
        </a>
      </div>

    </div>
    <?php
}

/**
 * Render Desktop Sidebar Filters
 */
function limaeditores_render_filters_sidebar() {
    ?>
    <aside class="w-full">
      <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-200">
        <h3 class="font-bold text-base text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-sliders text-[#74A626]"></i> Filtros
        </h3>
        <?php if (!empty($_GET['min_price']) || !empty($_GET['max_price']) || !empty($_GET['rating']) || !empty($_GET['author_name']) || !empty($_GET['book_year']) || !empty($_GET['on_sale'])): ?>
          <a href="<?php echo esc_url(remove_query_arg(['min_price', 'max_price', 'rating', 'author_name', 'book_year', 'on_sale', 'paged'])); ?>" class="text-xs font-bold text-[#74A626] hover:underline">
            Borrar filtros
          </a>
        <?php endif; ?>
      </div>
      <?php limaeditores_render_filter_elements(); ?>
    </aside>
    <?php
}

/**
 * Render Mobile Slide-Over Filter Drawer & Trigger Bar
 */
function limaeditores_render_mobile_filter_bar($total_count = 0) {
    $active_count = 0;
    foreach (['min_price', 'max_price', 'rating', 'author_name', 'book_year', 'on_sale'] as $key) {
        if (!empty($_GET[$key])) $active_count++;
    }
    ?>
    <!-- Mobile Filter Trigger Bar (Visible only on mobile / tablets) -->
    <div class="lg:hidden flex items-center justify-between gap-3 mb-4 p-3 bg-white rounded-xl border border-slate-200 shadow-xs">
      <button type="button" id="open-mobile-filters-btn" class="flex-1 flex items-center justify-center gap-2 py-2 px-4 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs rounded-lg transition-colors">
        <i class="fa-solid fa-sliders text-[#74A626]"></i>
        <span>Filtros y Materias</span>
        <?php if ($active_count > 0): ?>
          <span class="bg-[#74A626] text-white text-[10px] px-1.5 py-0.5 rounded-full font-extrabold"><?php echo $active_count; ?></span>
        <?php endif; ?>
      </button>

      <div class="flex-1">
        <?php 
          $current_sort = $_GET['orderby'] ?? 'menu_order';
          $options = [
              'menu_order' => 'Más relevantes',
              'price'      => 'Menor precio',
              'price-desc' => 'Mayor precio',
              'rating'     => 'Mejor calificados',
              'date'       => 'Más recientes',
          ];
        ?>
        <select onchange="location = this.value;" class="w-full text-xs font-bold bg-slate-100 border border-slate-200 rounded-lg px-3 py-2 text-slate-800 focus:outline-none focus:border-[#74A626] cursor-pointer">
          <?php foreach ($options as $key => $name): ?>
            <?php $url = add_query_arg(['orderby' => $key, 'paged' => false]); ?>
            <option value="<?php echo esc_url($url); ?>" <?php selected($current_sort, $key); ?>>
              <?php echo esc_html($name); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <!-- Mobile Slide-over Off-canvas Drawer Modal -->
    <div id="mobile-filter-drawer" class="fixed inset-0 z-[9999] hidden">
      <!-- Backdrop -->
      <div id="close-mobile-filters-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity"></div>
      
      <!-- Drawer Body -->
      <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
        <div class="w-screen max-w-sm bg-white shadow-2xl flex flex-col h-full">
          
          <!-- Drawer Header -->
          <div class="px-5 py-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
            <h3 class="font-bold text-base text-slate-900 flex items-center gap-2">
              <i class="fa-solid fa-sliders text-[#74A626]"></i> Filtros de Búsqueda
            </h3>
            <button type="button" id="close-mobile-filters-btn" class="p-2 text-slate-500 hover:text-slate-800 rounded-lg" aria-label="Cerrar filtros">
              <i class="fa-solid fa-xmark text-lg"></i>
            </button>
          </div>

          <!-- Drawer Scrollable Content -->
          <div class="flex-1 overflow-y-auto p-5">
            <?php limaeditores_render_filter_elements(); ?>
          </div>

          <!-- Drawer Footer -->
          <div class="p-4 bg-slate-50 border-t border-slate-200 flex items-center gap-3">
            <?php if ($active_count > 0): ?>
              <a href="<?php echo esc_url(remove_query_arg(['min_price', 'max_price', 'rating', 'author_name', 'book_year', 'on_sale', 'paged'])); ?>" class="flex-1 text-center py-2.5 px-3 bg-white border border-slate-300 text-slate-700 font-bold text-xs rounded-xl hover:bg-slate-100 transition-colors">
                Borrar todo
              </a>
            <?php endif; ?>
            <button type="button" id="close-mobile-filters-apply" class="flex-1 py-2.5 px-4 bg-[#74A626] hover:bg-[#5E891C] text-white font-bold text-xs rounded-xl shadow-xs transition-colors">
              Ver resultados
            </button>
          </div>

        </div>
      </div>
    </div>
    <?php
}

/**
 * Render Desktop Sorting Dropdown Toolbar (MercadoLibre Style)
 */
function limaeditores_render_sorting_bar($total_count = 0) {
    $current_sort = $_GET['orderby'] ?? 'menu_order';
    $options = [
        'menu_order' => 'Más relevantes',
        'price'      => 'Menor precio',
        'price-desc' => 'Mayor precio',
        'rating'     => 'Mejor calificados',
        'date'       => 'Más recientes',
    ];
    ?>
    <div class="hidden lg:flex items-center justify-between gap-3 pb-4 mb-4 border-b border-slate-200">
      <div class="text-sm font-semibold text-slate-800">
        <span class="text-slate-500 font-normal">Mostrando</span> 
        <span class="font-bold text-[#1C2518]"><?php echo intval($total_count); ?></span> 
        <span class="text-slate-500 font-normal">obras jurídicas</span>
      </div>

      <div class="flex items-center gap-2 text-xs">
        <span class="text-slate-500 font-medium">Ordenar por:</span>
        <div class="relative">
          <select onchange="location = this.value;" class="text-xs font-bold bg-white border border-slate-300 rounded-lg px-3 py-1.5 pr-8 text-slate-800 focus:outline-none focus:border-[#74A626] cursor-pointer shadow-xs">
            <?php foreach ($options as $key => $name): ?>
              <?php $url = add_query_arg(['orderby' => $key, 'paged' => false]); ?>
              <option value="<?php echo esc_url($url); ?>" <?php selected($current_sort, $key); ?>>
                <?php echo esc_html($name); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>
    <?php
}
