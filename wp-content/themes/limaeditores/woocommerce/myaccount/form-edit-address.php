<?php
/**
 * Edit Address Form Template for Lima Editores
 */

if (!defined('ABSPATH')) {
    exit;
}

$page_title = ('billing' === $load_address) ? esc_html__('Dirección de Facturación', 'limaeditores') : esc_html__('Dirección de Envío y Despacho', 'limaeditores');

do_action('woocommerce_before_edit_account_address_form'); ?>

<?php if (!$load_address): ?>
    <?php wc_get_template('myaccount/my-address.php'); ?>
<?php else: ?>

    <form method="post" class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-xs space-y-6">
        
        <div class="pb-4 border-b border-slate-200 flex items-center justify-between">
            <h3 class="font-serif font-bold text-lg text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-location-dot text-[#74A626]"></i> <?php echo esc_html($page_title); ?>
            </h3>
            <a href="<?php echo esc_url(wc_get_endpoint_url('edit-address')); ?>" class="text-xs font-bold text-slate-500 hover:text-[#74A626] transition-colors">
                &larr; Volver a direcciones
            </a>
        </div>

        <div class="woocommerce-address-fields">
            <?php do_action("woocommerce_before_edit_address_form_{$load_address}"); ?>

            <div class="woocommerce-address-fields__field-wrapper space-y-4">
                <?php
                foreach ($address as $key => $field) {
                    woocommerce_form_field($key, $field, wc_get_post_data_by_key($key, $field['value']));
                }
                ?>
            </div>

            <?php do_action("woocommerce_after_edit_address_form_{$load_address}"); ?>

            <div class="pt-6 mt-6 border-t border-slate-200">
                <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-[#74A626] hover:bg-[#5E891C] text-white font-extrabold text-sm rounded-xl shadow-md transition-all hover:-translate-y-0.5 cursor-pointer" name="save_address" value="<?php esc_attr_e('Guardar dirección', 'limaeditores'); ?>">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Guardar <?php echo esc_html($page_title); ?>
                </button>
                <?php wp_nonce_field('woocommerce-edit_address', 'woocommerce-edit-address-nonce'); ?>
                <input type="hidden" name="action" value="edit_address" />
            </div>
        </div>

    </form>

<?php endif; ?>

<?php do_action('woocommerce_after_edit_account_address_form'); ?>
