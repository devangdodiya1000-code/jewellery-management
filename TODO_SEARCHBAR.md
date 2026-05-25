# TODO: Dynamic AJAX Search Bar

- [x] Inspect existing frontend header markup for search icon integration points.

- [x] Add frontend AJAX search endpoint in `HomeController`.
- [x] Add route in `routes/web.php` for the AJAX search.

- [x] Create partial view `resources/views/products/ajax_search_results.blade.php`.

- [x] Update `resources/views/frontend/index.blade.php`:

  - [x] Toggle full search input when clicking search icon

  - [x] Debounced AJAX call on input

  - [x] Render results dropdown under input

  - [x] Close dropdown on outside click / ESC

- [x] Verify search works end-to-end (no JS errors, results render, UX).


