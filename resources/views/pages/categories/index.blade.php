<x-default-layout>

    @section('title')
        {{ __('Categories') }}
    @endsection


    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search"
                        class="form-control form-control-solid w-250px ps-13" placeholder="{{ __('Search Category') }}"
                        id="categorySearchInput" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    @can('create category')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_category">
                            {!! getIcon('plus', 'fs-2', '', 'i') !!}
                            {{ __('Add Category') }}
                        </button>
                    @endcan
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
        <!--end::Card body-->
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="kt_modal_add_category" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold mb-0">{{ __('Add Category') }}</h2>
                    <button type="button" class="btn btn-sm btn-icon" data-bs-dismiss="modal"
                        aria-label="{{ __('Close') }}">
                        {!! getIcon('cross', 'fs-2') !!}
                    </button>
                </div>

                <div class="modal-body px-5 py-4">
                    <form id="addCategoryForm">
                        @csrf

                        <!-- Category Name -->
                        <div class="mb-3">
                            <label class="form-label required">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="{{ __('Enter Category Name') }}">
                            <div class="text-danger mt-1 error-message" data-error-for="name"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">{{ __('Slug') }}</label>
                            <input type="text" name="slug" class="form-control"
                                placeholder="{{ __('Enter Category slug') }}">
                            <div class="text-danger mt-1 error-message" data-error-for="slug"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">{{ __('Status') }}</label>
                            <select name="status" class="form-control form-select">
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Inactive') }}</option>
                            </select>
                            <div class="text-danger mt-1 error-message" data-error-for="status"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Show on Header') }}</label>
                            <select name="show_on_header" class="form-control form-select">
                                <option value="1">{{ __('Yes') }}</option>
                                <option value="0" selected>{{ __('No') }}</option>
                            </select>
                            <div class="text-danger mt-1 error-message" data-error-for="show_on_header"></div>
                        </div>

                        <div class="text-end pt-4">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
                                {{ __('Discard') }}
                            </button>

                            <button type="submit" class="btn btn-primary">
                                @include('partials/general/_button-indicator', ['label' => __('Submit')])
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="kt_modal_edit_category" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold mb-0">{{ __('Edit Category') }}</h2>
                    <button type="button" class="btn btn-sm btn-icon" data-bs-dismiss="modal">
                        {!! getIcon('cross', 'fs-2') !!}
                    </button>
                </div>

                <div class="modal-body px-5 py-4">
                    <form id="editCategoryForm">
                        @csrf
                        <input type="hidden" name="id" id="edit_category_id">

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="edit_name" class="form-control">
                            <div class="text-danger mt-1 error-message" data-error-for="edit_name"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">{{ __('Slug') }}</label>
                            <input type="text" name="slug" id="edit_slug" class="form-control"
                                placeholder="{{ __('Enter Category slug') }}">
                            <div class="text-danger mt-1 error-message" data-error-for="edit_slug"></div>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label required">{{ __('Status') }}</label>
                            <select name="status" id="edit_status" class="form-control form-select">
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Inactive') }}</option>
                            </select>
                            <div class="text-danger mt-1 error-message" data-error-for="edit_status"></div>
                        </div>

                        <!-- Show on Header -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('Show on Header') }}</label>
                            <select name="show_on_header" id="edit_show_on_header" class="form-control form-select">
                                <option value="1">{{ __('Yes') }}</option>
                                <option value="0" selected>{{ __('No') }}</option>
                            </select>
                            <div class="text-danger mt-1 error-message" data-error-for="edit_show_on_header"></div>
                        </div>

                        <div class="text-end pt-4">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
                                {{ __('Discard') }}
                            </button>

                            <button type="submit" class="btn btn-primary">
                                @include('partials/general/_button-indicator', ['label' => __('Update')])
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    @push('scripts')
        {{ $dataTable->scripts() }}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Search Filter
                document.getElementById('categorySearchInput').addEventListener('keyup', function() {
                    window.LaravelDataTables['category-table'].search(this.value).draw();
                });
            });
        </script>

        <script>
            const updateUrlTemplate = "{{ route('admin-category.update', ['category' => ':id']) }}";
            const deleteUrlTemplate = "{{ route('admin-category.destroy', ['category' => ':id']) }}";

            document.addEventListener("DOMContentLoaded", function() {
                // Utility: CSRF token
                function getCsrfToken() {
                    const meta = document.querySelector('meta[name="csrf-token"]');
                    if (meta) return meta.getAttribute('content');
                    const input = document.querySelector('input[name="_token"]');
                    return input ? input.value : '';
                }

                // Base URLs: prefer window vars, then data attrs on body, then sensible default '/category'
                function getCategoryBaseUrl() {
                    if (window.categoryBaseUrl) return String(window.categoryBaseUrl).replace(/\/$/, '');
                    const el = document.querySelector('body[data-category-base-url]');
                    if (el) return String(el.dataset.categoryBaseUrl).replace(/\/$/, '');
                    return '/category';
                }

                function getCategoryStoreUrl() {
                    if (window.categoryStoreUrl) return String(window.categoryStoreUrl);
                    const el = document.querySelector('body[data-category-store-url]');
                    if (el) return String(el.dataset.categoryStoreUrl);
                    // fallback to POST to baseUrl
                    return getCategoryBaseUrl();
                }

                const csrfToken = getCsrfToken();
                const baseUrl = getCategoryBaseUrl();

                const addForm = document.getElementById('addCategoryForm');
                const editForm = document.getElementById('editCategoryForm');
                const addModalEl = document.getElementById('kt_modal_add_category');
                const editModalEl = document.getElementById('kt_modal_edit_category');

                // Clear errors helper
                function clearErrors(form) {
                    if (!form) return;
                    form.querySelectorAll('.error-message').forEach(el => el.innerHTML = '');
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                }

                // Show validation errors under fields. Supports keys like "name" / "status" and maps to "edit_name" too.
                function showValidationErrors(form, errors) {
                    if (!form || !errors) return;
                    Object.keys(errors).forEach(key => {
                        const msg = Array.isArray(errors[key]) ? errors[key][0] : errors[key];

                        // possible data-error-for values to check
                        const candidates = [
                            key,
                            key.replace(/\./g, '_'),
                            `edit_${key}`,
                            `edit_${key.replace(/\./g, '_')}`
                        ];

                        // find error container
                        let errorEl = null;
                        for (let c of candidates) {
                            errorEl = form.querySelector(`[data-error-for="${c}"]`);
                            if (errorEl) break;
                        }
                        if (errorEl) errorEl.innerHTML = msg;

                        // find input/select by name or id (also check prefixed edit_ name)
                        let input =
                            form.querySelector(`[name="${key}"]`) ||
                            form.querySelector(`#${key}`) ||
                            form.querySelector(`[name="edit_${key}"]`) ||
                            form.querySelector(`#edit_${key}`) ||
                            form.querySelector(`[name="${key.replace(/\./g, '_')}"]`);
                        if (input) input.classList.add('is-invalid');
                    });
                }

                // Reload DataTable (works with yajra/laravel-datatables or custom global)
                function reloadCategoryTable() {
                    try {
                        if (window.LaravelDataTables && window.LaravelDataTables['category-table']) {
                            window.LaravelDataTables['category-table'].ajax.reload(null, false);
                            return;
                        }
                        if (window.categoryDataTable && typeof window.categoryDataTable.draw === 'function') {
                            window.categoryDataTable.draw(false);
                            return;
                        }
                        console.warn(
                            'DataTable instance not found: ensure window.LaravelDataTables["category-table"] exists.'
                        );
                    } catch (err) {
                        console.error('reloadCategoryTable error:', err);
                    }
                }

                // Reset modal forms when hidden (Bootstrap 5)
                function setupModalReset(modalEl, formEl) {
                    if (!modalEl || !formEl) return;
                    modalEl.addEventListener('hidden.bs.modal', function() {
                        formEl.reset();
                        clearErrors(formEl);
                    });
                }
                setupModalReset(addModalEl, addForm);
                setupModalReset(editModalEl, editForm);

                // CREATE
                if (addForm) {
                    addForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        clearErrors(addForm);
                        const fd = new FormData(addForm);

                        fetch(`{{ route('admin-category.store') }}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: fd
                            })
                            .then(async res => {
                                const json = await safeParseJson(res);
                                if (!res.ok) {
                                    if (res.status === 422 && json && json.errors) {
                                        showValidationErrors(addForm, json.errors);
                                        return;
                                    }
                                    throw {
                                        res,
                                        json
                                    };
                                }
                                // success
                                reloadCategoryTable();
                                if (json && json.message) toastr.success(json.message);
                                const bs = bootstrap.Modal.getInstance(addModalEl);
                                if (bs) bs.hide();
                            })
                            .catch(err => {
                                console.error('Create request failed:', err);
                                toastr.error('An error occurred while creating category.');
                            });
                    });
                }

                // OPEN EDIT modal & populate fields (delegated)
                document.addEventListener('click', function(e) {
                    const btn = e.target.closest(
                        '.edit-category-btn, [data-action="edit-category"], [data-id][data-name]');
                    if (!btn) return;
                    if (!editForm) {
                        console.error('Edit form not found.');
                        return;
                    }

                    // read values from button dataset (many naming variants supported)
                    const id = btn.dataset.id || btn.dataset.categoryId || btn.dataset.ktCategoryId;
                    const name = (btn.dataset.name || btn.dataset.categoryName || '').trim();
                    const slug = (btn.dataset.slug || '').trim();
                    const status = (typeof btn.dataset.status !== 'undefined') ? btn.dataset.status : btn
                        .dataset.categoryStatus;
                    const showOnHeader = (typeof btn.dataset.showOnHeader !== 'undefined') ? btn.dataset
                        .showOnHeader : btn.dataset.showOnHeaderValue;
                    const showHeaderSelect = editForm.querySelector('select[name="show_on_header"]') || editForm
                        .querySelector('#edit_show_on_header');


                    console.log('Edit button dataset:', btn.dataset);

                    if (!id) console.warn(
                        'Edit: id not found on button dataset. Expected data-id / data-category-id.');
                    if (name === '') console.warn('Edit: name appears empty in dataset.');
                    if (typeof status === 'undefined') console.warn('Edit: status missing in dataset.');

                    // populate form
                    const idInput = editForm.querySelector('input[name="id"]') || editForm.querySelector(
                        '#edit_category_id');
                    const nameInput = editForm.querySelector('input[name="name"]') || editForm.querySelector(
                        '#edit_name');
                    const slugInput = editForm.querySelector('input[name="slug"]') || editForm.querySelector(
                        '#edit_slug');

                    const statusSelect = editForm.querySelector('select[name="status"]') || editForm
                        .querySelector('#edit_status');

                    if (idInput) idInput.value = id || '';
                    if (nameInput) nameInput.value = name || '';
                    if (slugInput) slugInput.value = slug || '';
                    if (statusSelect) {
                        if (typeof status !== 'undefined' && status !== null) {
                            statusSelect.value = String(status);
                            // fallback: select matching option
                            if (String(statusSelect.value) !== String(status)) {
                                for (let i = 0; i < statusSelect.options.length; i++) {
                                    if (statusSelect.options[i].value == status) {
                                        statusSelect.selectedIndex = i;
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    // populate show_on_header
                    if (showHeaderSelect && typeof showOnHeader !== 'undefined' && showOnHeader !== null) {
                        showHeaderSelect.value = String(showOnHeader);
                        if (String(showHeaderSelect.value) !== String(showOnHeader)) {
                            for (let i = 0; i < showHeaderSelect.options.length; i++) {
                                if (showHeaderSelect.options[i].value == showOnHeader) {
                                    showHeaderSelect.selectedIndex = i;
                                    break;
                                }
                            }
                        }
                    }

                    clearErrors(editForm);
                    bootstrap.Modal.getOrCreateInstance(editModalEl).show();
                });

                // UPDATE
                if (editForm) {
                    editForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        clearErrors(editForm);

                        const idEl = editForm.querySelector('input[name="id"]') || editForm.querySelector(
                            '#edit_category_id');
                        const id = idEl ? idEl.value : null;
                        if (!id) {
                            console.error('Update: missing category id in edit form.');
                            toastr.error('Category ID missing. Cannot update.');
                            return;
                        }

                        const fd = new FormData(editForm);
                        const updateUrl = updateUrlTemplate.replace(':id', id);

                        fetch(updateUrl, {
                                method: 'POST', // Laravel: method override
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'X-HTTP-Method-Override': 'PUT'
                                },
                                body: fd
                            })
                            .then(async res => {
                                const json = await safeParseJson(res);
                                if (!res.ok) {
                                    if (res.status === 422 && json && json.errors) {
                                        showValidationErrors(editForm, json.errors);
                                        return;
                                    }
                                    throw {
                                        res,
                                        json
                                    };
                                }
                                reloadCategoryTable();
                                if (json && json.message) toastr.success(json.message);
                                const bs = bootstrap.Modal.getInstance(editModalEl);
                                if (bs) bs.hide();
                            })
                            .catch(err => {
                                console.error('Update request failed:', err);
                                toastr.error('An error occurred while updating category.');
                            });
                    });
                }

                // DELETE (delegated)
                document.addEventListener('click', function(e) {
                    const btn = e.target.closest(
                        '[data-kt-action="delete_category"], .delete-category-btn, [data-action="delete-category"]'
                    );
                    if (!btn) return;
                    e.preventDefault();

                    const id = btn.dataset.ktCategoryId || btn.dataset.id || btn.dataset.categoryId;
                    if (!id) {
                        console.error('Delete: missing id on delete button.');
                        toastr.error('Category ID missing. Cannot delete.');
                        return;
                    }
                    const deleteUrl = deleteUrlTemplate.replace(':id', id);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then(result => {
                        if (!result.isConfirmed) return;
                        fetch(deleteUrl, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'X-HTTP-Method-Override': 'DELETE'
                                }
                            })
                            .then(async res => {
                                const json = await safeParseJson(res);
                                if (!res.ok) throw {
                                    res,
                                    json
                                };
                                if (json && json.success) {
                                    reloadCategoryTable();
                                    if (json.message) toastr.success(json.message);
                                } else {
                                    toastr.error(json && json.message ? json.message :
                                        'Delete failed.');
                                    console.warn('Delete response:', json);
                                }
                            })
                            .catch(err => {
                                console.error('Delete request failed:', err);
                                toastr.error('An error occurred while deleting category.');
                            });
                    });
                });

                // Safe JSON parse helper (handles empty responses)
                async function safeParseJson(response) {
                    try {
                        return await response.json();
                    } catch (e) {
                        return null;
                    }
                }

                // Debug message if datatable missing
                if (!(window.LaravelDataTables && window.LaravelDataTables['category-table'])) {
                    console.info('Note: window.LaravelDataTables["category-table"] not found at load time.');
                }
            });
        </script>
    @endpush

</x-default-layout>
