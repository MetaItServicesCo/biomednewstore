<x-default-layout>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Orders List</h4>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

</x-default-layout>