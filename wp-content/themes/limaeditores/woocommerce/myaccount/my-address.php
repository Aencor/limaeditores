<?php
/**
 * My Addresses Template for Lima Editores
 */

if (!defined('ABSPATH')) {
    exit;
}

$customer_id = get_current_user_id();

if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) {
    $get_addresses = apply_filters(
        'woocommerce_my_account_get_addresses',
        [
            'billing'  => __('Dirección de Facturación', 'limaeditores'),
            'shipping' => __('Dirección de Envío y Despacho', 'limaeditores'),
        ],
        $customer_id
    );
} else {
    $get_addresses = apply_filters(
        'woocommerce_my_account_get_addresses',
        [
            'billing' => __('Dirección de Facturación', 'limaeditores'),
        ],
        $customer_id
    );
}
?>

<div class="space-y-6">
  
  <div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl">
    <h3 class="font-bold text-base text-slate-900 flex items-center gap-2 mb-1">
      <i class="fa-solid fa-location-dot text-[#74A626]"></i> Direcciones de Entrega y Facturación
    </h3>
    <p class="text-xs text-slate-600">
      Las siguientes direcciones se utilizarán por defecto al momento de procesar y enviar tus pedidos de libros jurídicos.
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <?php foreach ($get_addresses as $name => $address_title): ?>
      <?php
        $address = wc_get_account_formatted_address($name);
        $edit_url = wc_get_endpoint_url('edit-address', $name);
        $is_billing = ($name === 'billing');
      ?>
      <div class="bg-white border-2 <?php echo $address ? 'border-slate-200' : 'border-dashed border-slate-300'; ?> rounded-2xl p-6 shadow-xs flex flex-col justify-between hover:border-[#74A626] transition-all">
        
        <div>
          <!-- Card Header -->
          <div class="flex items-center justify-between gap-3 pb-3 mb-4 border-b border-slate-100">
            <div class="flex items-center gap-2.5">
              <div class="w-9 h-9 rounded-xl <?php echo $is_billing ? 'bg-amber-500/10 text-amber-600' : 'bg-[#74A626]/10 text-[#74A626]'; ?> flex items-center justify-center text-sm flex-shrink-0">
                <i class="fa-solid <?php echo $is_billing ? 'fa-file-invoice-dollar' : 'fa-truck-fast'; ?>"></i>
              </div>
              <h4 class="font-serif font-bold text-slate-900 text-sm">
                <?php echo esc_html($address_title); ?>
              </h4>
            </div>

            <?php if ($address): ?>
              <a href="<?php echo esc_url($edit_url); ?>" class="inline-flex items-center gap-1 text-xs font-bold text-[#74A626] hover:text-[#5E891C] hover:underline">
                <i class="fa-solid fa-pen-to-square"></i> Editar
              </a>
            <?php endif; ?>
          </div>

          <!-- Address Body -->
          <div class="text-xs text-slate-600 leading-relaxed min-h-[70px]">
            <?php if ($address): ?>
              <div class="address-content space-y-1 font-medium text-slate-800">
                <?php echo wp_kses_post($address); ?>
              </div>
            <?php else: ?>
              <div class="py-3 text-slate-400 italic">
                <p>Aún no has registrado tu <?php echo strtolower($address_title); ?>.</p>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Action Button -->
        <div class="pt-4 mt-4 border-t border-slate-100">
          <?php if ($address): ?>
            <a href="<?php echo esc_url($edit_url); ?>" class="w-full py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs rounded-xl flex items-center justify-center gap-2 transition-colors">
              <i class="fa-solid fa-pen-to-square text-slate-500"></i> Modificar esta dirección
            </a>
          <?php else: ?>
            <a href="<?php echo esc_url($edit_url); ?>" class="w-full py-2.5 px-4 bg-[#74A626] hover:bg-[#5E891C] text-white font-bold text-xs rounded-xl flex items-center justify-center gap-2 shadow-xs transition-colors">
              <i class="fa-solid fa-plus"></i> Registrar <?php echo esc_html($address_title); ?>
            </a>
          <?php endif; ?>
        </div>

      </div>
    <?php endforeach; ?>
  </div>

</div>
