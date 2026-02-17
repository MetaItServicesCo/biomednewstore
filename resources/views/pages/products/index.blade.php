<x-default-layout>

    @section('title')
        {{ __('Products') }}
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
                        class="form-control form-control-solid w-250px ps-13" placeholder="{{ __('Search Product') }}"
                        id="productSearchInput" />
                    <button type="button" class="btn btn-sm btn-icon btn-clear-search position-absolute end-0 me-2" 
                        id="clearProductSearch" style="display: none;" title="Clear search">
                        <i class="fa fa-times fs-4"></i>
                    </button>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                @can('create product')
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <a href="{{ route('admin-products.create') }}" class="btn btn-primary">
                            {!! getIcon('plus', 'fs-2', '', 'i') !!}
                            {{ __('Add Product') }}
                        </a>
                    </div>
                @endcan

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


    @push('scripts')
        {{ $dataTable->scripts() }}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('productSearchInput');
                const clearBtn = document.getElementById('clearProductSearch');

                // Toggle clear button visibility
                function toggleClearButton() {
                    if (searchInput.value.trim() !== '') {
                        clearBtn.style.display = 'block';
                    } else {
                        clearBtn.style.display = 'none';
                    }
                }

                // Clear search
                clearBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    clearBtn.style.display = 'none';
                    window.LaravelDataTables['product-table'].search('').draw();
                });

                // Monitor input changes
                searchInput.addEventListener('input', toggleClearButton);

                // Search Filter
                searchInput.addEventListener('keyup', function() {
                    window.LaravelDataTables['product-table'].search(this.value).draw();
                });
            });
        </script>
    @endpush
</x-default-layout>
