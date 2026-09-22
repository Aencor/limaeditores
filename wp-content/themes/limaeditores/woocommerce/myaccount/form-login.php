<?php
/**
 * Login Form Template for Lima Editores
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_customer_login_form');

$is_registration_enabled = ('yes' === get_option('woocommerce_enable_myaccount_registration'));
?>

<div class="lima-login-wrapper max-w-5xl mx-auto py-2 sm:py-4">

  <!-- Header Intro -->
  <div class="text-center max-w-xl mx-auto mb-8 sm:mb-10">
    <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-[#74A626]/10 text-[#74A626] text-xl mb-3">
      <i class="fa-solid fa-user-shield"></i>
    </div>
    <h1 class="font-serif text-2xl sm:text-3xl font-bold text-slate-900">
      Mi Cuenta en Lima Editores
    </h1>
    <p class="text-xs sm:text-sm text-slate-500 mt-1.5">
      Gestiona tus pedidos de libros jurídicos, direcciones de entrega y descargas digitales.
    </p>
  </div>

  <div class="grid grid-cols-1 <?php echo $is_registration_enabled ? 'lg:grid-cols-2 gap-8' : 'max-w-md mx-auto'; ?> items-stretch" id="customer_login">
    
    <!-- Columna 1: Iniciar Sesión -->
    <div class="u-column1 bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 md:p-10 shadow-sm flex flex-col justify-between hover:border-slate-300 transition-all">
      <div>
        <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#74A626]/10 text-[#74A626] flex items-center justify-center text-base flex-shrink-0">
              <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </div>
            <div>
              <span class="text-[10px] uppercase font-bold tracking-wider text-[#74A626]">Clientes Registrados</span>
              <h2 class="font-serif font-bold text-xl text-slate-900 leading-tight">Acceder</h2>
            </div>
          </div>
        </div>

        <form class="woocommerce-form woocommerce-form-login login space-y-4" method="post">

          <?php do_action('woocommerce_login_form_start'); ?>

          <div class="woocommerce-form-row form-row">
            <label for="username" class="block text-xs font-bold text-slate-700 mb-1.5">
              Usuario o correo electrónico <span class="text-rose-500">*</span>
            </label>
            <div class="relative">
              <input type="text" class="w-full min-h-[48px] px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" placeholder="ejemplo@abogado.com" required aria-required="true" />
            </div>
          </div>

          <div class="woocommerce-form-row form-row">
            <div class="flex items-center justify-between mb-1.5">
              <label for="password" class="block text-xs font-bold text-slate-700">
                Contraseña <span class="text-rose-500">*</span>
              </label>
            </div>
            <div class="relative">
              <input class="w-full min-h-[48px] px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 focus:bg-white focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" type="password" name="password" id="password" autocomplete="current-password" placeholder="••••••••" required aria-required="true" />
            </div>
          </div>

          <?php do_action('woocommerce_login_form'); ?>

          <div class="flex items-center justify-between text-xs pt-1 pb-2">
            <label class="inline-flex items-center gap-2 cursor-pointer select-none text-slate-600 hover:text-slate-900">
              <input class="rounded border-slate-300 text-[#74A626] focus:ring-[#74A626] w-4 h-4" name="rememberme" type="checkbox" id="rememberme" value="forever" />
              <span>Recordarme</span>
            </label>
            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="font-semibold text-slate-500 hover:text-[#74A626] transition-colors underline">
              ¿Olvidaste tu contraseña?
            </a>
          </div>

          <div class="pt-2">
            <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
            <button type="submit" class="w-full min-h-[50px] py-3.5 px-6 bg-[#74A626] hover:bg-[#5E891C] text-white font-extrabold text-sm rounded-xl shadow-md transition-all hover:-translate-y-0.5 cursor-pointer flex items-center justify-center gap-2" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>">
              <i class="fa-solid fa-arrow-right-to-bracket"></i> Iniciar Sesión
            </button>
          </div>

          <?php do_action('woocommerce_login_form_end'); ?>

        </form>
      </div>
    </div>

    <!-- Columna 2: Crear Cuenta -->
    <?php if ($is_registration_enabled): ?>
      <div class="u-column2 bg-slate-50/80 border border-emerald-200 rounded-2xl p-6 sm:p-8 md:p-10 shadow-sm flex flex-col justify-between hover:border-emerald-300 transition-all">
        <div>
          <div class="flex items-center justify-between pb-4 mb-6 border-b border-emerald-100">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-emerald-600/10 text-emerald-700 flex items-center justify-center text-base flex-shrink-0">
                <i class="fa-solid fa-user-plus"></i>
              </div>
              <div>
                <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-700">Nuevos Clientes</span>
                <h2 class="font-serif font-bold text-xl text-slate-900 leading-tight">Crear Cuenta</h2>
              </div>
            </div>
          </div>

          <form method="post" class="woocommerce-form woocommerce-form-register register space-y-4" <?php do_action('woocommerce_register_form_tag'); ?>>

            <?php do_action('woocommerce_register_form_start'); ?>

            <?php if ('no' === get_option('woocommerce_registration_generate_username')): ?>
              <div class="woocommerce-form-row form-row">
                <label for="reg_username" class="block text-xs font-bold text-slate-700 mb-1.5">
                  Nombre de usuario <span class="text-rose-500">*</span>
                </label>
                <input type="text" class="w-full min-h-[48px] px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" placeholder="Tu nombre de usuario" required aria-required="true" />
              </div>
            <?php endif; ?>

            <div class="woocommerce-form-row form-row">
              <label for="reg_email" class="block text-xs font-bold text-slate-700 mb-1.5">
                Correo electrónico <span class="text-rose-500">*</span>
              </label>
              <input type="email" class="w-full min-h-[48px] px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" placeholder="tu@correo.com" required aria-required="true" />
            </div>

            <?php if ('no' === get_option('woocommerce_registration_generate_password')): ?>
              <div class="woocommerce-form-row form-row">
                <label for="reg_password" class="block text-xs font-bold text-slate-700 mb-1.5">
                  Contraseña <span class="text-rose-500">*</span>
                </label>
                <input type="password" class="w-full min-h-[48px] px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm text-slate-900 focus:outline-none focus:border-[#74A626] focus:ring-2 focus:ring-[#74A626]/20 transition-all" name="password" id="reg_password" autocomplete="new-password" placeholder="Crea una contraseña segura" required aria-required="true" />
              </div>
            <?php else: ?>
              <div class="p-3.5 bg-emerald-50 border border-emerald-200 rounded-xl text-xs text-emerald-800 flex items-start gap-2.5">
                <i class="fa-solid fa-circle-info text-emerald-600 mt-0.5"></i>
                <p>Se enviará un enlace para generar tu contraseña a tu correo electrónico.</p>
              </div>
            <?php endif; ?>

            <?php do_action('woocommerce_register_form'); ?>

            <div class="pt-2">
              <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
              <button type="submit" class="w-full min-h-[50px] py-3.5 px-6 bg-slate-900 hover:bg-black text-white font-extrabold text-sm rounded-xl shadow-md transition-all hover:-translate-y-0.5 cursor-pointer flex items-center justify-center gap-2" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>">
                <i class="fa-solid fa-user-plus"></i> Crear Cuenta / Registrarse
              </button>
            </div>

            <?php do_action('woocommerce_register_form_end'); ?>

          </form>
        </div>
      </div>
    <?php endif; ?>

  </div>

</div>

<?php do_action('woocommerce_after_customer_login_form'); ?>
