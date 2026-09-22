<?php get_header(); ?>

<?php
$is_auth_page = is_account_page() && !is_user_logged_in();
$article_class = $is_auth_page 
    ? 'p-0 bg-transparent border-0 shadow-none' 
    : 'bg-white rounded-2xl shadow-xs border border-slate-200 p-6 sm:p-8 md:p-10';
?>

<main id="primary" class="global-main min-h-screen bg-slate-50 py-8 md:py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class($article_class); ?>>
        
        <?php if (!is_front_page() && !is_home() && !is_cart() && !is_checkout() && !is_account_page()): ?>
          <header class="entry-header mb-8 pb-4 border-b border-slate-200">
            <h1 class="entry-title font-serif text-2xl md:text-3xl font-bold text-slate-900">
              <?php the_title(); ?>
            </h1>
          </header>
        <?php endif; ?>

        <div class="entry-content">
          <?php the_content(); ?>
        </div>

      </article>
    <?php endwhile; endif; ?>
  </div>
</main>

<?php get_footer(); ?>
