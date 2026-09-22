<?php
/**
 * The template for displaying WooCommerce pages
 */

get_header(); 

$is_archive = is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() || (is_search() && get_query_var('post_type') === 'product');
?>

<main id="primary" class="site-main py-8 min-h-screen bg-slate-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Breadcrumb bar -->
    <div class="mb-5 py-1 text-xs text-slate-500">
      <?php if (function_exists('woocommerce_breadcrumb')): ?>
        <?php woocommerce_breadcrumb([
          'delimiter'   => '<span class="mx-2 text-slate-400">/</span>',
          'wrap_before' => '<nav class="woocommerce-breadcrumb flex items-center flex-wrap">',
          'wrap_after'  => '</nav>',
          'before'      => '',
          'after'       => '',
        ]); ?>
      <?php endif; ?>
    </div>

    <?php if ($is_archive): ?>
      <?php 
        global $wp_query;
        $total_count = $wp_query->found_posts ?? 0;
      ?>
      
      <!-- Mobile Filter Trigger & Sorting Bar (Mobile only) -->
      <?php if (function_exists('limaeditores_render_mobile_filter_bar')) {
          limaeditores_render_mobile_filter_bar($total_count);
      } ?>

      <!-- 2-Column Catalog Layout: Sticky Desktop Sidebar + Products Grid -->
      <div class="flex flex-col lg:flex-row gap-8 items-start">
        
        <!-- Desktop Sidebar Filters (Hidden on mobile) -->
        <div class="hidden lg:block w-72 flex-shrink-0 bg-white p-6 rounded-2xl shadow-xs border border-slate-200 sticky top-24">
          <?php if (function_exists('limaeditores_render_filters_sidebar')) {
              limaeditores_render_filters_sidebar();
          } ?>
        </div>

        <!-- Catalog Products & Top Toolbar -->
        <div class="flex-1 w-full min-w-0 bg-white p-6 md:p-8 rounded-2xl shadow-xs border border-slate-200">
          <?php 
            if (function_exists('limaeditores_render_sorting_bar')) {
                limaeditores_render_sorting_bar($total_count);
            }
            if (function_exists('limaeditores_render_active_chips')) {
                limaeditores_render_active_chips();
            }
            woocommerce_content();
          ?>
        </div>

      </div>
    <?php else: ?>
      <!-- Single Product / Other WooCommerce Page -->
      <div class="bg-white rounded-2xl shadow-xs border border-slate-200 p-6 md:p-8">
        <?php woocommerce_content(); ?>
      </div>
    <?php endif; ?>

  </div>
</main>

<?php get_footer(); ?>

