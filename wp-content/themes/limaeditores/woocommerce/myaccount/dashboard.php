<?php
/**
 * My Account Dashboard Template for Lima Editores
 */

if (!defined('ABSPATH')) {
    exit;
}

$current_user = wp_get_current_user();
$allowed_html = [
    'a' => [
        'href' => [],
        'class' => [],
    ],
];
?>

<div class="space-y-6">

  <?php
  /**
   * My Account dashboard.
   *
   * @since 2.6.0
   */
  do_action('woocommerce_account_dashboard');
  ?>

  <!-- Welcome & Information Message -->
  <div class="p-6 bg-white border border-slate-200 rounded-2xl shadow-xs">
    <p class="text-sm text-slate-700 leading-relaxed">
      Hola <strong class="text-slate-900 font-bold"><?php echo esc_html($current_user->display_name); ?></strong> 
      (¿no eres <strong class="text-slate-900"><?php echo esc_html($current_user->display_name); ?></strong>? 
      <a href="<?php echo esc_url(wc_logout_url()); ?>" class="text-[#74A626] font-bold hover:underline">Cerrar sesión</a>).
    </p>
    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
      Desde el panel de control de tu cuenta de Lima Editores puedes gestionar tus pedidos recientes, actualizar tus direcciones de despacho a tu estudio o domicilio, y modificar tu foto de perfil y contraseña.
    </p>
  </div>

  <!-- Quick Access Action Cards Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    
    <!-- 1. Mis Pedidos -->
    <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" class="p-5 bg-white border border-slate-200 hover:border-[#74A626] rounded-2xl shadow-xs hover:shadow-md transition-all group flex items-start gap-4">
      <div class="w-12 h-12 rounded-xl bg-[#74A626]/10 text-[#74A626] flex items-center justify-center text-xl flex-shrink-0 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-box-open"></i>
      </div>
      <div>
        <h4 class="text-sm font-bold text-slate-900 group-hover:text-[#74A626] transition-colors">Mis Pedidos</h4>
        <p class="text-xs text-slate-500 mt-1">Revisa el estado de tus compras, seguimiento y comprobantes.</p>
      </div>
    </a>

    <!-- 2. Direcciones de Entrega -->
    <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>" class="p-5 bg-white border border-slate-200 hover:border-[#74A626] rounded-2xl shadow-xs hover:shadow-md transition-all group flex items-start gap-4">
      <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-xl flex-shrink-0 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-location-dot"></i>
      </div>
      <div>
        <h4 class="text-sm font-bold text-slate-900 group-hover:text-[#74A626] transition-colors">Direcciones de Despacho</h4>
        <p class="text-xs text-slate-500 mt-1">Administra tus domicilios y direcciones de entrega.</p>
      </div>
    </a>

    <!-- 3. Mi Perfil y Foto -->
    <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" class="p-5 bg-white border border-slate-200 hover:border-[#74A626] rounded-2xl shadow-xs hover:shadow-md transition-all group flex items-start gap-4">
      <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-600 flex items-center justify-center text-xl flex-shrink-0 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-user-pen"></i>
      </div>
      <div>
        <h4 class="text-sm font-bold text-slate-900 group-hover:text-[#74A626] transition-colors">Mi Perfil y Foto</h4>
        <p class="text-xs text-slate-500 mt-1">Sube tu foto de perfil, actualiza tus datos y contraseña.</p>
      </div>
    </a>

    <!-- 4. Explorar Tienda -->
    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="p-5 bg-white border border-slate-200 hover:border-[#74A626] rounded-2xl shadow-xs hover:shadow-md transition-all group flex items-start gap-4">
      <div class="w-12 h-12 rounded-xl bg-[#1C2518]/10 text-[#1C2518] flex items-center justify-center text-xl flex-shrink-0 group-hover:scale-110 transition-transform">
        <i class="fa-solid fa-book-bookmark"></i>
      </div>
      <div>
        <h4 class="text-sm font-bold text-slate-900 group-hover:text-[#74A626] transition-colors">Catálogo Jurídico</h4>
        <p class="text-xs text-slate-500 mt-1">Explora los últimos tratados, códigos y obras jurídicas.</p>
      </div>
    </a>

  </div>

</div>
