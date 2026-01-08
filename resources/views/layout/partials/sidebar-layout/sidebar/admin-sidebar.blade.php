<div class="menu-item pt-5">
    <div class="menu-content">
        <span class="menu-heading fw-bold text-uppercase fs-7">Website</span>
    </div>
</div>
<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
    data-kt-menu="true" data-kt-menu-expand="false">
    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('dashboard', 'admin-category.*', 'admin-products.*', 'admin-offers.*', 'admin-oems.*', 'admin-privacy-policy.*', 'admin-terms-conditions.*', 'admin-disclaimer.*', 'admin.importent-links.*', 'admin-location-page.*', 'admin.serving-cities.*', 'admin-contact-us.*', 'admin.testimonials.*') ? 'here show' : '' }}">
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
                <!--begin:View All-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-products.*') ? 'active' : '' }}"
                        href="{{ route('admin-products.list') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('Products') }}</span>
                    </a>
                </div>
                <!--end:View All-->
            </div>
        @endcan

        @can('read offer')
            <div class="menu-sub menu-sub-accordion">
                <!--begin:View All-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-offers.*') ? 'active' : '' }}"
                        href="{{ route('admin-offers.list') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('Offers') }}</span>
                    </a>
                </div>
                <!--end:View All-->
            </div>
        @endcan

        @can('read oem')
            <div class="menu-sub menu-sub-accordion">
                <!--begin:View All-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-oems.*') ? 'active' : '' }}"
                        href="{{ route('admin-oems.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('OEMs') }}</span>
                    </a>
                </div>
                <!--end:View All-->
            </div>
        @endcan

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin-privacy-policy.*') ? 'active' : '' }}"
                    href="{{ route('admin-privacy-policy.page') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Privacy Policy') }}</span>
                </a>
            </div>
        </div>
        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin-terms-conditions.*') ? 'active' : '' }}"
                    href="{{ route('admin-terms-conditions.page') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Terms & Conditions') }}</span>
                </a>
            </div>
        </div>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin-disclaimer.*') ? 'active' : '' }}"
                    href="{{ route('admin-disclaimer.page') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Disclaimer') }}</span>
                </a>
            </div>
        </div>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.importent-links.*') ? 'active' : '' }}"
                    href="{{ route('admin.importent-links.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Importent Links') }}</span>
                </a>
            </div>
        </div>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin-location-page.*') ? 'active' : '' }}"
                    href="{{ route('admin-location-page.page') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Location Page') }}</span>
                </a>
            </div>
        </div>
        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.serving-cities.*') ? 'active' : '' }}"
                    href="{{ route('admin.serving-cities.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('City') }}</span>
                </a>
            </div>
        </div>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin-contact-us.*') ? 'active' : '' }}"
                    href="{{ route('admin-contact-us.page') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Contact US') }}</span>
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
    </div>

    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('admin.faqs-landing-page.*', 'admin-faqs.*') ? 'here show' : '' }}">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon"><i class="ki-duotone ki-wrench fs-2x">
                    <i class="path1"></i>
                    <i class="path2"></i>
                </i></span>
            <span class="menu-title">FAQs</span>
            <span class="menu-arrow"></span>
        </span>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.faqs-landing-page.*') ? 'active' : '' }}"
                    href="{{ route('admin.faqs-landing-page.page') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">FAQ Landing Page</span>
                </a>
            </div>
        </div>

        @can('read faq')
            <div class="menu-sub menu-sub-accordion">
                <!--begin:View All-->
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-faqs.*') ? 'active' : '' }}"
                        href="{{ route('admin-faqs.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{ __('Create FAQs') }}</span>
                    </a>
                </div>
                <!--end:View All-->
            </div>
        @endcan

    </div>

    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('admin-biomed-service-page.*') ? 'here show' : '' }}">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon"><i class="ki-duotone ki-wrench fs-2x">
                    <i class="path1"></i>
                    <i class="path2"></i>
                </i></span>
            <span class="menu-title">Services</span>
            <span class="menu-arrow"></span>
        </span>

        @can('read biomed service')
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-biomed-service-page.*') ? 'active' : '' }}"
                        href="{{ route('admin-biomed-service-page.main-page') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Biomed Service</span>
                    </a>
                </div>
            </div>
        @endcan

        @can('read rental service')
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-rental-service-page.*') ? 'active' : '' }}"
                        href="{{ route('admin-rental-service-page.main-page') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Rental Service</span>
                    </a>
                </div>
            </div>
        @endcan

    </div>

    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('admin-repair-service-page.*', 'admin-repair-service.sub-pages.*') ? 'here show' : '' }}">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon"><i class="ki-duotone ki-wrench fs-2x">
                    <i class="path1"></i>
                    <i class="path2"></i>
                </i></span>
            <span class="menu-title">Repair Service</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        @can('read repair service')
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-repair-service-page.*') ? 'active' : '' }}"
                        href="{{ route('admin-repair-service-page.main-page') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Repair Service</span>
                    </a>
                </div>
            </div>
        @endcan
        @can('read repair service sub page')
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-repair-service.sub-pages.*') ? 'active' : '' }}"
                        href="{{ route('admin-repair-service.sub-pages.list') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Sub Pages</span>
                    </a>
                </div>
            </div>
        @endcan

        <!--end:Menu sub-->
    </div>

    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('admin.about-us.main.*', 'admin.about-us.cards.*', 'admin.brand-we-carry.*', 'admin.what-we-do.*', 'admin.company-certification.*') ? 'here show' : '' }}">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon"><i class="ki-duotone ki-wrench fs-2x">
                    <i class="path1"></i>
                    <i class="path2"></i>
                </i></span>
            <span class="menu-title">About Us</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.about-us.main.*') ? 'active' : '' }}"
                    href="{{ route('admin.about-us.main.page') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">About Us</span>
                </a>
            </div>
        </div>
        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.about-us.cards.*') ? 'active' : '' }}"
                    href="{{ route('admin.about-us.cards.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Cards</span>
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

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.what-we-do.*') ? 'active' : '' }}"
                    href="{{ route('admin.what-we-do.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">What We Do</span>
                </a>
            </div>
        </div>

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.company-certification.*') ? 'active' : '' }}"
                    href="{{ route('admin.company-certification.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Certificate</span>
                </a>
            </div>
        </div>

        <!--end:Menu sub-->
    </div>

    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('admin.blog.main.*', 'admin-blogs.*', 'admin-blogs-comment.*') ? 'here show' : '' }}">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon"><i class="ki-duotone ki-tablet-text-down fs-2tx"><span
                        class="path1"></span><span class="path2"></span><span class="path3"></span><span
                        class="path4"></span></i>
                <i class="path1"></i>
                <i class="path2"></i>
                </i></span>
            <span class="menu-title">Blog</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        @can('read blog main page')
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.blog.main.*') ? 'active' : '' }}"
                        href="{{ route('admin.blog.main.page') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Blog Main Page</span>
                    </a>
                </div>
            </div>
        @endcan

        @can('read blogs')
            <div class="menu-sub menu-sub-accordion">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin-blogs.*') ? 'active' : '' }}"
                        href="{{ route('admin-blogs.list') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Create Blogs</span>
                    </a>
                </div>
            </div>
        @endcan

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin-blogs-comment.*') ? 'active' : '' }}"
                    href="{{ route('admin-blogs-comment.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Blog Comments</span>
                </a>
            </div>
        </div>
        <!--end:Menu sub-->
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

        {{-- <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin-blogs-comment.*') ? 'active' : '' }}"
                    href="{{ route('admin-blogs-comment.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Blog Comments</span>
                </a>
            </div>
        </div> --}}
    </div>

    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('admin.contact-us.form.*', 'admin.services-request.form.*', 'admin.consultancy.*', 'admin.buy.product.*') ? 'here show' : '' }}">
        <span class="menu-link">
            <span class="menu-icon"><i class="ki-duotone ki-tablet-text-down fs-2tx"><span
                        class="path1"></span><span class="path2"></span><span class="path3"></span><span
                        class="path4"></span></i>
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

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.buy.product.*') ? 'active' : '' }}"
                    href="{{ route('admin.buy.product.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Product</span>
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


    <div class="menu-item pt-5">
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">Apps</span>
        </div>
    </div>

    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('user-management.*') ? 'here show' : '' }}">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">{!! getIcon('abstract-28', 'fs-2') !!}</span>
            <span class="menu-title">User Management</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('user-management.users.*') ? 'active' : '' }}"
                    href="{{ route('user-management.users.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Users</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('user-management.roles.*') ? 'active' : '' }}"
                    href="{{ route('user-management.roles.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Roles</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link {{ request()->routeIs('user-management.permissions.*') ? 'active' : '' }}"
                    href="{{ route('user-management.permissions.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Permissions</span>
                </a>
                <!--end:Menu link-->
            </div>
            <!--end:Menu item-->
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item-->
    <!--begin:Menu item-->
    <div class="menu-item pt-5">
        <!--begin:Menu content-->
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">Help</span>
        </div>
        <!--end:Menu content-->
    </div>
    <!--end:Menu item-->
    <!--begin:Menu item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link" href="https://preview.keenthemes.com/html/metronic/docs/base/utilities" target="_blank">
            <span class="menu-icon">{!! getIcon('rocket', 'fs-2') !!}</span>
            <span class="menu-title">Components</span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->
    <!--begin:Menu item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link" href="https://preview.keenthemes.com/laravel/metronic/docs" target="_blank">
            <span class="menu-icon">{!! getIcon('abstract-26', 'fs-2') !!}</span>
            <span class="menu-title">Documentation</span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->
    <!--begin:Menu item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link" href="https://preview.keenthemes.com/laravel/metronic/docs/changelog" target="_blank">
            <span class="menu-icon">{!! getIcon('code', 'fs-2') !!}</span>
            <span class="menu-title">Changelog v8.2.8</span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->
</div>
