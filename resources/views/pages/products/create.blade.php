<x-default-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header p-5 rounded-top">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if (isset($data->id) && !empty($data->id))
                            <h3 class="fw-bolder mb-0">{{ __('Edit Product') }}</h3>
                        @else
                            <h3 class="fw-bolder mb-0">{{ __('Create Product') }}</h3>
                        @endif
                        <a href="{{ route('admin-products.list') }}" class="btn btn-light btn-md">
                            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to Products List') }}
                        </a>
                    </div>
                </div>

                @php
                    $url = isset($data->id) ? route('admin-products.update', $data->id) : route('admin-products.store');
                @endphp

                <div class="card-body p-5">
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($data->id))
                            @method('PUT')
                        @endif
                        <div class="row">

                            <!-- Category -->
                            <div class="col-lg-4 mb-4">
                                <label for="category_id"
                                    class="form-label fw-semibold required">{{ __('Category') }}</label>
                                <select name="category_id" id="category_id" data-control="select2"
                                    class="form-select form-select-lg @error('category_id') is-invalid @enderror"
                                    required>
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $data->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- SKU -->
                            <div class="col-lg-4 mb-4">
                                <label for="sku" class="form-label fw-semibold">{{ __('SKU') }}</label>
                                <input type="text" id="sku" name="sku"
                                    class="form-control form-control-lg @error('sku') is-invalid @enderror"
                                    value="{{ old('sku', $data->sku ?? '') }}">
                                @error('sku')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Type -->
                            <div class="col-lg-2 mb-4">
                                <label for="type"
                                    class="form-label fw-semibold required">{{ __('Product For') }}</label>
                                <select name="type" id="type"
                                    class="form-select form-select-lg @error('type') is-invalid @enderror" required>
                                    <option value="for_store"
                                        {{ old('type', $data->type ?? 'for_store') == 'for_store' ? 'selected' : '' }}>
                                        {{ __('For Store') }}</option>
                                    <option value="for_rent"
                                        {{ old('type', $data->type ?? 'for_rent') == 'for_rent' ? 'selected' : '' }}>
                                        {{ __('For Rent') }}</option>

                                    <option value="both"
                                        {{ old('type', $data->type ?? 'both') == 'both' ? 'selected' : '' }}>
                                        {{ __('For Both') }}</option>
                                </select>
                                @error('type')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-2 mb-4">
                                <label for="product_type"
                                    class="form-label fw-semibold required">{{ __('Product Type') }}</label>

                                <select name="product_type" id="product_type"
                                    class="form-select form-select-lg @error('product_type') is-invalid @enderror"
                                    required>

                                    <option value="product"
                                        {{ old('product_type', $data->product_type ?? '') == 'product' ? 'selected' : '' }}>
                                        {{ __('Product') }}
                                    </option>

                                    <option value="part"
                                        {{ old('product_type', $data->product_type ?? '') == 'part' ? 'selected' : '' }}>
                                        {{ __('Part') }}
                                    </option>

                                </select>

                                @error('product_type')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Product Name -->
                            <div class="col-lg-12 mb-4">
                                <label for="name"
                                    class="form-label fw-semibold required">{{ __('Product Name') }}</label>
                                <input type="text" id="name" name="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    value="{{ old('name', $data->name ?? '') }}" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Slug -->
                            <div class="col-lg-12 mb-4">
                                <label for="slug"
                                    class="form-label fw-semibold required">{{ __('Product Slug') }}</label>
                                <input type="text" id="slug" name="slug"
                                    class="form-control form-control-lg @error('slug') is-invalid @enderror"
                                    value="{{ old('slug', $data->slug ?? '') }}" required>
                                @error('slug')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Short Description -->
                            <div class="col-lg-12 mb-4">
                                <label for="short_description"
                                    class="form-label fw-semibold">{{ __('Short Description') }}</label>
                                <textarea id="short_description" name="short_description"
                                    class="form-control form-control-lg @error('short_description') is-invalid @enderror" rows="3">{{ old('short_description', $data->short_description ?? '') }}</textarea>
                                @error('short_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-lg-12 mb-4">
                                <label for="description" class="form-label fw-semibold">{{ __('Description') }}</label>
                                <textarea id="product_description" name="description"
                                    class="ckeditor form-control form-control-lg @error('description') is-invalid @enderror" rows="5">{{ old('description', $data->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="col-lg-4 mb-4">
                                <label for="price" class="form-label fw-semibold">{{ __('Price ($)') }}</label>
                                <input type="number" step="0.01" min="0" id="price" name="price"
                                    class="form-control form-control-lg @error('price') is-invalid @enderror"
                                    value="{{ old('price', $data->price ?? 0) }}">
                                @error('price')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Discount Percent -->
                            <div class="col-lg-4 mb-4">
                                <label for="discount_percent"
                                    class="form-label fw-semibold">{{ __('Discount (%)') }}</label>
                                <input type="number" min="0" max="100" id="discount_percent"
                                    name="discount_percent"
                                    class="form-control form-control-lg @error('discount_percent') is-invalid @enderror"
                                    value="{{ old('discount_percent', $data->discount_percent ?? '') }}">
                                @error('discount_percent')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sale Price -->
                            <div class="col-lg-4 mb-4">
                                <label for="sale_price"
                                    class="form-label fw-semibold">{{ __('Sale Price ($)') }}</label>
                                <input type="number" step="0.01" min="0" id="sale_price"
                                    name="sale_price"
                                    class="form-control form-control-lg @error('sale_price') is-invalid @enderror"
                                    value="{{ old('sale_price', $data->sale_price ?? '') }}">
                                @error('sale_price')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stock Quantity -->
                            <div class="col-lg-3 mb-4">
                                <label for="stock_qty"
                                    class="form-label fw-semibold">{{ __('Stock Quantity') }}</label>
                                <input type="number" min="0" id="stock_qty" name="stock_qty"
                                    class="form-control form-control-lg @error('stock_qty') is-invalid @enderror"
                                    value="{{ old('stock_qty', $data->stock_qty ?? 0) }}">
                                @error('stock_qty')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- In Stock -->
                            <div class="col-lg-3 mb-4">
                                <label for="in_stock" class="form-label fw-semibold">{{ __('In Stock') }}</label>
                                <select name="in_stock" id="in_stock"
                                    class="form-select form-select-lg @error('in_stock') is-invalid @enderror">
                                    <option value="1"
                                        {{ old('in_stock', $data->in_stock ?? 1) == 1 ? 'selected' : '' }}>
                                        {{ __('Yes') }}</option>
                                    <option value="0"
                                        {{ old('in_stock', $data->in_stock ?? 1) == 0 ? 'selected' : '' }}>
                                        {{ __('No') }}</option>
                                </select>
                                @error('in_stock')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Is Active -->
                            <div class="col-lg-3 mb-4">
                                <label for="is_active" class="form-label fw-semibold">{{ __('Active') }}</label>
                                <select name="is_active" id="is_active"
                                    class="form-select form-select-lg @error('is_active') is-invalid @enderror">
                                    <option value="1"
                                        {{ old('is_active', $data->is_active ?? 1) == 1 ? 'selected' : '' }}>
                                        {{ __('Yes') }}</option>
                                    <option value="0"
                                        {{ old('is_active', $data->is_active ?? 1) == 0 ? 'selected' : '' }}>
                                        {{ __('No') }}</option>
                                </select>
                                @error('is_active')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Show on Header -->
                            <div class="col-lg-3 mb-4">
                                <label for="show_on_header"
                                    class="form-label fw-semibold">{{ __('Show on Header') }}</label>
                                <select name="show_on_header" id="show_on_header"
                                    class="form-select form-select-lg @error('show_on_header') is-invalid @enderror">
                                    <option value="1"
                                        {{ old('show_on_header', $data->show_on_header ?? 0) == 1 ? 'selected' : '' }}>
                                        {{ __('Yes') }}
                                    </option>
                                    <option value="0"
                                        {{ old('show_on_header', $data->show_on_header ?? 0) == 0 ? 'selected' : '' }}>
                                        {{ __('No') }}
                                    </option>
                                </select>
                                @error('show_on_header')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-3 mb-4">
                                <label for="condition" class="form-label fw-semibold">{{ __('Condition') }}</label>

                                <select name="condition" id="condition"
                                    class="form-select form-select-lg @error('condition') is-invalid @enderror">

                                    <option value="new"
                                        {{ old('condition', $data->condition ?? '') == 'new' ? 'selected' : '' }}>
                                        {{ __('New') }}
                                    </option>

                                    <option value="old"
                                        {{ old('condition', $data->condition ?? '') == 'old' ? 'selected' : '' }}>
                                        {{ __('Old') }}
                                    </option>

                                </select>

                                @error('condition')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-3 mb-4">
                                <label for="rating"
                                    class="form-label fw-semibold required">{{ __('Rating') }}</label>

                                <select name="rating" id="rating"
                                    class="form-select form-select-lg @error('rating') is-invalid @enderror">

                                    <option value="">Select Rating</option>

                                    <option value="1"
                                        {{ old('rating', $data->rating ?? '') == 1 ? 'selected' : '' }}>
                                        1 - Very Bad
                                    </option>

                                    <option value="2"
                                        {{ old('rating', $data->rating ?? '') == 2 ? 'selected' : '' }}>
                                        2 - Bad
                                    </option>

                                    <option value="3"
                                        {{ old('rating', $data->rating ?? '') == 3 ? 'selected' : '' }}>
                                        3 - Average
                                    </option>

                                    <option value="4"
                                        {{ old('rating', $data->rating ?? '') == 4 ? 'selected' : '' }}>
                                        4 - Good
                                    </option>

                                    <option value="5"
                                        {{ old('rating', $data->rating ?? '') == 5 ? 'selected' : '' }}>
                                        5 - Excellent
                                    </option>
                                </select>

                                @error('rating')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="availability"
                                    class="form-label fw-semibold">{{ __('Availability') }}</label>
                                <input type="text" id="availability" name="availability"
                                    class="form-control form-control-lg @error('availability') is-invalid @enderror"
                                    value="{{ old('availability', $data->availability ?? '') }}">
                                @error('availability')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label for="model" class="form-label fw-semibold">{{ __('Model') }}</label>
                                <input type="text" id="model" name="model"
                                    class="form-control form-control-lg @error('model') is-invalid @enderror"
                                    value="{{ old('model', $data->model ?? '') }}">
                                @error('model')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-8 mb-4">
                                <label for="brochures" class="form-label fw-semibold">{{ __('Brochures') }}</label>
                                <input type="file" id="brochures" name="brochures"
                                    class="form-control form-control-lg @error('brochures') is-invalid @enderror">
                                @error('brochures')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                {{-- Edit case: show existing file --}}
                                @if (!empty($data->brochures))
                                    <small class="d-block mt-2">
                                        <a href="{{ asset('storage/products/brochures/' . $data->brochures) }}"
                                            target="_blank">
                                            {{ __('View uploaded brochure') }}
                                        </a>
                                    </small>
                                @endif
                            </div>

                            <!-- Thumbnail -->
                            <div class="col-lg-12 mb-4">
                                <label for="thumbnail"
                                    class="form-label fw-semibold">{{ __('Thumbnail Image') }}</label>
                                <input type="file" id="thumbnail" name="thumbnail"
                                    class="form-control form-control-lg @error('thumbnail') is-invalid @enderror">
                                @if (isset($data->thumbnail) && $data->thumbnail)
                                    <img src="{{ asset('storage/products/thumbnails/' . $data->thumbnail) }}"
                                        alt="Thumbnail" class="img-thumbnail mt-2" width="100">
                                @endif
                                @error('thumbnail')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Gallery Images -->
                            <div class="col-lg-12 mb-4">
                                <label for="gallery_images"
                                    class="form-label fw-semibold">{{ __('Gallery Images') }}</label>
                                <input type="file" id="gallery_images" name="gallery_images[]"
                                    class="form-control form-control-lg @error('gallery_images') is-invalid @enderror"
                                    multiple>
                                @if (isset($data->gallery_images) && $data->gallery_images)
                                    @php
                                        $galleryImages = json_decode($data->gallery_images, true);
                                    @endphp

                                    @if (is_array($galleryImages))
                                        <div class="d-flex flex-wrap mt-2" id="gallery-images-wrapper">
                                            @foreach ($galleryImages as $img)
                                                <div class="text-center me-2 mb-2 gallery-image-item"
                                                    data-img="{{ $img }}">
                                                    <img src="{{ asset('storage/products/gallery/' . $img) }}"
                                                        alt="Gallery" class="img-thumbnail" width="80">
                                                    <br>
                                                    <span class="text-danger remove-gallery-image"
                                                        style="cursor:pointer; font-size:0.85rem;">
                                                        Remove
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif

                                @error('gallery_images')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label for="image_alt" class="form-label fw-semibold">{{ __('Image Alt') }}</label>
                                <input type="text" id="image_alt" name="image_alt"
                                    class="form-control form-control-lg @error('image_alt') is-invalid @enderror"
                                    value="{{ old('image_alt', $data->image_alt ?? '') }}">
                                @error('image_alt')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SEO -->
                            <div class="col-lg-6 mb-4">
                                <label for="meta_title"
                                    class="form-label fw-semibold">{{ __('Meta Title') }}</label>
                                <input type="text" id="meta_title" name="meta_title"
                                    class="form-control form-control-lg @error('meta_title') is-invalid @enderror"
                                    value="{{ old('meta_title', $data->meta_title ?? '') }}">
                                @error('meta_title')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="meta_keywords"
                                    class="form-label fw-semibold">{{ __('Meta Keywords') }}</label>
                                <input type="text" id="meta_keywords" name="meta_keywords"
                                    class="form-control form-control-lg @error('meta_keywords') is-invalid @enderror"
                                    value="{{ old('meta_keywords', $data->meta_keywords ?? '') }}">
                                @error('meta_keywords')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label for="meta_description"
                                    class="form-label fw-semibold">{{ __('Meta Description') }}</label>
                                <textarea id="meta_description" name="meta_description"
                                    class="form-control form-control-lg @error('meta_description') is-invalid @enderror" rows="3">{{ old('meta_description', $data->meta_description ?? '') }}</textarea>
                                @error('meta_description')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                @include('partials/general/_button-indicator', [
                                    'label' => isset($data->id) ? 'Update' : 'Create',
                                ])
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const priceInput = document.getElementById('price');
                const discountInput = document.getElementById('discount_percent');
                const salePriceInput = document.getElementById('sale_price');

                function calculateSalePrice() {
                    const price = parseFloat(priceInput.value) || 0;
                    const discount = parseFloat(discountInput.value) || 0;

                    // Ensure discount is between 0-100
                    const validDiscount = Math.min(Math.max(discount, 0), 100);

                    const salePrice = price - (price * validDiscount / 100);
                    salePriceInput.value = salePrice.toFixed(2); // show 2 decimal places
                }

                // Event listeners
                priceInput.addEventListener('input', calculateSalePrice);
                discountInput.addEventListener('input', calculateSalePrice);

                // Initial calculation if fields already have values
                calculateSalePrice();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // Thumbnail validation
                const thumbnailInput = document.getElementById('thumbnail');
                if (thumbnailInput) {
                    if (!document.getElementById('thumbnail_error')) {
                        let thumbError = document.createElement('div');
                        thumbError.id = 'thumbnail_error';
                        thumbError.classList.add('text-danger', 'mt-1');
                        thumbnailInput.parentNode.appendChild(thumbError);
                    }

                    thumbnailInput.addEventListener('change', function() {
                        validateFile(thumbnailInput, 'thumbnail_error');
                    });
                }

                // Gallery images validation
                const galleryInput = document.getElementById('gallery_images');
                if (galleryInput) {
                    if (!document.getElementById('gallery_images_error')) {
                        let galleryError = document.createElement('div');
                        galleryError.id = 'gallery_images_error';
                        galleryError.classList.add('text-danger', 'mt-1');
                        galleryInput.parentNode.appendChild(galleryError);
                    }

                    galleryInput.addEventListener('change', function() {
                        validateFile(galleryInput, 'gallery_images_error');
                    });
                }

            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Attach click event to all remove-gallery-image elements
                document.querySelectorAll('.remove-gallery-image').forEach(span => {
                    span.addEventListener('click', function() {
                        const container = this.closest('.gallery-image-item');
                        const imgName = container.getAttribute('data-img');
                        const productId = "{{ $data->id ?? 0 }}"; // Current product ID

                        if (!productId) return;

                        // Confirmation dialog
                        if (confirm(`Are you sure you want to remove this image?`)) {
                            // Send AJAX request to remove image
                            fetch("{{ route('admin-products.remove-gallery-image') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        product_id: productId,
                                        image: imgName
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        container.remove(); // Remove image from DOM
                                        toastr.success(data.message ||
                                            'Image removed successfully');
                                    } else {
                                        toastr.error(data.message || 'Something went wrong');
                                    }
                                })
                                .catch(err => {
                                    console.error(err);
                                    toastr.error('Error removing image');
                                });
                        }
                    });
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                ClassicEditor
                    .create(document.querySelector('#product_description'), {
                        ckfinder: {
                            uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}&dir=products/ckeditor"
                        }
                    })
                    .then(editor => {
                        console.log(`CKEditor initialized for #product_description`);
                    })
                    .catch(error => console.error(error));
            });
        </script>
    @endpush

</x-default-layout>
