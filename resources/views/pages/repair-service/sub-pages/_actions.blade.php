<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click"
    data-kt-menu-placement="bottom-end">
    {{ __('Actions') }}
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
    data-kt-menu="true">
    <!--begin::Menu item-->
    @can('write offer')
        <div class="menu-item px-3">
            <a href="{{ route('admin-repair-service.sub-pages.edit', $page->id) }}" class="menu-link px-3">
                {{ __('Edit') }}
            </a>
        </div>
    @endcan

    <!--end::Menu item-->

    <!--begin::Menu item-->
    <!--begin::Menu item-->
    @can('delete offer')
        <div class="menu-item px-3">
            <a href="#" class="menu-link px-3"
                onclick="event.preventDefault(); 
            if(confirm('Are you sure you want to delete this?')) {
                document.getElementById('delete-page-{{ $page->id }}').submit();
            }">
                {{ __('Delete') }}
            </a>

            <form id="delete-page-{{ $page->id }}" action="{{ route('admin-repair-service.sub-pages.destroy', $page->id) }}"
                method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    @endcan



    <!--end::Menu item-->

    <!--end::Menu item-->
</div>
<!--end::Menu-->
