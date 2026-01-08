<section class="medical-equipment-section py-5">
    <div class="container">

        <!-- Heading – Hamesha DB se aayega -->
        <div class="row">
            <div class="col-8 mx-auto">
                <h2 class="equipment-heading text-center mb-">
                    {!! highlightBracketText(\App\Models\BiomedServices::first()?->product_heading ?? 'Our Rental Equipment') !!}
                </h2>
            </div>
        </div>

        <!-- 3 Columns List -->
        <div class="row justify-content-center">
            @foreach ($productColumns as $column)
                <div class="col-lg-4 col-md-6 mb-4">
                    <ul class="equipment-list">
                        @foreach ($column as $item)
                            <li>
                                <i class="bi bi-check yes-icon"></i>
                                <span>{{ $item->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        @if ($productColumns->isEmpty())
            <div class="text-center py-5 text-muted">
                No rental products available at the moment.
            </div>
        @endif

    </div>
</section>


<section class="medical-equipment-section py-5">
    <div class="container">

        <!-- Heading -->



    </div>
</section>
