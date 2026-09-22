<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/favicon.svg">
  <link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/favicon.png">
  <?php wp_head(); ?>
</head>

<body <?php body_class('bg-slate-50 text-slate-900 font-sans antialiased min-h-screen flex flex-col justify-between'); ?>>
<?php wp_body_open(); ?>

<header class="w-full sticky top-0 z-50 bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-200">
  <!-- Top announcement bar -->
  <div class="bg-[#1C2518] text-slate-300 text-xs py-2 px-4 border-b border-[#2C3E20]">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
      <div class="flex items-center gap-4">
        <span><i class="fa-solid fa-scale-balanced text-[#C4D626] mr-1.5"></i> Editorial Jurídica Especializada</span>
        <span class="hidden md:inline text-slate-600">|</span>
        <span class="hidden md:inline"><i class="fa-solid fa-truck-fast text-slate-400 mr-1"></i> Envíos a todo el país para estudios y magistrados</span>
      </div>
      <div class="flex items-center gap-4">
        <a href="https://wa.me/51999999999" target="_blank" class="hover:text-[#C4D626] transition-colors flex items-center gap-1">
          <i class="fa-brands fa-whatsapp text-[#74A626]"></i> Pedidos y Consultas
        </a>
        <span class="text-slate-600">|</span>
        <a href="<?php echo function_exists('wc_get_account_endpoint_url') ? esc_url(wc_get_account_endpoint_url('dashboard')) : home_url('/mi-cuenta'); ?>" class="hover:text-white transition-colors flex items-center gap-1">
          <i class="fa-regular fa-user"></i> Mi Cuenta
        </a>
      </div>
    </div>
  </div>

  <!-- Main header container -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
    <div class="flex items-center justify-between gap-4">
      
      <!-- Brand Logo Vector -->
      <div class="flex items-center gap-3">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center group transition-transform hover:opacity-95" title="Lima Editores - Editorial & Librería">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logos/logo.svg" 
               alt="<?php bloginfo('name'); ?> - Editorial Jurídica" 
               class="h-11 sm:h-12 w-auto object-contain" />
        </a>
      </div>

      <!-- Search Bar with Live Autocomplete -->
      <div class="hidden lg:flex flex-1 max-w-xl mx-6 relative">
        <form role="search" method="get" class="w-full flex items-center relative js-ajax-search-form" action="<?php echo esc_url(home_url('/')); ?>">
          <div class="relative w-full">
            <input type="search" 
                   name="s" 
                   value="<?php echo get_search_query(); ?>" 
                   placeholder="Buscar por libro, autor (ej. Roxin, Ferrajoli), ISBN, código..." 
                   autocomplete="off"
                   class="w-full pl-10 pr-24 py-2 text-sm bg-slate-100 border border-slate-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#74A626] focus:bg-white transition-all shadow-inner js-ajax-search-input" />
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 js-search-icon">
              <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="absolute inset-y-0 right-24 flex items-center pr-2 hidden js-search-spinner">
              <i class="fa-solid fa-circle-notch fa-spin text-[#74A626] text-sm"></i>
            </div>
            <input type="hidden" name="post_type" value="product" />
            <button type="submit" class="absolute right-1 top-1 bottom-1 px-4 bg-[#74A626] hover:bg-[#5E891C] text-white text-xs font-bold rounded-full transition-colors shadow-sm">
              Buscar
            </button>
            <div class="js-search-results-container absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden z-50 hidden transition-all duration-200 max-h-[460px] overflow-y-auto"></div>
          </div>
        </form>
      </div>

      <!-- Action Icons (User Account, Cart, Mobile Menu Toggle) -->
      <div class="flex items-center gap-2 sm:gap-4">
        
        <!-- User Account Button (Mi Cuenta / Login) -->
        <a href="<?php echo function_exists('wc_get_account_endpoint_url') ? esc_url(wc_get_account_endpoint_url('dashboard')) : home_url('/mi-cuenta'); ?>" class="flex items-center gap-2 text-slate-800 hover:text-[#74A626] p-1.5 sm:p-2 rounded-xl hover:bg-slate-100 transition-all group" title="Mi Cuenta / Iniciar Sesión">
          <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center group-hover:border-[#74A626] group-hover:bg-[#74A626]/10 transition-all flex-shrink-0">
            <?php if (is_user_logged_in()): ?>
              <img src="<?php echo esc_url(get_avatar_url(get_current_user_id(), ['size' => 80])); ?>" alt="Usuario" class="w-full h-full object-cover" />
            <?php else: ?>
              <i class="fa-regular fa-user text-lg text-[#1C2518] group-hover:text-[#74A626]"></i>
            <?php endif; ?>
          </div>
          <div class="hidden sm:block text-left">
            <span class="text-[11px] text-slate-500 block leading-none">
              <?php echo is_user_logged_in() ? 'Hola, ' . esc_html(wp_get_current_user()->display_name) : 'Bienvenido'; ?>
            </span>
            <span class="text-xs font-bold text-slate-900 block group-hover:text-[#74A626] mt-0.5">
              <?php echo is_user_logged_in() ? 'Mi Cuenta' : 'Ingresar / Registro'; ?>
            </span>
          </div>
        </a>

        <!-- Cart Button -->
        <?php if (function_exists('WC')): ?>
          <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="relative flex items-center gap-2.5 text-slate-800 hover:text-[#74A626] p-1.5 sm:p-2 rounded-xl hover:bg-slate-100 transition-all group" title="Ver Carrito">
            <div class="relative w-10 h-10 rounded-full bg-[#1C2518]/5 border border-slate-200 flex items-center justify-center group-hover:bg-[#74A626]/10 group-hover:border-[#74A626] transition-all flex-shrink-0">
              <i class="fa-solid fa-bag-shopping text-xl text-[#1C2518] group-hover:text-[#74A626] group-hover:scale-110 transition-transform"></i>
              <span id="limaeditores-cart-count" class="absolute -top-1.5 -right-1.5 bg-[#74A626] text-white text-[11px] font-bold px-1.5 py-0.5 rounded-full min-w-[20px] text-center shadow-xs">
                <?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
              </span>
            </div>
            <div class="hidden sm:block text-left">
              <span class="text-[11px] text-slate-500 block leading-none">Carrito</span>
              <span class="text-xs font-bold text-slate-900 block group-hover:text-[#74A626] mt-0.5"><?php echo WC()->cart ? WC()->cart->get_cart_total() : '$0.00'; ?></span>
            </div>
          </a>
        <?php endif; ?>

        <!-- Mobile Menu Button -->
        <button type="button" id="mobile-menu-btn" class="lg:hidden p-2 text-slate-700 hover:text-[#74A626] focus:outline-none rounded-lg hover:bg-slate-100" aria-label="Abrir menú">
          <i class="fa-solid fa-bars-staggered text-xl"></i>
        </button>
      </div>

    </div>
  </div>

  <!-- Secondary Navigation Bar (Legal Branches) -->
  <nav class="hidden lg:block bg-[#F8FAF3] border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <ul class="flex items-center space-x-6 text-xs font-semibold text-slate-700 py-2.5 overflow-x-auto">
        <li>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#74A626] flex items-center gap-1.5 transition-colors">
            <i class="fa-solid fa-house text-[#74A626]"></i> Inicio
          </a>
        </li>
        <li>
          <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url(wc_get_page_permalink('shop')) : home_url('/tienda'); ?>" class="hover:text-[#74A626] transition-colors">
            Catálogo Completo
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-penal')); ?>" class="hover:text-[#74A626] transition-colors">
            Derecho Penal
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-civil')); ?>" class="hover:text-[#74A626] transition-colors">
            Derecho Civil
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-procesal')); ?>" class="hover:text-[#74A626] transition-colors">
            Derecho Procesal
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-constitucional')); ?>" class="hover:text-[#74A626] transition-colors">
            Constitucional
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-corporativo')); ?>" class="hover:text-[#74A626] transition-colors">
            Corporativo & Tributario
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/novedades')); ?>" class="text-[#74A626] font-bold hover:text-[#5E891C] transition-colors flex items-center gap-1">
            <i class="fa-solid fa-sparkles text-[#C4D626]"></i> Novedades Editoriales
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Mobile Drawer Menu -->
  <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-slate-200 px-4 py-4 space-y-3">
    <form role="search" method="get" class="w-full mb-3 js-ajax-search-form relative" action="<?php echo esc_url(home_url('/')); ?>">
      <div class="relative">
        <input type="search" name="s" autocomplete="off" placeholder="Buscar libros jurídicos..." class="w-full pl-9 pr-9 py-2 text-sm bg-slate-100 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#74A626] focus:bg-white js-ajax-search-input" />
        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-slate-400 js-search-icon"></i>
        <div class="absolute right-3 top-2.5 hidden js-search-spinner">
          <i class="fa-solid fa-circle-notch fa-spin text-[#74A626] text-sm"></i>
        </div>
        <input type="hidden" name="post_type" value="product" />
        <div class="js-search-results-container absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-2xl border border-slate-200 overflow-hidden z-50 hidden transition-all duration-200 max-h-80 overflow-y-auto"></div>
      </div>
    </form>
    <div class="space-y-1 text-sm font-medium text-slate-700">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="block px-3 py-2 rounded-md hover:bg-slate-100">Inicio</a>
      <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url(wc_get_page_permalink('shop')) : home_url('/tienda'); ?>" class="block px-3 py-2 rounded-md hover:bg-slate-100">Catálogo General</a>
      <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-penal')); ?>" class="block px-3 py-2 rounded-md hover:bg-slate-100">Derecho Penal</a>
      <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-civil')); ?>" class="block px-3 py-2 rounded-md hover:bg-slate-100">Derecho Civil</a>
      <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-procesal')); ?>" class="block px-3 py-2 rounded-md hover:bg-slate-100">Derecho Procesal</a>
      <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-constitucional')); ?>" class="block px-3 py-2 rounded-md hover:bg-slate-100">Derecho Constitucional</a>
      <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="block px-3 py-2 rounded-md hover:bg-slate-100">Contacto & Envíos</a>
    </div>
  </div>
</header>