<x-default-layout>

    @section('title')
        {{ __('Blog Comments') }}
    @endsection


    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search"
                        class="form-control form-control-solid w-250px ps-13" placeholder="{{ __('Search') }}"
                        id="blogcommentsSearchInput" />
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    {{-- <a href="#" class="btn btn-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        {{ __('Add Comment') }}
                    </a> --}}
                </div>
            </div>
        </div>

        <div class="card-body py-4">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>

    </div>


    @push('scripts')
        {{ $dataTable->scripts() }}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Search Filter
                document.getElementById('blogcommentsSearchInput').addEventListener('keyup', function() {
                    window.LaravelDataTables['blogcomment-table'].search(this.value).draw();
                });
            });
        </script>
    @endpush
</x-default-layout>
