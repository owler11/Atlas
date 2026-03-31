/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Toggle
--------------------------------------------------------------*/

// 1.0 - Toggle
export function toggleSearch() {
    // Get the search toggle button
    const searchToggle = document.querySelector('[data-js="search-toggle"]');
    if (!searchToggle) return;

    // Get the search form
    const searchForm = document.querySelector('.site-header__search');
    if (!searchForm) return;

    // Toggle the search form when the search toggle button is clicked
    searchToggle.addEventListener('click', () => {
        searchForm.classList.toggle('active');
    });
}
