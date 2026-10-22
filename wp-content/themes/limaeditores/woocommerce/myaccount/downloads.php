<?php
/**
 * Downloads - My Account
 *
 * Shows downloads on the account page for Lima Editores.
 *
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$downloads     = WC()->customer ? WC()->customer->get_downloadable_products() : [];
$has_downloads = (bool) $downloads;

do_action('woocommerce_before_account_downloads', $has_downloads); ?>

<div class="lima-myaccount-downloads-section">
    <!-- Header Banner -->
    <div class="mb-8 p-6 bg-gradient-to-r from-[#1C2518] to-[#2E3D27] rounded-2xl text-white shadow-lg flex flex-col sm:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-4 text-center sm:text-left">
            <div class="w-14 h-14 rounded-2xl bg-[#74A626]/20 border border-[#C4D626]/30 flex items-center justify-center text-[#C4D626] text-2xl shrink-0 shadow-inner">
                <i class="fa-solid fa-file-pdf"></i>
            </div>
            <div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#C4D626]/20 text-[#C4D626] border border-[#C4D626]/30 mb-1">
                    <i class="fa-solid fa-book-bookmark"></i> Biblioteca Digital
                </div>
                <h2 class="text-xl font-bold font-serif text-white">Descargas Jurídicas Disponibles</h2>
                <p class="text-xs text-slate-300">
                    Consulta y descarga tus obras y compendios digitales autorizados en formato PDF de alta resolución.
                </p>
            </div>
        </div>

        <?php if ($has_downloads): ?>
            <div class="flex items-center gap-3 bg-white/10 px-4 py-2.5 rounded-xl border border-white/10 shrink-0">
                <i class="fa-solid fa-cloud-arrow-down text-[#C4D626] text-lg"></i>
                <div class="text-right">
                    <span class="text-lg font-extrabold text-[#C4D626] block leading-none"><?php echo count($downloads); ?></span>
                    <span class="text-[10px] text-slate-300 font-medium">Archivos disponibles</span>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($has_downloads): ?>
        <?php do_action('woocommerce_before_available_downloads'); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lima-downloads-grid">
            <?php foreach ($downloads as $download): 
                $product_id = $download['product_id'] ?? 0;
                $product    = $product_id ? wc_get_product($product_id) : null;
                $image_url  = $product ? wp_get_attachment_image_url($product->get_image_id(), 'medium') : '';
                $remaining  = is_numeric($download['downloads_remaining']) ? $download['downloads_remaining'] : __('Ilimitadas', 'limaeditores');
                $expires    = !empty($download['access_expires']) ? date_i18n(get_option('date_format'), strtotime($download['access_expires'])) : __('Acceso Permanente', 'limaeditores');
            ?>
                <div class="bg-white border border-slate-200 hover:border-[#74A626]/50 rounded-2xl p-6 shadow-xs hover:shadow-md transition-all flex flex-col justify-between lima-download-card group">
                    <div>
                        <!-- Top Badges & Product Row -->
                        <div class="flex items-start gap-4 mb-4">
                            <?php if ($image_url): ?>
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($download['product_name']); ?>" class="w-16 h-22 object-cover rounded-lg shadow-sm border border-slate-200 shrink-0" />
                            <?php else: ?>
                                <div class="w-16 h-22 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 border border-slate-200 shrink-0">
                                    <i class="fa-solid fa-book text-2xl text-slate-300"></i>
                                </div>
                            <?php endif; ?>

                            <div class="flex-1 min-w-0">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 mb-1.5">
                                    <i class="fa-solid fa-circle-check text-[9px]"></i> Licencia Activa
                                </span>
                                <h3 class="font-serif font-bold text-base text-slate-900 group-hover:text-[#74A626] transition-colors leading-snug line-clamp-2">
                                    <?php if (!empty($download['product_url'])): ?>
                                        <a href="<?php echo esc_url($download['product_url']); ?>" class="hover:underline">
                                            <?php echo esc_html($download['product_name']); ?>
                                        </a>
                                    <?php else: ?>
                                        <?php echo esc_html($download['product_name']); ?>
                                    <?php endif; ?>
                                </h3>
                                <p class="text-xs text-slate-500 mt-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-file-pdf text-rose-500"></i>
                                    <span class="font-medium text-slate-700"><?php echo esc_html($download['download_name']); ?></span>
                                </p>
                            </div>
                        </div>

                        <!-- Metadata Badges -->
                        <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 grid grid-cols-2 gap-2 text-xs text-slate-600 mb-5">
                            <div>
                                <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-semibold">Descargas</span>
                                <span class="font-bold text-slate-800 flex items-center gap-1 mt-0.5">
                                    <i class="fa-solid fa-infinity text-[10px] text-[#74A626]"></i> <?php echo esc_html($remaining); ?>
                                </span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-semibold">Vigencia</span>
                                <span class="font-bold text-slate-800 flex items-center gap-1 mt-0.5">
                                    <i class="fa-regular fa-clock text-[10px] text-slate-400"></i> <?php echo esc_html($expires); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Direct Download Button -->
                    <a href="<?php echo esc_url($download['download_url']); ?>" class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 bg-[#74A626] hover:bg-[#5E891C] text-white font-bold text-sm rounded-xl shadow-xs hover:shadow-md transition-all cursor-pointer">
                        <i class="fa-solid fa-cloud-arrow-down text-base"></i> Descargar Archivo (PDF)
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php do_action('woocommerce_after_available_downloads'); ?>

    <?php else: ?>
        <!-- Empty State -->
        <div class="p-10 bg-white border border-slate-200 rounded-2xl text-center shadow-xs">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <h3 class="font-serif font-bold text-lg text-slate-900 mb-2">No tienes descargas jurídicas activas</h3>
            <p class="text-sm text-slate-600 max-w-md mx-auto mb-6">
                Cuando adquieras obras en formato digital o libros con contenido descargable, aparecerán aquí para que los descargues en cualquier momento.
            </p>
            <a href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-[#74A626] hover:bg-[#5E891C] text-white font-bold text-sm rounded-xl shadow-xs transition-colors">
                <i class="fa-solid fa-book"></i> Explorar Catálogo Editorial
            </a>
        </div>
    <?php endif; ?>

    <?php do_action('woocommerce_after_account_downloads', $has_downloads); ?>
</div>
