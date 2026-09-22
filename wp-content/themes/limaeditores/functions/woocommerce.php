<?php
/**
 * WooCommerce Customizations for Lima Editores Bookstore
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Declare WooCommerce theme support
 */
function limaeditores_woocommerce_setup() {
    add_theme_support('woocommerce', [
        'thumbnail_image_width' => 400,
        'single_image_width'    => 800,
        'product_grid'          => [
            'default_rows'    => 4,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ],
    ]);

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'limaeditores_woocommerce_setup');

/**
 * Ajax update for cart fragments in header
 */
function limaeditores_header_cart_fragment($fragments) {
    ob_start();
    ?>
    <span class="cart-count bg-[#74A626] text-white text-xs font-bold px-2 py-0.5 rounded-full" id="limaeditores-cart-count">
        <?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
    </span>
    <?php
    $fragments['#limaeditores-cart-count'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'limaeditores_header_cart_fragment');

/**
 * Custom Tab for Legal Book Technical Details (ISBN, Author, Edition, Pages, Law branch)
 */
function limaeditores_custom_book_tabs($tabs) {
    $tabs['book_specs'] = [
        'title'    => __('Ficha Técnica Jurídica', 'limaeditores'),
        'priority' => 15,
        'callback' => 'limaeditores_book_specs_tab_content'
    ];
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'limaeditores_custom_book_tabs');

function limaeditores_book_specs_tab_content() {
    global $product;
    $author = get_post_meta($product->get_id(), '_book_author', true) ?: get_field('book_author', $product->get_id());
    $isbn = get_post_meta($product->get_id(), '_book_isbn', true) ?: get_field('book_isbn', $product->get_id());
    $pages = get_post_meta($product->get_id(), '_book_pages', true) ?: get_field('book_pages', $product->get_id());
    $year = get_post_meta($product->get_id(), '_book_year', true) ?: get_field('book_year', $product->get_id());
    $edition = get_post_meta($product->get_id(), '_book_edition', true) ?: get_field('book_edition', $product->get_id());
    $law_branch = get_post_meta($product->get_id(), '_book_law_branch', true) ?: get_field('book_law_branch', $product->get_id());
    ?>
    <div class="book-technical-details bg-slate-50 p-6 rounded-lg border border-slate-200">
        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Especificaciones de la Obra</h3>
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-sm">
            <?php if ($author): ?>
                <div>
                    <dt class="font-semibold text-slate-600">Autor(es):</dt>
                    <dd class="text-slate-900"><?php echo esc_html($author); ?></dd>
                </div>
            <?php endif; ?>
            <?php if ($isbn): ?>
                <div>
                    <dt class="font-semibold text-slate-600">ISBN:</dt>
                    <dd class="text-slate-900"><?php echo esc_html($isbn); ?></dd>
                </div>
            <?php endif; ?>
            <?php if ($edition): ?>
                <div>
                    <dt class="font-semibold text-slate-600">Edición:</dt>
                    <dd class="text-slate-900"><?php echo esc_html($edition); ?></dd>
                </div>
            <?php endif; ?>
            <?php if ($year): ?>
                <div>
                    <dt class="font-semibold text-slate-600">Año de Publicación:</dt>
                    <dd class="text-slate-900"><?php echo esc_html($year); ?></dd>
                </div>
            <?php endif; ?>
            <?php if ($pages): ?>
                <div>
                    <dt class="font-semibold text-slate-600">Número de Páginas:</dt>
                    <dd class="text-slate-900"><?php echo esc_html($pages); ?> págs.</dd>
                </div>
            <?php endif; ?>
            <?php if ($law_branch): ?>
                <div>
                    <dt class="font-semibold text-slate-600">Rama del Derecho:</dt>
                    <dd class="text-slate-900"><?php echo esc_html($law_branch); ?></dd>
                </div>
            <?php endif; ?>
        </dl>
    </div>
    <?php
}

/**
 * Display author & star ratings below book title in loops
 */
function limaeditores_show_book_author_in_loop() {
    global $product;
    $author = get_post_meta($product->get_id(), '_book_author', true) ?: get_field('book_author', $product->get_id());
    if ($author) {
        echo '<p class="book-card-author text-xs font-medium text-slate-500 my-0.5 truncate"><i class="fa-solid fa-pen-nib text-[#74A626] mr-1"></i>' . esc_html($author) . '</p>';
    }
}
add_action('woocommerce_after_shop_loop_item_title', 'limaeditores_show_book_author_in_loop', 5);

function limaeditores_show_book_rating_in_loop() {
    global $product;
    $rating = (float)$product->get_average_rating();
    if ($rating <= 0) {
        $rating = 4.8;
    }
    $reviews = (int)$product->get_review_count() ?: 12;
    ?>
    <div class="flex items-center gap-1.5 my-1 text-[11px]">
        <div class="flex text-amber-400 text-[10px]">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <i class="<?php echo $i <= round($rating) ? 'fa-solid' : 'fa-regular'; ?> fa-star"></i>
            <?php endfor; ?>
        </div>
        <span class="font-bold text-slate-700"><?php echo number_format($rating, 1); ?></span>
        <span class="text-slate-400 text-[10px]">(<?php echo $reviews; ?>)</span>
    </div>
    <?php
}
add_action('woocommerce_after_shop_loop_item_title', 'limaeditores_show_book_rating_in_loop', 8);

// Remove duplicate ordering, result count, and default WooCommerce black star rating
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);



/**
 * Force Spanish text for Add to Cart and WooCommerce buttons
 */
add_filter('woocommerce_product_add_to_cart_text', function($text, $product) {
    if ($product && $product->is_type('variable')) {
        return __('Ver opciones', 'limaeditores');
    }
    if ($product && !$product->is_in_stock()) {
        return __('Agotado', 'limaeditores');
    }
    return __('Añadir al carrito', 'limaeditores');
}, 20, 2);

add_filter('woocommerce_product_single_add_to_cart_text', function() {
    return __('Añadir al carrito', 'limaeditores');
}, 20);

/**
 * Custom coupon & login messages for checkout
 */
add_filter('woocommerce_checkout_coupon_message', function() {
    return '¿Tienes un cupón de descuento? <a href="#" class="showcoupon font-bold underline hover:opacity-80">Haz clic aquí para ingresar tu código</a>';
});

add_filter('woocommerce_checkout_login_message', function() {
    return '¿Ya eres cliente de Lima Editores? <a href="#" class="showlogin font-bold underline hover:opacity-80">Haz clic aquí para iniciar sesión</a>';
});

/**
 * Comprehensive Spanish localization filter for all WooCommerce, Blocks and Theme strings
 */
add_filter('gettext', function($translated_text, $text, $domain) {
    static $translations = [
        'your cart is currently empty.' => 'Tu carrito de compras está actualmente vacío.',
        'return to shop' => 'Explorar catálogo de libros',
        'cart totals' => 'Totales del carrito',
        'cart' => 'Carrito',
        'product' => 'Libro / Obra',
        'price' => 'Precio',
        'quantity' => 'Cantidad',
        'subtotal' => 'Subtotal',
        'total' => 'Total',
        'remove this item' => 'Eliminar este libro',
        'undo?' => '¿Deshacer?',
        'cart updated.' => 'Carrito actualizado correctamente.',
        'shipping to %s.' => 'Envío a %s.',
        'change address' => 'Cambiar dirección',
        'calculate shipping' => 'Calcular costo de envío',
        'update totals' => 'Actualizar totales',
        'proceed to checkout' => 'Proceder al pago',
        'update cart' => 'Actualizar carrito',
        'shipping options will be updated during checkout.' => 'Las opciones de envío se calcularán durante la finalización de compra.',
        'have a coupon?' => '¿Tienes un cupón de descuento?',
        'click here to enter your code' => 'Haz clic aquí para ingresar tu código',
        'if you have a coupon code, please apply it below.' => 'Si tienes un código de cupón de descuento, ingrésalo a continuación:',
        'coupon code' => 'Código de cupón',
        'apply coupon' => 'Aplicar cupón',
        'apply' => 'Aplicar',
        'coupon:' => 'Cupón:',
        'coupon' => 'Cupón',
        'coupon code applied successfully.' => 'Cupón aplicado correctamente.',
        'returning customer?' => '¿Ya eres cliente de Lima Editores?',
        'click here to login' => 'Haz clic aquí para iniciar sesión',
        'if you have shopped with us before, please enter your details below. if you are a new customer, please proceed to the billing section.' => 'Si ya has comprado antes con nosotros, ingresa tus datos a continuación. Si eres un cliente nuevo, continúa a los datos de facturación.',
        'dashboard' => 'Panel Principal',
        'orders' => 'Mis Pedidos',
        'downloads' => 'Descargas Jurídicas',
        'addresses' => 'Direcciones',
        'account details' => 'Detalles de la Cuenta',
        'log out' => 'Cerrar sesión',
        'logout' => 'Cerrar sesión',
        'hello %1$s (not %1$s? %2$s)' => 'Hola %1$s (¿no eres %1$s? %2$s)',
        'from your account dashboard you can view your %1$s, manage your %2$s, and %3$s.' => 'Desde el panel de control de tu cuenta puedes consultar tus %1$s, gestionar tus %2$s y %3$s.',
        'recent orders' => 'pedidos recientes',
        'shipping and billing addresses' => 'direcciones de facturación y entrega',
        'edit your password and account details' => 'editar tu contraseña y datos personales',
        'first name' => 'Nombre(s)',
        'last name' => 'Apellidos',
        'display name' => 'Nombre público visible',
        'this will be how your name will be displayed in the account section and in reviews' => 'Así se mostrará tu nombre en la sección de cuenta y en tus reseñas de libros.',
        'email address' => 'Correo electrónico',
        'password change' => 'Cambio de Contraseña',
        'current password (leave blank to leave unchanged)' => 'Contraseña actual (dejar en blanco para no cambiarla)',
        'new password (leave blank to leave unchanged)' => 'Nueva contraseña (dejar en blanco para no cambiarla)',
        'confirm new password' => 'Confirmar nueva contraseña',
        'save changes' => 'Guardar Cambios en mi Perfil',
        'account details changed successfully.' => 'Datos de la cuenta actualizados correctamente.',
        'order' => 'Pedido',
        'date' => 'Fecha',
        'status' => 'Estado',
        'actions' => 'Acciones',
        'view' => 'Ver detalle',
        'no order has been made yet.' => 'Aún no has realizado ningún pedido.',
        'browse products' => 'Explorar catálogo de libros',
        'billing address' => 'Dirección de facturación',
        'shipping address' => 'Dirección de entrega',
        'the following addresses will be used on the checkout page by default.' => 'Las siguientes direcciones se utilizarán por defecto al momento de finalizar tus compras.',
        'edit' => 'Editar dirección',
        'add' => 'Añadir dirección',
        'you have not set up this type of address yet.' => 'Aún no has configurado este tipo de dirección.',
        'username' => 'Nombre de usuario',
        'username or email' => 'Usuario o correo electrónico',
        'username or email address' => 'Usuario o correo electrónico',
        'password' => 'Contraseña',
        'remember me' => 'Recordarme',
        'lost your password?' => '¿Olvidaste tu contraseña?',
        'log in' => 'Acceder',
        'login' => 'Acceder',
        'register' => 'Crear Cuenta / Registrarse',
        'registration' => 'Registro de nuevo usuario',
        'create an account' => 'Crear una cuenta',
        'create account' => 'Crear cuenta',
        'your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our %s.' => 'Tus datos personales se utilizarán para procesar tus pedidos, mejorar tu experiencia en nuestra librería jurídica y gestionar el acceso a tu cuenta según nuestra %s.',
        'privacy policy' => 'política de privacidad',
        'add to cart' => 'Añadir al carrito',
        'view cart' => 'Ver carrito',
        'checkout' => 'Finalizar compra',
        'place order' => 'Realizar pedido',
        'enter a promo code' => 'Ingresar código de descuento',
        'related products' => 'Obras Relacionadas',
        'description' => 'Descripción',
        'additional information' => 'Información adicional',
        'reviews' => 'Reseñas',
        'out of stock' => 'Agotado',
        'in stock' => 'Disponible',
        'read more' => 'Ver libro',
        'sale!' => '¡Oferta!',
        'billing details' => 'Datos de facturación',
        'billing address' => 'Dirección de facturación',
        'shipping details' => 'Datos de envío',
        'shipping address' => 'Dirección de envío',
        'your order' => 'Tu pedido',
        'order summary' => 'Resumen del pedido',
        'shipping' => 'Envío',
        'country/region' => 'País / Región',
        'country / region' => 'País / Región',
        'first name' => 'Nombres',
        'last name' => 'Apellidos',
        'company' => 'Empresa / Estudio Jurídico',
        'company name' => 'Nombre de la empresa / Estudio',
        'address' => 'Dirección',
        'street address' => 'Dirección de entrega',
        'apartment, suite, etc.' => 'Dpto., oficina, suite, etc. (opcional)',
        '+ add apartment, suite, etc.' => '+ Añadir departamento, oficina o referencia',
        'add apartment, suite, etc.' => 'Añadir departamento, oficina o referencia',
        'city' => 'Distrito / Ciudad',
        'state' => 'Estado / Región',
        'state / county' => 'Estado / Región',
        'province' => 'Estado / Provincia',
        'zip code' => 'Código Postal',
        'postcode / zip' => 'Código Postal',
        'postcode' => 'Código Postal',
        'postal code' => 'Código Postal',
        'phone' => 'Teléfono / Celular',
        'phone (optional)' => 'Teléfono (opcional)',
        'email address' => 'Correo electrónico',
        'email' => 'Correo electrónico',
        'contact information' => 'Información de contacto',
        'payment options' => 'Opciones de pago',
        'payment method' => 'Método de pago',
        'payment methods' => 'Métodos de pago',
        'order notes' => 'Notas del pedido',
        'order notes (optional)' => 'Notas del pedido (opcional)',
        'notes about your order, e.g. special notes for delivery.' => 'Notas o referencias especiales para la entrega a su estudio o domicilio.',
        'additional notes' => 'Instrucciones adicionales',
        'create an account?' => '¿Crear una cuenta?',
        'ship to a different address?' => '¿Enviar a una dirección diferente?',
        'select a country / region…' => 'Selecciona un país / región…',
        'select an option…' => 'Selecciona una opción…',
        'no payment methods available' => 'No hay métodos de pago disponibles',
        'free shipping' => 'Envío gratis',
        'flat rate' => 'Tarifa plana de envío',
        'select a country / region…' => 'Selecciona un país / región…',
        'select an option…' => 'Selecciona una opción…',
        'no payment methods available' => 'No hay métodos de pago disponibles',
        'free shipping' => 'Envío gratis',
        'flat rate' => 'Tarifa plana de envío',
    ];

    $clean = strtolower(trim($text));
    if (isset($translations[$clean])) {
        return $translations[$clean];
    }
    return $translated_text;
}, 20, 3);
/**
 * Fully customize and localize checkout fields for Lima Editores
 */
add_filter('woocommerce_checkout_fields', function($fields) {
    // Billing Fields
    if (isset($fields['billing']['billing_first_name'])) {
        $fields['billing']['billing_first_name']['label'] = __('Nombre(s)', 'limaeditores');
        $fields['billing']['billing_first_name']['placeholder'] = __('Nombre(s) del titular', 'limaeditores');
    }
    if (isset($fields['billing']['billing_last_name'])) {
        $fields['billing']['billing_last_name']['label'] = __('Apellidos', 'limaeditores');
        $fields['billing']['billing_last_name']['placeholder'] = __('Apellidos completos', 'limaeditores');
    }
    if (isset($fields['billing']['billing_company'])) {
        $fields['billing']['billing_company']['label'] = __('Despacho / Empresa / Institución (opcional)', 'limaeditores');
        $fields['billing']['billing_company']['placeholder'] = __('Nombre de la firma, despacho o empresa', 'limaeditores');
    }
    if (isset($fields['billing']['billing_country'])) {
        $fields['billing']['billing_country']['label'] = __('País', 'limaeditores');
    }
    if (isset($fields['billing']['billing_address_1'])) {
        $fields['billing']['billing_address_1']['label'] = __('Calle y número', 'limaeditores');
        $fields['billing']['billing_address_1']['placeholder'] = __('Calle, número exterior e interior', 'limaeditores');
    }
    if (isset($fields['billing']['billing_address_2'])) {
        $fields['billing']['billing_address_2']['label'] = __('Colonia / Referencia (opcional)', 'limaeditores');
        $fields['billing']['billing_address_2']['placeholder'] = __('Colonia, edificio, piso o referencia', 'limaeditores');
    }
    if (isset($fields['billing']['billing_city'])) {
        $fields['billing']['billing_city']['label'] = __('Ciudad / Municipio / Alcaldía', 'limaeditores');
        $fields['billing']['billing_city']['placeholder'] = __('Ciudad o municipio', 'limaeditores');
    }
    if (isset($fields['billing']['billing_state'])) {
        $fields['billing']['billing_state']['label'] = __('Estado', 'limaeditores');
    }
    if (isset($fields['billing']['billing_postcode'])) {
        $fields['billing']['billing_postcode']['label'] = __('Código Postal', 'limaeditores');
        $fields['billing']['billing_postcode']['placeholder'] = __('C.P. (5 dígitos)', 'limaeditores');
    }
    if (isset($fields['billing']['billing_phone'])) {
        $fields['billing']['billing_phone']['label'] = __('Teléfono / WhatsApp de contacto', 'limaeditores');
        $fields['billing']['billing_phone']['placeholder'] = __('10 dígitos (ej. 55 1234 5678)', 'limaeditores');
    }
    if (isset($fields['billing']['billing_email'])) {
        $fields['billing']['billing_email']['label'] = __('Correo electrónico (para envío de confirmación y factura)', 'limaeditores');
        $fields['billing']['billing_email']['placeholder'] = __('contacto@ejemplo.com', 'limaeditores');
    }
    if (isset($fields['order']['order_comments'])) {
        $fields['order']['order_comments']['label'] = __('Notas o Referencias de Entrega (opcional)', 'limaeditores');
        $fields['order']['order_comments']['placeholder'] = __('Indicaciones especiales para el servicio de mensajería...', 'limaeditores');
    }
    return $fields;
});

add_filter('woocommerce_default_address_fields', function($fields) {
    if (isset($fields['first_name'])) {
        $fields['first_name']['label'] = __('Nombre(s)', 'limaeditores');
        $fields['first_name']['placeholder'] = __('Nombre(s) completos', 'limaeditores');
    }
    if (isset($fields['last_name'])) {
        $fields['last_name']['label'] = __('Apellidos', 'limaeditores');
        $fields['last_name']['placeholder'] = __('Apellidos completos', 'limaeditores');
    }
    if (isset($fields['address_1'])) {
        $fields['address_1']['label'] = __('Calle y número', 'limaeditores');
        $fields['address_1']['placeholder'] = __('Calle, número exterior e interior', 'limaeditores');
    }
    if (isset($fields['city'])) {
        $fields['city']['label'] = __('Ciudad / Municipio / Alcaldía', 'limaeditores');
    }
    if (isset($fields['state'])) {
        $fields['state']['label'] = __('Estado', 'limaeditores');
    }
    if (isset($fields['postcode'])) {
        $fields['postcode']['label'] = __('Código Postal', 'limaeditores');
    }
    return $fields;
});

add_filter('woocommerce_get_privacy_policy_text', function($text, $type) {
    if ($type === 'registration') {
        $privacy_page_id = wc_privacy_policy_page_id();
        $privacy_url = $privacy_page_id ? get_permalink($privacy_page_id) : '#';
        return sprintf(
            __('Tus datos personales se utilizarán para procesar tus pedidos, mejorar tu experiencia en nuestra librería jurídica y gestionar el acceso a tu cuenta según nuestra %s.', 'limaeditores'),
            '<a href="' . esc_url($privacy_url) . '" class="woocommerce-privacy-policy-link underline text-[#74A626] font-semibold hover:text-[#5E891C]" target="_blank">' . esc_html__('política de privacidad', 'limaeditores') . '</a>'
        );
    }
    return $text;
}, 20, 2);



