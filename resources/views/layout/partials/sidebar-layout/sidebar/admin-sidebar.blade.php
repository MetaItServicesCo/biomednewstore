<div class="menu-item pt-5">
    <div class="menu-content">
        <span class="menu-heading fw-bold text-uppercase fs-7">Website</span>
    </div>
</div>
<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
    data-kt-menu="true" data-kt-menu-expand="false">
    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('dashboard', 'admin-category.*', 'admin-products.*', 'admin.product-feedback.*', 'admin.testimonials.*', 'admin.brand-we-carry.*', 'admin.feedback.*') ? 'here show' : '' }}">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
            <span class="menu-title">Dashboards</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        {{-- <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Default</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div> --}}
        <!--end:Menu sub-->

        @can('read landing page')
            <div class="menu-sub menu-sub-accordion">
                <!--begin:View All-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-landing-page.*') ? 'active' : '' }}"
                        href="{{ route('admin-landing-page.list') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('Landing Page') }}</span>
                    </a>
                </div>
                <!--end:View All-->
            </div>
        @endcan


        @can('read category')
            <div class="menu-sub menu-sub-accordion">
                <!--begin:View All-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-category.*') ? 'active' : '' }}"
                        href="{{ route('admin-category.list') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('Categories') }}</span>
                    </a>
                </div>
                <!--end:View All-->
            </div>
        @endcan

        @can('read product')
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-products.*') ? 'active' : '' }}"
                        href="{{ route('admin-products.list') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('Products') }}</span>
                    </a>
                </div>
            </div>
        @endcan

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.product-feedback.*') ? 'active' : '' }}"
                    href="{{ route('admin.product-feedback.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Product Feedback') }}</span>
                </a>
            </div>
        </div>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"
                    href="{{ route('admin.testimonials.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Testimonials') }}</span>
                </a>
            </div>
        </div>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.brand-we-carry.*') ? 'active' : '' }}"
                    href="{{ route('admin.brand-we-carry.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Brand We Carry</span>
                </a>
            </div>
        </div>

        @can('read faq')
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-faqs.*') ? 'active' : '' }}"
                        href="{{ route('admin-faqs.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('Create FAQs') }}</span>
                    </a>
                </div>
            </div>
        @endcan

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.feedback.*') ? 'active' : '' }}"
                    href="{{ route('admin.feedback.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Reviews List</span>
                </a>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <a class="menu-link" href="{{ route('orders.index') }}">
            <span class="menu-icon"><i class="ki-duotone ki-handcart fs-2x"></i></span>
            <span class="menu-title">Order</span>
        </a>
    </div>

     <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('admin.reviews.*') ? 'here show' : '' }}">
        <span class="menu-link">
            <span class="menu-icon"><i class="ki-duotone ki-tablet-text-down fs-2tx"><span
                        class="path1"></span><span class="path2"></span><span class="path3"></span><span
                        class="path4"></span></i>
                <i class="path1"></i>
                <i class="path2"></i>
                </i></span>
            <span class="menu-title">Reviews</span>
            <span class="menu-arrow"></span>
        </span>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}"
                    href="{{ route('admin.reviews.page') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Review Landing Page</span>
                </a>
            </div>
        </div>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.feedback.*') ? 'active' : '' }}"
                    href="{{ route('admin.feedback.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Reviews List</span>
                </a>
            </div>
        </div>
    </div>

    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('admin.contact-us.form.*', 'admin.services-request.form.*', 'admin.consultancy.*') ? 'here show' : '' }}">
        <span class="menu-link">
            <span class="menu-icon"><i class="ki-duotone ki-tablet-text-down fs-2tx"><span class="path1"></span><span
                        class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                <i class="path1"></i>
                <i class="path2"></i>
                </i></span>
            <span class="menu-title">Inquiries</span>
            <span class="menu-arrow"></span>
        </span>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.contact-us.form.*') ? 'active' : '' }}"
                    href="{{ route('admin.contact-us.form.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Contact Us Form</span>
                </a>
            </div>
        </div>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.services-request.form.*') ? 'active' : '' }}"
                    href="{{ route('admin.services-request.form.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Service Request</span>
                </a>
            </div>
        </div>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.consultancy.*') ? 'active' : '' }}"
                    href="{{ route('admin.consultancy.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Consultancy</span>
                </a>
            </div>
        </div>

    </div>

    @can('read general settings')
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ route('admin-general.settings') }}">
                <span class="menu-icon"><i class="ki-outline ki-gear fs-2x"></i></span>
                <span class="menu-title">General Setting</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endcan
</div>
