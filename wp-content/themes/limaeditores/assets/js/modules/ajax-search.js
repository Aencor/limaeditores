/**
 * AJAX Live Search for Lima Editores Bookstore
 */

const AjaxSearch = {
  init() {
    const searchForms = document.querySelectorAll('.js-ajax-search-form');
    if (!searchForms.length) return;

    searchForms.forEach(form => {
      this.bindSearch(form);
    });

    // Close when clicking outside
    document.addEventListener('click', (e) => {
      if (!e.target.closest('.js-ajax-search-form')) {
        document.querySelectorAll('.js-search-results-container').forEach(container => {
          container.classList.add('hidden');
        });
      }
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        document.querySelectorAll('.js-search-results-container').forEach(container => {
          container.classList.add('hidden');
        });
      }
    });
  },

  bindSearch(form) {
    const input = form.querySelector('.js-ajax-search-input');
    const container = form.querySelector('.js-search-results-container');
    const spinner = form.querySelector('.js-search-spinner');
    if (!input || !container) return;

    let debounceTimer = null;
    let currentRequest = null;
    let selectedIndex = -1;

    // Input typing event
    input.addEventListener('input', () => {
      const query = input.value.trim();
      clearTimeout(debounceTimer);
      selectedIndex = -1;

      if (query.length < 2) {
        container.innerHTML = '';
        container.classList.add('hidden');
        if (spinner) spinner.classList.add('hidden');
        return;
      }

      if (spinner) spinner.classList.remove('hidden');

      debounceTimer = setTimeout(() => {
        this.fetchResults(query, container, spinner);
      }, 250);
    });

    // Re-show on focus if text exists
    input.addEventListener('focus', () => {
      if (input.value.trim().length >= 2 && container.children.length > 0) {
        container.classList.remove('hidden');
      }
    });

    // Keyboard navigation (Arrow keys & Enter)
    input.addEventListener('keydown', (e) => {
      const items = container.querySelectorAll('.js-search-result-item');
      if (!items.length || container.classList.contains('hidden')) return;

      if (e.key === 'ArrowDown') {
        e.preventDefault();
        selectedIndex = (selectedIndex + 1) % items.length;
        this.updateActiveItem(items, selectedIndex);
      } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        selectedIndex = (selectedIndex - 1 + items.length) % items.length;
        this.updateActiveItem(items, selectedIndex);
      } else if (e.key === 'Enter' && selectedIndex >= 0) {
        e.preventDefault();
        const activeLink = items[selectedIndex].querySelector('a');
        if (activeLink) {
          window.location.href = activeLink.href;
        }
      }
    });
  },

  updateActiveItem(items, index) {
    items.forEach((item, i) => {
      if (i === index) {
        item.classList.add('bg-slate-100');
        item.scrollIntoView({ block: 'nearest' });
      } else {
        item.classList.remove('bg-slate-100');
      }
    });
  },

  fetchResults(term, container, spinner) {
    const ajaxUrl = (typeof limaeditores_vars !== 'undefined' && limaeditores_vars.ajax_url) 
      ? limaeditores_vars.ajax_url 
      : '/wp-admin/admin-ajax.php';

    const formData = new FormData();
    formData.append('action', 'limaeditores_ajax_search');
    formData.append('term', term);

    fetch(ajaxUrl, {
      method: 'POST',
      body: formData,
    })
      .then(res => res.json())
      .then(response => {
        if (spinner) spinner.classList.add('hidden');
        if (response.success) {
          this.renderResults(response.data, container);
        }
      })
      .catch(err => {
        if (spinner) spinner.classList.add('hidden');
        console.error('Error en búsqueda AJAX:', err);
      });
  },

  renderResults(data, container) {
    const { results, total, term, search_url } = data;

    if (!results || results.length === 0) {
      container.innerHTML = `
        <div class="p-4 text-center">
          <p class="text-xs text-slate-500 font-medium">No se encontraron libros para <span class="font-bold text-slate-800">"${term}"</span></p>
          <a href="${search_url}" class="mt-2 inline-block text-xs font-bold text-[#74A626] hover:underline">
            Buscar en todo el catálogo general &rarr;
          </a>
        </div>
      `;
      container.classList.remove('hidden');
      return;
    }

    let html = `
      <div class="px-3.5 py-2 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Sugerencias de Libros</span>
        <span class="text-[10px] bg-[#74A626]/10 text-[#74A626] font-bold px-2 py-0.5 rounded-full">${total} encontrado${total > 1 ? 's' : ''}</span>
      </div>
      <div class="divide-y divide-slate-100 overflow-y-auto max-h-80">
    `;

    results.forEach(book => {
      html += `
        <div class="js-search-result-item hover:bg-slate-50 transition-colors">
          <a href="${book.url}" class="flex items-center gap-3 p-3 group">
            <div class="w-10 h-14 bg-slate-100 rounded overflow-hidden flex-shrink-0 shadow-sm border border-slate-200">
              <img src="${book.thumb}" alt="${book.title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center gap-1.5 text-[10px] font-bold uppercase text-[#74A626] truncate">
                <span>${book.category}</span>
                ${book.author ? `<span class="text-slate-400 font-normal">&bull;</span> <span class="text-slate-500 font-medium">${book.author}</span>` : ''}
              </div>
              <h4 class="text-xs font-serif font-bold text-slate-900 group-hover:text-[#74A626] transition-colors truncate mt-0.5" title="${book.title}">
                ${book.title}
              </h4>
              <div class="text-xs font-bold text-[#1C2518] mt-0.5">
                ${book.price_html}
              </div>
            </div>
            <div class="text-slate-400 group-hover:text-[#74A626] group-hover:translate-x-1 transition-all pl-2">
              <i class="fa-solid fa-chevron-right text-xs"></i>
            </div>
          </a>
        </div>
      `;
    });

    html += `
      </div>
      <div class="p-2.5 bg-slate-50 border-t border-slate-100 text-center">
        <a href="${search_url}" class="block text-xs font-bold text-[#74A626] hover:text-[#5E891C] hover:underline py-1">
          Ver todos los ${total} resultados para "${term}" &rarr;
        </a>
      </div>
    `;

    container.innerHTML = html;
    container.classList.remove('hidden');
  }
};

export default AjaxSearch;
