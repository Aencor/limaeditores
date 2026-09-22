<?php
/**
 * Edit Account Form Template for Lima Editores
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form');
?>

<div class="max-w-4xl mx-auto space-y-6">

  <!-- 1. Dedicated Avatar Manager Card -->
  <?php 
  if (function_exists('limaeditores_render_avatar_section')) {
      limaeditores_render_avatar_section();
  } 
  ?>

  <!-- 2. Account Details Form -->
  <form class="woocommerce-EditAccountForm edit-account bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-xs space-y-8" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>

    <?php do_action('woocommerce_edit_account_form_start'); ?>

    <!-- Personal Info Section -->
    <div>
      <div class="pb-3 mb-5 border-b border-slate-100 flex items-center justify-between">
        <h3 class="font-serif font-bold text-base text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-user-pen text-[#74A626]"></i> Información Personal
        </h3>
        <span class="text-[11px] text-slate-400">Datos públicos y de contacto</span>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="woocommerce-form-row form-row">
          <label for="account_first_name" class="block text-xs font-bold text-slate-700 mb-1.5">
            Nombre(s)
          </label>
          <input type="text" class="w-full min-h-[46px] px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>" placeholder="Tus nombres" />
        </div>

        <div class="woocommerce-form-row form-row">
          <label for="account_last_name" class="block text-xs font-bold text-slate-700 mb-1.5">
            Apellidos
          </label>
          <input type="text" class="w-full min-h-[46px] px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" placeholder="Tus apellidos" />
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
        <div class="woocommerce-form-row form-row">
          <label for="account_display_name" class="block text-xs font-bold text-slate-700 mb-1.5">
            Nombre visible en el sitio <span class="text-rose-500">*</span>
          </label>
          <input type="text" class="w-full min-h-[46px] px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="account_display_name" id="account_display_name" value="<?php echo esc_attr($user->display_name); ?>" required />
          <p class="text-[11px] text-slate-400 mt-1">Cómo aparecerá tu nombre en tus valoraciones y panel.</p>
        </div>

        <div class="woocommerce-form-row form-row">
          <label for="account_email" class="block text-xs font-bold text-slate-700 mb-1.5">
            Correo electrónico <span class="text-rose-500">*</span>
          </label>
          <input type="email" class="w-full min-h-[46px] px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>" required />
        </div>
      </div>
    </div>

    <?php do_action('woocommerce_edit_account_form_fields'); ?>

    <!-- Password Change Section -->
    <div class="pt-2 border-t border-slate-100">
      <div class="pb-3 mb-5 border-b border-slate-100 flex items-center justify-between">
        <h3 class="font-serif font-bold text-base text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-lock text-[#74A626]"></i> Cambio de Contraseña
        </h3>
        <span class="text-[11px] text-slate-400">Opcional (deja en blanco si no deseas cambiarla)</span>
      </div>

      <div class="space-y-4">
        <div class="woocommerce-form-row form-row">
          <label for="password_current" class="block text-xs font-bold text-slate-700 mb-1.5">
            Contraseña actual
          </label>
          <input type="password" class="w-full min-h-[46px] px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="password_current" id="password_current" autocomplete="off" placeholder="••••••••" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="woocommerce-form-row form-row">
            <label for="password_1" class="block text-xs font-bold text-slate-700 mb-1.5">
              Nueva contraseña
            </label>
            <input type="password" class="w-full min-h-[46px] px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="password_1" id="password_1" autocomplete="off" placeholder="••••••••" />
          </div>

          <div class="woocommerce-form-row form-row">
            <label for="password_2" class="block text-xs font-bold text-slate-700 mb-1.5">
              Confirmar nueva contraseña
            </label>
            <input type="password" class="w-full min-h-[46px] px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="password_2" id="password_2" autocomplete="off" placeholder="••••••••" />
          </div>
        </div>
      </div>
    </div>

    <?php do_action('woocommerce_edit_account_form'); ?>

    <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
      <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
      <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#74A626] hover:bg-[#5E891C] text-white font-extrabold text-sm rounded-xl shadow-md transition-all hover:-translate-y-0.5 cursor-pointer flex items-center justify-center gap-2" name="save_account_details" value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>">
        <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios del Perfil
      </button>
      <input type="hidden" name="action" value="save_account_details" />
    </div>

    <?php do_action('woocommerce_edit_account_form_end'); ?>

  </form>

</div>

<?php do_action('woocommerce_after_edit_account_form'); ?>
