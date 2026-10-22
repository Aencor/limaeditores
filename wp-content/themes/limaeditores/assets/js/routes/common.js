
import AjaxSearch from '../modules/ajax-search';

export default {
  init() {
    // Initialize Live Search Autocomplete
    AjaxSearch.init();

    // Mobile Filters Drawer Toggle
    const filterBtn = document.getElementById('open-mobile-filters-btn');
    const filterDrawer = document.getElementById('mobile-filter-drawer');
    const filterCloseBtn = document.getElementById('close-mobile-filters-btn');
    const filterBackdrop = document.getElementById('close-mobile-filters-backdrop');
    const filterApplyBtn = document.getElementById('close-mobile-filters-apply');

    const openFilters = () => {
      if (filterDrawer) {
        filterDrawer.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
    };

    const closeFilters = () => {
      if (filterDrawer) {
        filterDrawer.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }
    };

    if (filterBtn) filterBtn.addEventListener('click', openFilters);
    if (filterCloseBtn) filterCloseBtn.addEventListener('click', closeFilters);
    if (filterBackdrop) filterBackdrop.addEventListener('click', closeFilters);
    if (filterApplyBtn) filterApplyBtn.addEventListener('click', closeFilters);

    // Enhanced clickable cards for WooCommerce Shipping Methods
    $(document).on('click', '.woocommerce-shipping-methods li', function(e) {
      if (!$(e.target).is('input[type="radio"]')) {
        const $radio = $(this).find('input[type="radio"]');
        if (!$radio.prop('checked')) {
          $radio.prop('checked', true).trigger('change');
        }
      }
    });

    $(document).on('change', '.woocommerce-shipping-methods input[type="radio"]', function() {
      $('.woocommerce-shipping-methods li').removeClass('selected');
      $(this).closest('li').addClass('selected');
    });

    // Enhanced clickable cards for WooCommerce Payment Methods
    $(document).on('click', '.wc_payment_methods li.wc_payment_method', function(e) {
      if (!$(e.target).is('input[type="radio"]') && !$(e.target).closest('.payment_box').length) {
        const $radio = $(this).find('> input[type="radio"]');
        if (!$radio.prop('checked')) {
          $radio.prop('checked', true).trigger('change');
        }
      }
    });

    $(document).on('change', '.wc_payment_methods input[type="radio"]', function() {
      $('.wc_payment_methods li.wc_payment_method').removeClass('selected');
      $(this).closest('li.wc_payment_method').addClass('selected');
    });

    // Single Product Interactive Star Rating Component
    const starLabels = {
      1: '1 estrella: Deficiente',
      2: '2 estrellas: Regular',
      3: '3 estrellas: Aceptable',
      4: '4 estrellas: Muy buena',
      5: '5 estrellas: Excelente / Muy recomendada'
    };

    const $starsRow = $('#lima-stars-row');
    const $ratingSelect = $('#rating');
    const $ratingFeedback = $('#lima-rating-feedback');

    if ($starsRow.length) {
      let selectedRating = parseInt($ratingSelect.val(), 10) || 0;

      const renderStars = (rating) => {
        $starsRow.find('.lima-star-btn').each(function() {
          const val = parseInt($(this).data('value'), 10);
          if (val <= rating) {
            $(this).addClass('active').find('i').removeClass('fa-regular text-slate-300').addClass('fa-solid text-amber-400');
          } else {
            $(this).removeClass('active').find('i').removeClass('fa-solid text-amber-400').addClass('fa-regular text-slate-300');
          }
        });

        if (rating > 0 && starLabels[rating]) {
          $ratingFeedback.text(starLabels[rating]).addClass('text-amber-600 font-bold');
        } else {
          $ratingFeedback.text('Haz clic para calificar').removeClass('text-amber-600 font-bold');
        }
      };

      // Initial state
      renderStars(selectedRating);

      // Hover preview
      $starsRow.on('mouseenter', '.lima-star-btn', function() {
        const hoverVal = parseInt($(this).data('value'), 10);
        $starsRow.find('.lima-star-btn').each(function() {
          const val = parseInt($(this).data('value'), 10);
          if (val <= hoverVal) {
            $(this).addClass('hovered').find('i').removeClass('fa-regular text-slate-300').addClass('fa-solid text-amber-400');
          } else {
            $(this).removeClass('hovered').find('i').removeClass('fa-solid text-amber-400').addClass('fa-regular text-slate-300');
          }
        });
        if (starLabels[hoverVal]) {
          $ratingFeedback.text(starLabels[hoverVal]).addClass('text-amber-600 font-bold');
        }
      });

      $starsRow.on('mouseleave', function() {
        $starsRow.find('.lima-star-btn').removeClass('hovered');
        renderStars(selectedRating);
      });

      // Click to select
      $starsRow.on('click', '.lima-star-btn', function(e) {
        e.preventDefault();
        selectedRating = parseInt($(this).data('value'), 10);
        $ratingSelect.val(selectedRating).trigger('change');
        renderStars(selectedRating);
      });
    }
  },
  finalize() { }
};