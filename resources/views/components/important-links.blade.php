 @if ($links->count() > 0)
     <section class="important-links-section py-5">
         <div class="container">
             <h2 class="links-heading">Important Links</h2>

             <div class="row g-4 justify-content-center">
                 <!--Column -->
                 @foreach ($links as $link)
                     <div class="col-lg-4 col-md-6  ">
                         <div class="policy-card">
                             <h4 class="card-title">{{ \Illuminate\Support\Str::limit($link->title ?? '', 50) }}</h4>
                             <p class="card-desc">
                                 {{ \Illuminate\Support\Str::limit($link->subtitle ?? '', 120) }}
                             </p>
                             <a href="#" class="custom-btn">
                                 {{ $link->button_text ?? '' }} @if ($link->icon)
                                     <i class="{{ $link->icon }}"></i>
                                 @endif
                             </a>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </section>
 @endif
