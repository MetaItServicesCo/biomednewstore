<style>
    .main-wrapper {
        margin-bottom: 60px;
    }
</style>
<section>
    <h2 class="review-heading fade-left">Our Users Are <span>Happy And Healthy</span></h2>

    <div class="container">

        <div class="mx-auto main-wrapper" style="width:1100px;">

            <div class="swiper reviewSwiper">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide tooltip-slide">
                            <img src="{{ $testimonial->image ? asset('storage/testimonials/' . $testimonial->image) : '' }}"
                                alt="">
                            <div class="tooltip-box">
                                <div class="starss">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'active' : '' }}"></i>
                                    @endfor
                                </div>

                                <p><span class="quote">“</span> {{ $testimonial->short_description ?? '' }} </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
