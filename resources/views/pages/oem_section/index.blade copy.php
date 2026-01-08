<x-default-layout>

    @section('title')
        {{ __('Why OEMS Trust Section') }}
    @endsection

    <form action="{{ route('admin-oems.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div id="sections-container">

            @if ($items->count() == 0)
                @php $items = collect([new \App\Models\OemContent]); @endphp
            @endif

            @foreach ($items as $index => $item)
                <div class="trust-section mb-5 border p-3 position-relative">

                    <span class="remove-section text-danger"
                        style="cursor:pointer; position:absolute; top:10px; right:10px; font-size:22px;">
                        {!! getIcon('trash', 'fs-1') !!}
                    </span>

                    <h4>Section</h4>

                    <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id ?? '' }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Title</label>
                            <input type="text" name="items[{{ $index }}][title]" class="form-control"
                                value="{{ old("items.$index.title", $item->title ?? '') }}">
                            @error("items.$index.title")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Order</label>
                            <input type="number" name="items[{{ $index }}][order]" class="form-control"
                                value="{{ old("items.$index.order", $item->order ?? 1) }}">
                            @error("items.$index.order")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="items[{{ $index }}][image]" class="form-control">
                            @if (isset($item->image) && $item->image)
                                <img src="{{ asset('storage/oems-images/' . $item->image) }}" width="120"
                                    class="mt-2 mb-2">
                            @endif
                            @error("items.$index.image")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Image Alt</label>
                            <input type="text" name="items[{{ $index }}][image_alt]" class="form-control"
                                value="{{ old("items.$index.image_alt", $item->image_alt ?? '') }}">
                            @error("items.$index.image_alt")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label>Description</label>
                            <textarea name="items[{{ $index }}][description]" class="form-control ckeditor">{{ old("items.$index.description", $item->description ?? '') }}</textarea>
                            @error("items.$index.description")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="items[{{ $index }}][meta_title]" class="form-control"
                                value="{{ old("items.$index.meta_title", $item->meta_title ?? '') }}">
                            @error("items.$index.meta_title")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Meta Keywords</label>
                            <input type="text" name="items[{{ $index }}][meta_keywords]" class="form-control"
                                value="{{ old("items.$index.meta_keywords", $item->meta_keywords ?? '') }}">
                            @error("items.$index.meta_keywords")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label>Meta Description</label>
                            <textarea name="items[{{ $index }}][meta_description]" class="form-control">{{ old("items.$index.meta_description", $item->meta_description ?? '') }}</textarea>
                            @error("items.$index.meta_description")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4 p-3 border-top">
            <button type="button" id="add-section" class="btn btn-primary">+ Add More</button>
            <button type="submit" class="btn btn-success">Save Sections</button>
        </div>

    </form>


    {{-- TEMPLATE --}}
    <div id="section-template" class="d-none">
        <div class="trust-section mb-5 border p-3 position-relative">

            <span class="remove-section text-danger"
                style="cursor:pointer; position:absolute; top:10px; right:10px; font-size:22px;">
                {!! getIcon('trash', 'fs-1') !!}
            </span>

            <h4>Section</h4>

            <input type="hidden" name="items[INDEX][id]" value="">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" name="items[INDEX][title]" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Order</label>
                    <input type="number" name="items[INDEX][order]" class="form-control" value="1">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Image</label>
                    <input type="file" name="items[INDEX][image]" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Image Alt</label>
                    <input type="text" name="items[INDEX][image_alt]" class="form-control">
                </div>

                <div class="col-12 mb-3">
                    <label>Description</label>
                    <textarea name="items[INDEX][description]" class="form-control ckeditor"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Meta Title</label>
                    <input type="text" name="items[INDEX][meta_title]" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Meta Keywords</label>
                    <input type="text" name="items[INDEX][meta_keywords]" class="form-control">
                </div>

                <div class="col-12 mb-3">
                    <label>Meta Description</label>
                    <textarea name="items[INDEX][meta_description]" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                let editors = {};
                let index = {{ $items->count() }};

                // Initialize CKEditor for a textarea
                function initEditor(el) {
                    if (el.dataset.editor === "1") return; // already initialized
                    ClassicEditor.create(el)
                        .then(editor => {
                            editors[el.name] = editor;
                            el.dataset.editor = "1";
                        })
                        .catch(console.error);
                }

                // Initialize CKEditor for existing sections
                document.querySelectorAll('.ckeditor').forEach(el => initEditor(el));

                // --------------------------
                // ADD NEW SECTION
                // --------------------------
                document.getElementById('add-section').onclick = function() {
                    let html = document.getElementById('section-template').innerHTML;
                    html = html.replace(/INDEX/g, index);
                    document.getElementById('sections-container').insertAdjacentHTML('beforeend', html);

                    // Initialize CKEditors in the newly added section
                    const newSection = document.querySelector(`#sections-container .trust-section:last-child`);
                    newSection.querySelectorAll('textarea.ckeditor').forEach(el => initEditor(el));

                    index++;
                };

                // --------------------------
                // REMOVE SECTION
                // --------------------------
                document.addEventListener('click', function(e) {
                    let btn = e.target.closest('.remove-section');
                    if (!btn) return;

                    let section = btn.closest('.trust-section');

                    // Destroy CKEditor instances in this section
                    section.querySelectorAll('textarea.ckeditor').forEach(el => {
                        if (editors[el.name]) {
                            editors[el.name].destroy();
                            delete editors[el.name];
                        }
                    });

                    section.remove();
                });

                // --------------------------
                // BEFORE SUBMIT — REINDEX + FIX CKEDITOR VALUES
                // --------------------------
                document.querySelector('form').addEventListener('submit', function() {
                    // Push CKEditor data into original textarea
                    Object.keys(editors).forEach(key => {
                        try {
                            const editor = editors[key];
                            let textarea = document.querySelector(`textarea[name="${key}"]`);
                            if (editor && textarea) {
                                textarea.value = editor.getData();
                            }
                        } catch (e) {
                            console.error(e);
                        }
                    });

                    // Reindex all input names
                    const sections = document.querySelectorAll('.trust-section');
                    let newIndex = 0;
                    sections.forEach(section => {
                        section.querySelectorAll('input, textarea, select').forEach(el => {
                            if (!el.name) return;
                            const match = el.name.match(/^items\[\d+\](.*)$/);
                            if (!match) return;

                            const suffix = match[1];
                            const newName = `items[${newIndex}]${suffix}`;

                            // Update CKEditor reference key if needed
                            if (el.classList.contains('ckeditor') && editors[el.name]) {
                                editors[newName] = editors[el.name];
                                delete editors[el.name];
                            }

                            el.name = newName;
                        });
                        newIndex++;
                    });
                });

            });
        </script>
    @endpush



</x-default-layout>
