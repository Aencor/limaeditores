<?php
/**
 * Display single product reviews (comments) for Lima Editores
 *
 * @package WooCommerce\Templates
 * @version 11.2.0
 */

defined('ABSPATH') || exit;

global $product;

if (!comments_open()) {
    return;
}

$count   = $product->get_review_count();
$average = (float) $product->get_average_rating();
$ratings = wc_review_ratings_enabled();
?>

<div id="reviews" class="woocommerce-Reviews lima-reviews-section">
    <div id="comments" class="lima-comments-container">
        <!-- Section Header -->
        <div class="lima-reviews-header">
            <div class="lima-reviews-header-info">
                <span class="lima-reviews-badge">
                    <i class="fa-solid fa-award"></i> Opiniones de la Comunidad Jurídica
                </span>
                <h2 class="woocommerce-Reviews-title lima-reviews-title">
                    Valoraciones y Reseñas
                    <?php if ($count > 0): ?>
                        <span class="lima-reviews-count">(<?php echo esc_html($count); ?>)</span>
                    <?php endif; ?>
                </h2>
                <p class="lima-reviews-subtitle">
                    Análisis, comentarios y criterios de profesionales y lectores que han adquirido esta obra.
                </p>
            </div>

            <?php if ($count > 0 && $ratings): ?>
                <!-- Rating Score Summary Card -->
                <div class="lima-rating-summary-card">
                    <div class="lima-rating-score-box">
                        <span class="lima-rating-big-number"><?php echo number_format($average, 1, '.', ''); ?></span>
                        <div class="lima-rating-stars-wrapper">
                            <?php
                            $rounded_rating = round($average * 2) / 2;
                            for ($i = 1; $i <= 5; $i++):
                                if ($rounded_rating >= $i): ?>
                                    <i class="fa-solid fa-star text-amber-400"></i>
                                <?php elseif ($rounded_rating >= ($i - 0.5)): ?>
                                    <i class="fa-solid fa-star-half-stroke text-amber-400"></i>
                                <?php else: ?>
                                    <i class="fa-regular fa-star text-slate-300"></i>
                                <?php endif;
                            endfor; ?>
                        </div>
                        <span class="lima-rating-total-label">
                            Promedio de <?php echo esc_html($count); ?> <?php echo _n('valoración', 'valoraciones', $count, 'limaeditores'); ?>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (have_comments()): ?>
            <!-- Review List -->
            <ol class="commentlist lima-comment-list">
                <?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', ['callback' => 'woocommerce_comments'])); ?>
            </ol>

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
                <nav class="woocommerce-pagination lima-reviews-pagination">
                    <?php
                    paginate_comments_links(
                        apply_filters(
                            'woocommerce_comment_pagination_args',
                            [
                                'prev_text' => '<i class="fa-solid fa-arrow-left"></i> Anterior',
                                'next_text' => 'Siguiente <i class="fa-solid fa-arrow-right"></i>',
                                'type'      => 'list',
                            ]
                        )
                    );
                    ?>
                </nav>
            <?php endif; ?>

        <?php else: ?>
            <!-- Elegant Empty State -->
            <div class="lima-reviews-empty-state">
                <div class="lima-empty-icon">
                    <i class="fa-solid fa-feather-pointed"></i>
                </div>
                <h3 class="lima-empty-title">Aún no hay valoraciones para esta edición</h3>
                <p class="lima-empty-desc">
                    Sé el primero en compartir tu experiencia y análisis jurídico sobre esta obra. Tu opinión ayuda a otros colegas, juzgadores y estudiantes de derecho a conocer el rigor técnico y utilidad práctica de esta publicación.
                </p>
                <a href="#review_form_wrapper" class="lima-empty-cta-btn">
                    <i class="fa-solid fa-pen-to-square"></i> Escribir la primera valoración
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Review Form Section -->
    <?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())): ?>
        <div id="review_form_wrapper" class="lima-review-form-wrapper">
            <div id="review_form">
                <?php
                $commenter = wp_get_current_commenter();

                $comment_form = [
                    'title_reply'         => have_comments() ? __('Comparte tu valoración sobre esta obra', 'limaeditores') : sprintf(__('Sé el primero en valorar &ldquo;%s&rdquo;', 'limaeditores'), get_the_title()),
                    'title_reply_to'      => __('Dejar una respuesta a %s', 'limaeditores'),
                    'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title lima-reply-title">',
                    'title_reply_after'   => '</h3>',
                    'comment_notes_before'=> '<p class="comment-notes lima-comment-notes"><span id="email-notes">Tu dirección de correo electrónico no será publicada.</span> <span class="required-field-message">Los campos obligatorios están marcados con <span class="required text-rose-500">*</span></span></p>',
                    'comment_notes_after' => '',
                    'label_submit'        => __('Publicar Valoración', 'limaeditores'),
                    'submit_button'       => '<button name="%1$s" type="submit" id="%2$s" class="%3$s lima-submit-review-btn"><i class="fa-solid fa-paper-plane mr-2"></i> %4$s</button>',
                    'logged_in_as'        => '',
                    'comment_field'       => '',
                ];

                $name_email_required = (bool) get_option('require_name_email', 1);

                $fields = [
                    'author' => [
                        'label'        => __('Nombre completo', 'limaeditores'),
                        'type'         => 'text',
                        'value'        => $commenter['comment_author'],
                        'required'     => $name_email_required,
                        'autocomplete' => 'name',
                        'placeholder'  => __('Ej.: Lic. Carlos Mendoza', 'limaeditores'),
                    ],
                    'email'  => [
                        'label'        => __('Correo electrónico', 'limaeditores'),
                        'type'         => 'email',
                        'value'        => $commenter['comment_author_email'],
                        'required'     => $name_email_required,
                        'autocomplete' => 'email',
                        'placeholder'  => __('carlos.mendoza@ejemplo.com', 'limaeditores'),
                    ],
                ];

                $comment_form['fields'] = [];

                // Wrap author & email in a 2-column grid
                $guest_fields_html = '<div class="lima-form-author-grid grid grid-cols-1 md:grid-cols-2 gap-4 my-4">';
                foreach ($fields as $key => $field) {
                    $field_html  = '<div class="comment-form-' . esc_attr($key) . ' lima-field-group">';
                    $field_html .= '<label for="' . esc_attr($key) . '" class="lima-field-label">' . esc_html($field['label']);
                    if ($field['required']) {
                        $field_html .= '&nbsp;<span class="required text-rose-500">*</span>';
                    }
                    $field_html .= '</label>';
                    $field_html .= '<input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" autocomplete="' . esc_attr($field['autocomplete']) . '" value="' . esc_attr($field['value']) . '" placeholder="' . esc_attr($field['placeholder']) . '" class="lima-input" ' . ($field['required'] ? 'required' : '') . ' />';
                    $field_html .= '</div>';
                    $guest_fields_html .= $field_html;
                }
                $guest_fields_html .= '</div>';

                $comment_form['fields']['author_email_group'] = $guest_fields_html;

                $account_page_url = wc_get_page_permalink('myaccount');
                if ($account_page_url) {
                    $comment_form['must_log_in'] = '<p class="must-log-in lima-must-log-in">' . sprintf(__('Debes <a href="%s" class="text-[#74A626] font-bold underline">iniciar sesión</a> para publicar una valoración.', 'limaeditores'), esc_url($account_page_url)) . '</p>';
                }

                // Interactive Star Rating Field
                if ($ratings) {
                    ob_start();
                    ?>
                    <div class="comment-form-rating lima-interactive-rating-block mb-5">
                        <label for="rating" id="comment-form-rating-label" class="lima-rating-label">
                            Tu puntuación de la obra&nbsp;<span class="required text-rose-500">*</span>
                        </label>
                        <div class="lima-stars-selector" role="radiogroup" aria-label="<?php esc_attr_e('Puntuación de 1 a 5 estrellas', 'limaeditores'); ?>">
                            <div class="lima-stars-row" id="lima-stars-row">
                                <button type="button" class="lima-star-btn" data-value="1" title="1 estrella - Deficiente" aria-label="1 estrella">
                                    <i class="fa-solid fa-star"></i>
                                </button>
                                <button type="button" class="lima-star-btn" data-value="2" title="2 estrellas - Regular" aria-label="2 estrellas">
                                    <i class="fa-solid fa-star"></i>
                                </button>
                                <button type="button" class="lima-star-btn" data-value="3" title="3 estrellas - Aceptable" aria-label="3 estrellas">
                                    <i class="fa-solid fa-star"></i>
                                </button>
                                <button type="button" class="lima-star-btn" data-value="4" title="4 estrellas - Muy buena" aria-label="4 estrellas">
                                    <i class="fa-solid fa-star"></i>
                                </button>
                                <button type="button" class="lima-star-btn" data-value="5" title="5 estrellas - Excelente" aria-label="5 estrellas">
                                    <i class="fa-solid fa-star"></i>
                                </button>
                            </div>
                            <span class="lima-rating-feedback-text" id="lima-rating-feedback">Haz clic para calificar</span>
                        </div>

                        <!-- Native WooCommerce select kept in sync for submission & validation -->
                        <select name="rating" id="rating" class="lima-hidden-rating-select sr-only" required>
                            <option value=""><?php esc_html_e('Puntuar&hellip;', 'woocommerce'); ?></option>
                            <option value="5"><?php esc_html_e('Perfecto', 'woocommerce'); ?></option>
                            <option value="4"><?php esc_html_e('Bueno', 'woocommerce'); ?></option>
                            <option value="3"><?php esc_html_e('Normal', 'woocommerce'); ?></option>
                            <option value="2"><?php esc_html_e('No está tan mal', 'woocommerce'); ?></option>
                            <option value="1"><?php esc_html_e('Muy pobre', 'woocommerce'); ?></option>
                        </select>
                    </div>
                    <?php
                    $comment_form['comment_field'] = ob_get_clean();
                }

                // Textarea comment field
                $comment_form['comment_field'] .= '
                <div class="comment-form-comment lima-field-group mb-5">
                    <label for="comment" class="lima-field-label">
                        Tu reseña o análisis jurídico&nbsp;<span class="required text-rose-500">*</span>
                    </label>
                    <textarea id="comment" name="comment" cols="45" rows="5" required placeholder="' . esc_attr__('¿Qué te pareció esta obra? Comparte tu análisis sobre la claridad técnica, calidad de las fuentes, profundidad jurídica o utilidad en la práctica profesional...', 'limaeditores') . '" class="lima-textarea"></textarea>
                </div>';

                comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
                ?>
            </div>
        </div>
    <?php else: ?>
        <div class="lima-verified-required-card p-6 bg-amber-50/70 border border-amber-200/80 rounded-2xl text-amber-900 text-sm flex items-center gap-4 mt-8">
            <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 text-lg">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
                <strong class="font-bold block"><?php esc_html_e('Reseñas de compradores verificados', 'limaeditores'); ?></strong>
                <p class="text-xs text-amber-800 mt-0.5">
                    <?php esc_html_e('Solo los clientes que hayan adquirido esta obra pueden publicar una valoración para garantizar la autenticidad de los comentarios.', 'woocommerce'); ?>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <div class="clear"></div>
</div>
