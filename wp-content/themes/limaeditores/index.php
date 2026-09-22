<?php get_header(); ?>

<main class="global-main min-h-screen">
  
  <!-- Hero Section -->
  <section class="relative bg-gradient-to-b from-[#1C2518] to-[#141C11] text-white py-16 md:py-24 overflow-hidden border-b border-[#2C3E20]">
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#74A626_1.5px,transparent_1.5px)] [background-size:20px_20px]"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
          <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#74A626]/20 border border-[#74A626]/40 text-[#C4D626] text-xs font-semibold tracking-wide uppercase">
            <i class="fa-solid fa-scale-balanced"></i> Fondo Editorial Jurídico 2026
          </div>
          
          <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight text-white tracking-tight">
            Literatura Jurídica de Vanguardia para <span class="text-[#C4D626] underline decoration-[#74A626]/60">Abogados y Magistrados</span>
          </h1>
          
          <p class="text-slate-300 text-base md:text-lg max-w-2xl leading-relaxed">
            Códigos comentados, tratados de doctrina, jurisprudencia vinculante y manuales prácticos de litigación para el ejercicio profesional del derecho.
          </p>
          
          <div class="flex flex-wrap gap-4 justify-center lg:justify-start pt-2">
            <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url(wc_get_page_permalink('shop')) : home_url('/tienda'); ?>" 
               class="px-7 py-3.5 bg-[#74A626] hover:bg-[#5E891C] text-white font-bold rounded-lg shadow-lg hover:shadow-[#74A626]/30 transition-all flex items-center gap-2">
              <i class="fa-solid fa-book-open"></i> Explorar Catálogo
            </a>
            <a href="#destacados" 
               class="px-7 py-3.5 bg-[#283723] hover:bg-[#34482E] text-white font-semibold rounded-lg border border-[#3E5536] hover:border-[#74A626] transition-all flex items-center gap-2">
              <i class="fa-solid fa-sparkles text-[#C4D626]"></i> Novedades y Códigos
            </a>
          </div>
        </div>

        <div class="lg:col-span-5 flex justify-center">
          <div class="relative w-72 sm:w-80 aspect-3/4 rounded-xl shadow-2xl bg-gradient-to-tr from-[#141C11] via-[#24341E] to-[#1C2518] p-6 border border-[#74A626]/40 flex flex-col justify-between group transform hover:-translate-y-2 transition-transform duration-300">
            <div class="border-2 border-[#74A626]/50 p-4 h-full flex flex-col justify-between text-center rounded bg-[#1C2518]/60">
              <div>
                <p class="text-[10px] tracking-widest text-[#C4D626] font-bold uppercase">Colección Alta Doctrina</p>
                <div class="h-0.5 w-12 bg-[#74A626] mx-auto my-3"></div>
                <h3 class="font-serif font-bold text-xl text-white mt-4">TRATADO DE DERECHO PROCESAL PENAL</h3>
                <p class="text-xs text-slate-300 mt-2 italic">Doctrina, Jurisprudencia y Casuística</p>
              </div>
              <div class="mt-8 flex flex-col items-center">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logos/logo-white.svg" alt="Lima Editores" class="h-7 w-auto mb-2 opacity-90" />
                <p class="text-[10px] text-slate-400">Edición Oficial 2026</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Categories / Legal Branches Grid -->
  <section class="py-14 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-2xl mx-auto mb-10">
        <h2 class="font-serif text-2xl md:text-3xl font-bold text-slate-900">Especialidades del Derecho</h2>
        <p class="text-sm text-slate-500 mt-2">Encuentre obras especializadas por rama jurídica y materias de estudio</p>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        
        <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-penal')); ?>" class="p-5 rounded-xl bg-slate-50 hover:bg-[#F5F9EE] border border-slate-200 hover:border-[#74A626]/60 text-center transition-all group shadow-xs">
          <div class="w-12 h-12 mx-auto rounded-full bg-slate-200 group-hover:bg-[#74A626]/15 text-slate-700 group-hover:text-[#74A626] flex items-center justify-center text-xl mb-3 transition-colors">
            <i class="fa-solid fa-gavel"></i>
          </div>
          <h3 class="font-bold text-xs text-slate-800 group-hover:text-[#5E891C]">Derecho Penal</h3>
        </a>

        <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-civil')); ?>" class="p-5 rounded-xl bg-slate-50 hover:bg-[#F5F9EE] border border-slate-200 hover:border-[#74A626]/60 text-center transition-all group shadow-xs">
          <div class="w-12 h-12 mx-auto rounded-full bg-slate-200 group-hover:bg-[#74A626]/15 text-slate-700 group-hover:text-[#74A626] flex items-center justify-center text-xl mb-3 transition-colors">
            <i class="fa-solid fa-file-contract"></i>
          </div>
          <h3 class="font-bold text-xs text-slate-800 group-hover:text-[#5E891C]">Derecho Civil</h3>
        </a>

        <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-procesal')); ?>" class="p-5 rounded-xl bg-slate-50 hover:bg-[#F5F9EE] border border-slate-200 hover:border-[#74A626]/60 text-center transition-all group shadow-xs">
          <div class="w-12 h-12 mx-auto rounded-full bg-slate-200 group-hover:bg-[#74A626]/15 text-slate-700 group-hover:text-[#74A626] flex items-center justify-center text-xl mb-3 transition-colors">
            <i class="fa-solid fa-landmark-dome"></i>
          </div>
          <h3 class="font-bold text-xs text-slate-800 group-hover:text-[#5E891C]">Derecho Procesal</h3>
        </a>

        <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-constitucional')); ?>" class="p-5 rounded-xl bg-slate-50 hover:bg-[#F5F9EE] border border-slate-200 hover:border-[#74A626]/60 text-center transition-all group shadow-xs">
          <div class="w-12 h-12 mx-auto rounded-full bg-slate-200 group-hover:bg-[#74A626]/15 text-slate-700 group-hover:text-[#74A626] flex items-center justify-center text-xl mb-3 transition-colors">
            <i class="fa-solid fa-scale-balanced"></i>
          </div>
          <h3 class="font-bold text-xs text-slate-800 group-hover:text-[#5E891C]">Constitucional</h3>
        </a>

        <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-laboral')); ?>" class="p-5 rounded-xl bg-slate-50 hover:bg-[#F5F9EE] border border-slate-200 hover:border-[#74A626]/60 text-center transition-all group shadow-xs">
          <div class="w-12 h-12 mx-auto rounded-full bg-slate-200 group-hover:bg-[#74A626]/15 text-slate-700 group-hover:text-[#74A626] flex items-center justify-center text-xl mb-3 transition-colors">
            <i class="fa-solid fa-briefcase"></i>
          </div>
          <h3 class="font-bold text-xs text-slate-800 group-hover:text-[#5E891C]">Derecho Laboral</h3>
        </a>

        <a href="<?php echo esc_url(home_url('/categoria-producto/derecho-administrativo')); ?>" class="p-5 rounded-xl bg-slate-50 hover:bg-[#F5F9EE] border border-slate-200 hover:border-[#74A626]/60 text-center transition-all group shadow-xs">
          <div class="w-12 h-12 mx-auto rounded-full bg-slate-200 group-hover:bg-[#74A626]/15 text-slate-700 group-hover:text-[#74A626] flex items-center justify-center text-xl mb-3 transition-colors">
            <i class="fa-solid fa-building-columns"></i>
          </div>
          <h3 class="font-bold text-xs text-slate-800 group-hover:text-[#5E891C]">Administrativo</h3>
        </a>

      </div>
    </div>
  </section>

  <!-- Featured Law Books Section -->
  <section id="destacados" class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4">
      <div>
        <span class="text-xs font-bold text-[#74A626] uppercase tracking-wider">Catálogo Destacado</span>
        <h2 class="font-serif text-2xl md:text-3xl font-bold text-slate-900 mt-1">Obras Jurídicas Recomendadas</h2>
      </div>
      <a href="<?php echo function_exists('wc_get_page_permalink') ? esc_url(wc_get_page_permalink('shop')) : home_url('/tienda'); ?>" class="text-sm font-semibold text-[#74A626] hover:text-[#5E891C] flex items-center gap-1 transition-colors">
        Ver todo el catálogo <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>

    <?php if (class_exists('WooCommerce')): ?>
      <?php echo do_shortcode('[products limit="8" columns="4" orderby="popularity"]'); ?>
    <?php else: ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php for ($i = 1; $i <= 4; $i++): ?>
          <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow flex flex-col justify-between">
            <div class="p-6 bg-slate-100 flex items-center justify-center min-h-[220px]">
              <div class="w-32 h-44 bg-[#1C2518] text-[#C4D626] p-3 rounded shadow flex flex-col justify-between text-center border border-[#74A626]/30">
                <span class="text-[8px] uppercase tracking-widest text-[#86C62C]">Lima Editores</span>
                <p class="font-serif text-xs font-bold text-white">Código Procesal Civil Comentado</p>
                <span class="text-[9px] text-[#C4D626]">Edición 2026</span>
              </div>
            </div>
            <div class="p-4 flex flex-col flex-1 justify-between">
              <div>
                <span class="text-[10px] uppercase font-bold text-[#74A626]">Derecho Civil</span>
                <h3 class="font-bold text-slate-900 text-sm mt-1">Código Civil y Procesal Civil Comentado</h3>
                <p class="text-xs text-slate-500 mt-1">Dr. Carlos Ramos Núñez</p>
              </div>
              <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="font-bold text-slate-900 text-base">S/ 120.00</span>
                <span class="text-xs px-3 py-1.5 bg-[#74A626] text-white font-semibold rounded hover:bg-[#5E891C] transition-colors cursor-pointer">
                  Ver libro
                </span>
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </section>

</main>

<?php get_footer(); ?>
