  <div class="services-wrapper">

      <!-- SLIDE PANEL -->
      <div class="services-panel">
          <h4>Choose Your Rental Services</h4>

          @foreach (getServicesList() as $service)
              <p class="mb-1">
                  <a href="{{ route('biomed-services') }}" class="text-decoration-none">
                      {{ $service }}
                  </a>
              </p>
          @endforeach

          <a href="{{ route('biomed-services') }}">
              <button type="button" class="explore-btn">
                  Explore More
              </button>
          </a>

      </div>

      <!-- BUTTON + ICON GROUP -->
      <div class="services-toggle">

          <button class="services-btn">Services</button>

          <div class="arrow-icon">
              <img src="{{ asset('frontend/images/icon-img.png') }}" alt="">

          </div>

      </div>
  </div>
