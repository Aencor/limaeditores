<?php
/**
 * Customer Account & Profile Photo Manager for Lima Editores
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Rename and reorder Account Menu Items in Spanish
add_filter('woocommerce_account_menu_items', 'limaeditores_custom_account_menu_items');
function limaeditores_custom_account_menu_items($items) {
    return [
        'dashboard'       => __('Panel Principal', 'limaeditores'),
        'orders'          => __('Mis Pedidos', 'limaeditores'),
        'downloads'       => __('Descargas Jurídicas', 'limaeditores'),
        'edit-address'    => __('Direcciones de Entrega', 'limaeditores'),
        'edit-account'    => __('Mi Perfil y Foto', 'limaeditores'),
        'customer-logout' => __('Cerrar Sesión', 'limaeditores'),
    ];
}

// 2. Make first/last name optional on profile save so photo & other edits don't get blocked
add_filter('woocommerce_save_account_details_required_fields', function($fields) {
    unset($fields['account_first_name']);
    unset($fields['account_last_name']);
    return $fields;
});

// 3. Custom Avatar Support (Hook into get_avatar)
add_filter('get_avatar_url', 'limaeditores_custom_avatar_url', 10, 3);
function limaeditores_custom_avatar_url($url, $id_or_email, $args) {
    $user_id = 0;
    if (is_numeric($id_or_email)) {
        $user_id = (int)$id_or_email;
    } elseif (is_object($id_or_email) && !empty($id_or_email->user_id)) {
        $user_id = (int)$id_or_email->user_id;
    } elseif (is_string($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
        if ($user) {
            $user_id = $user->ID;
        }
    }

    if ($user_id > 0) {
        $custom_avatar = get_user_meta($user_id, 'limaeditores_custom_avatar', true);
        if (!empty($custom_avatar)) {
            return esc_url($custom_avatar);
        }
    }
    return $url;
}

// 4. AJAX Endpoint: Upload Avatar Instantly (without submitting or validating other fields)
add_action('wp_ajax_limaeditores_upload_avatar', 'limaeditores_ajax_upload_avatar_handler');
function limaeditores_ajax_upload_avatar_handler() {
    check_ajax_referer('limaeditores_avatar_nonce', 'security');

    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => __('Debes iniciar sesión para cambiar tu foto.', 'limaeditores')]);
    }

    $user_id = get_current_user_id();

    if (empty($_FILES['avatar_file']['name'])) {
        wp_send_json_error(['message' => __('No se seleccionó ningún archivo de imagen.', 'limaeditores')]);
    }

    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');

    $attachment_id = media_handle_upload('avatar_file', 0);
    if (is_wp_error($attachment_id)) {
        wp_send_json_error(['message' => $attachment_id->get_error_message()]);
    }

    $avatar_url = wp_get_attachment_image_url($attachment_id, 'medium');
    if ($avatar_url) {
        update_user_meta($user_id, 'limaeditores_custom_avatar', $avatar_url);
        wp_send_json_success([
            'message'    => __('¡Foto de perfil actualizada con éxito!', 'limaeditores'),
            'avatar_url' => esc_url($avatar_url),
        ]);
    }

    wp_send_json_error(['message' => __('No se pudo procesar la imagen.', 'limaeditores')]);
}

// 5. AJAX Endpoint: Remove Custom Avatar
add_action('wp_ajax_limaeditores_remove_avatar', 'limaeditores_ajax_remove_avatar_handler');
function limaeditores_ajax_remove_avatar_handler() {
    check_ajax_referer('limaeditores_avatar_nonce', 'security');

    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => __('Debes iniciar sesión.', 'limaeditores')]);
    }

    $user_id = get_current_user_id();
    delete_user_meta($user_id, 'limaeditores_custom_avatar');
    $default_avatar = get_avatar_url($user_id, ['size' => 180]);

    wp_send_json_success([
        'message'    => __('Foto de perfil eliminada.', 'limaeditores'),
        'avatar_url' => esc_url($default_avatar),
    ]);
}

// 6. Photo Section UI Component
function limaeditores_render_avatar_section() {
    $user_id = get_current_user_id();
    $custom_avatar = get_user_meta($user_id, 'limaeditores_custom_avatar', true);
    $avatar_url = get_avatar_url($user_id, ['size' => 180]);
    $nonce = wp_create_nonce('limaeditores_avatar_nonce');
    $ajax_url = admin_url('admin-ajax.php');
    ?>
    <div class="mb-8 p-6 bg-white border border-slate-200 rounded-2xl shadow-xs" id="lima-avatar-card">
      <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
        <h3 class="font-serif font-bold text-base text-slate-900 flex items-center gap-2">
          <i class="fa-solid fa-camera text-[#74A626]"></i> Foto de Perfil
        </h3>
        <span id="avatar-status-badge" class="hidden text-xs px-2.5 py-1 rounded-full font-bold"></span>
      </div>

      <div class="flex flex-col sm:flex-row items-center gap-6">
        <!-- Avatar Preview -->
        <div class="relative group flex-shrink-0">
          <img id="avatar-preview-img" src="<?php echo esc_url($avatar_url); ?>" alt="Avatar" class="w-24 h-24 rounded-full object-cover border-4 border-slate-100 shadow-md bg-slate-50 ring-2 ring-[#74A626]/30" />
          
          <label for="ajax_avatar_input" class="absolute bottom-0 right-0 w-8 h-8 bg-[#74A626] hover:bg-[#5E891C] text-white rounded-full flex items-center justify-center cursor-pointer shadow-md transition-transform hover:scale-110" title="Subir nueva foto">
            <i class="fa-solid fa-camera text-xs"></i>
          </label>
        </div>

        <!-- Controls -->
        <div class="flex-1 text-center sm:text-left space-y-3">
          <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3">
            <label for="ajax_avatar_input" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#74A626] hover:bg-[#5E891C] text-white text-xs font-bold rounded-xl cursor-pointer shadow-xs transition-colors">
              <i class="fa-solid fa-cloud-arrow-up"></i> Cambiar Foto de Perfil
            </label>
            <input type="file" id="ajax_avatar_input" accept="image/png, image/jpeg, image/webp" class="hidden" />

            <button type="button" id="btn-remove-avatar" class="<?php echo empty($custom_avatar) ? 'hidden ' : ''; ?>inline-flex items-center gap-1.5 px-3.5 py-2.5 bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 text-xs font-semibold rounded-xl border border-slate-200 hover:border-rose-200 transition-colors">
              <i class="fa-solid fa-trash-can text-xs"></i> Quitar foto
            </button>
          </div>
          
          <p class="text-[11px] text-slate-500">
            Formatos: <strong>JPG, PNG o WebP</strong>. Se guarda automáticamente al seleccionarla sin necesidad de llenar los demás datos.
          </p>
        </div>
      </div>
    </div>

    <script>
      (function() {
        var input = document.getElementById('ajax_avatar_input');
        var preview = document.getElementById('avatar-preview-img');
        var badge = document.getElementById('avatar-status-badge');
        var removeBtn = document.getElementById('btn-remove-avatar');
        var nonce = '<?php echo esc_js($nonce); ?>';
        var ajaxUrl = '<?php echo esc_url($ajax_url); ?>';

        function showStatus(text, isError) {
          badge.className = 'text-xs px-2.5 py-1 rounded-full font-bold ' + 
            (isError ? 'bg-rose-100 text-rose-700 border border-rose-200' : 'bg-emerald-100 text-emerald-700 border border-emerald-200');
          badge.textContent = text;
          badge.classList.remove('hidden');
          setTimeout(function() {
            badge.classList.add('hidden');
          }, 4500);
        }

        if (input) {
          input.addEventListener('change', function() {
            if (!this.files || !this.files[0]) return;
            var file = this.files[0];

            // Local preview
            var reader = new FileReader();
            reader.onload = function(e) {
              preview.src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Instant Upload
            var formData = new FormData();
            formData.append('action', 'limaeditores_upload_avatar');
            formData.append('security', nonce);
            formData.append('avatar_file', file);

            showStatus('Guardando foto...', false);

            fetch(ajaxUrl, {
              method: 'POST',
              body: formData
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
              if (data.success) {
                preview.src = data.data.avatar_url;
                showStatus('✓ Foto de perfil guardada exitosamente', false);
                if (removeBtn) removeBtn.classList.remove('hidden');
              } else {
                showStatus(data.data && data.data.message ? data.data.message : 'Error al guardar foto', true);
              }
            })
            .catch(function(err) {
              showStatus('Error al conectar con el servidor', true);
            });
          });
        }

        if (removeBtn) {
          removeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (!confirm('¿Deseas restablecer tu foto de perfil por defecto?')) return;

            var formData = new FormData();
            formData.append('action', 'limaeditores_remove_avatar');
            formData.append('security', nonce);

            showStatus('Eliminando foto...', false);

            fetch(ajaxUrl, {
              method: 'POST',
              body: formData
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
              if (data.success) {
                preview.src = data.data.avatar_url;
                showStatus('Foto eliminada', false);
                removeBtn.classList.add('hidden');
              } else {
                showStatus('Error al eliminar', true);
              }
            })
            .catch(function() {
              showStatus('Error de conexión', true);
            });
          });
        }
      })();
    </script>
    <?php
}

// 7. Custom Dashboard Welcome Card with Profile Avatar
add_action('woocommerce_account_dashboard', 'limaeditores_render_custom_dashboard_header', 5);
function limaeditores_render_custom_dashboard_header() {
    $current_user = wp_get_current_user();
    $avatar_url   = get_avatar_url($current_user->ID, ['size' => 160]);
    $order_count  = wc_get_customer_order_count($current_user->ID);
    ?>
    <div class="mb-8 p-6 bg-gradient-to-r from-[#1C2518] to-[#2E3D27] rounded-2xl text-white shadow-lg flex flex-col sm:flex-row items-center justify-between gap-6">
      <div class="flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
        <div class="relative">
          <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($current_user->display_name); ?>" class="w-20 h-20 rounded-full object-cover border-4 border-white/20 shadow-md bg-white/10 ring-2 ring-[#C4D626]" />
          <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" class="absolute -bottom-1 -right-1 bg-[#74A626] hover:bg-[#5E891C] text-white w-7 h-7 rounded-full flex items-center justify-center text-xs shadow-md" title="Editar perfil y foto">
            <i class="fa-solid fa-camera"></i>
          </a>
        </div>
        <div>
          <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#C4D626]/20 text-[#C4D626] border border-[#C4D626]/30 mb-1">
            <i class="fa-solid fa-shield-halved"></i> Cliente Registrado
          </div>
          <h2 class="text-xl font-bold font-serif text-white"><?php echo esc_html($current_user->display_name); ?></h2>
          <p class="text-xs text-slate-300"><?php echo esc_html($current_user->user_email); ?></p>
        </div>
      </div>

      <div class="flex items-center gap-4 bg-white/10 px-5 py-3 rounded-xl border border-white/10">
        <div class="text-center">
          <span class="text-2xl font-extrabold text-[#C4D626] block leading-none"><?php echo intval($order_count); ?></span>
          <span class="text-[11px] text-slate-300 font-medium">Pedidos realizados</span>
        </div>
        <div class="h-8 w-px bg-white/20"></div>
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" class="text-xs font-bold text-white hover:text-[#C4D626] transition-colors flex items-center gap-1">
          Ver historial <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </a>
      </div>
    </div>
    <?php
}
