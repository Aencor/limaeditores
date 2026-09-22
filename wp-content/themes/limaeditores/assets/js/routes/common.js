
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
  },
  finalize() { }
};