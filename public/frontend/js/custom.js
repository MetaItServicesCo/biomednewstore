document.addEventListener('DOMContentLoaded', () => {

    const servicesBtn = document.querySelector('.services-btn');
    const panel = document.querySelector('.services-panel');

    // Button click → toggle panel
    servicesBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // 👈 bahir wale click se roko
        panel.classList.toggle('active');
    });

    // Panel ke andar click → panel close na ho
    panel.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    // Bahir kahin bhi click → panel hide
    document.addEventListener('click', () => {
        panel.classList.remove('active');
    });

});

let footerCaptchaWidgetId = null;

document.addEventListener('DOMContentLoaded', function () {
    if (typeof grecaptcha !== 'undefined') {
        footerCaptchaWidgetId = grecaptcha.render('footerCaptcha', {
            sitekey: document.getElementById('footerCaptcha').dataset.sitekey
        });
    }
});

function resetFooterCaptcha() {
    if (typeof grecaptcha !== 'undefined' && footerCaptchaWidgetId !== null) {
        grecaptcha.reset(footerCaptchaWidgetId);
    }
}

let contactFormCaptchaWidgetId = null;

document.addEventListener('DOMContentLoaded', function () {
    const captchaEl = document.getElementById('contactFormCaptcha'); // check element
    if (captchaEl && typeof grecaptcha !== 'undefined') {
        contactFormCaptchaWidgetId = grecaptcha.render(captchaEl, {
            sitekey: captchaEl.dataset.sitekey
        });
    }
});


function resetContactFormCaptcha() {
    if (typeof grecaptcha !== 'undefined' && contactFormCaptchaWidgetId !== null) {
        grecaptcha.reset(contactFormCaptchaWidgetId);
    }
}

$(document).ready(function () {

    $(document).on('submit', '.contact-us-form', function (e) {
        e.preventDefault();

        let form = $(this);

        // Clear previous errors ONLY inside this form
        form.find('.error-text').text('');
        form.find('.invalid-feedback').remove();

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            dataType: 'json',

            success: function (response) {
                if (response.success) {
                    form[0].reset();
                    resetFooterCaptcha();
                    resetContactFormCaptcha();

                    // Reset captcha for THIS form
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset();
                    }

                    if (typeof toastr !== 'undefined') {
                        toastr.success(response.message);
                    } else {
                        alert(response.message);
                    }
                }
            },

            error: function (xhr) {

                resetFooterCaptcha();
                resetContactFormCaptcha();

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let errorField = form.find('.' + key + '_error');

                        if (errorField.length) {
                            errorField.text(value[0]);
                        } else {
                            // For captcha or non-input errors
                            form.find('[name="' + key + '"]').after(
                                '<div class="invalid-feedback d-block">' + value[0] + '</div>'
                            );
                        }
                    });

                    if (typeof toastr !== 'undefined') {
                        toastr.error('Please fix the errors in the form.');
                    }

                } else {
                    if (typeof toastr !== 'undefined') {
                        toastr.error('Something went wrong. Please try again later.');
                    } else {
                        alert('Something went wrong. Please try again later.');
                    }
                }
            }
        });
    });

});

//Servies Modal JS
document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('serviceModal');
    if (!modal) return;

    const closeBtn = modal.querySelector('.service-modal-close');
    const form = document.getElementById('serviceRequestForm');

    // Function to clear errors
    const clearErrors = () => {
        modal.querySelectorAll('.error-text').forEach(span => {
            span.textContent = '';
        });
    };

    // Function to reset form fields
    const resetForm = () => {
        form.reset();
        if (window.grecaptcha) {
            grecaptcha.reset(); // reset reCAPTCHA
        }
    };

    // OPEN MODAL
    document.body.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-open-service-modal]');
        if (btn) {
            modal.classList.add('active');
        }

        // CLOSE MODAL (X button)
        if (e.target === closeBtn) {
            modal.classList.remove('active');
            clearErrors();
            resetForm();
        }

        // CLOSE MODAL (click outside modal box)
        if (e.target === modal) {
            modal.classList.remove('active');
            clearErrors();
            resetForm();
        }
    });

    // AJAX FORM SUBMISSION
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        clearErrors(); // remove old errors

        const formData = new FormData(form);
        const actionUrl = form.getAttribute('action');

        fetch(actionUrl, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
            .then(async response => {
                const data = await response.json();

                if (!response.ok) {
                    // Handle validation errors (422)
                    if (response.status === 422 && data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const errorSpan = form.querySelector(`.${key}_error`);
                            if (errorSpan) {
                                errorSpan.textContent = data.errors[key][0];
                            }
                        });
                    } else {
                        // Server error
                        alert(data.message || 'Something went wrong. Please try again later.');
                    }
                } else if (data.success) {
                    // Success
                    resetForm();
                    modal.classList.remove('active');

                    // Show toast
                    if (typeof toastr !== 'undefined') {
                        toastr.success(data.message);
                    } else {
                        alert(data.message);
                    }
                }
            })
            .catch(err => {
                console.error('AJAX error:', err);
                alert('Something went wrong. Please try again later.');
            });
    });

});

let getQuoteCaptchaWidgetId = null;

document.addEventListener('DOMContentLoaded', function () {
    if (typeof grecaptcha !== 'undefined') {
        getQuoteCaptchaWidgetId = grecaptcha.render('getQuoteCaptcha', {
            sitekey: document.getElementById('getQuoteCaptcha').dataset.sitekey
        });
    }
});


document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('getAQuoteFormOverlay');
    if (!modal) return;

    const closeBtn = modal.querySelector('.close-form');
    const form = modal.querySelector('#getAQuoteForm');

    /* ================= HELPERS ================= */

    // Clear validation errors
    const clearErrors = () => {
        modal.querySelectorAll('.error-text').forEach(el => {
            el.textContent = '';
        });

        modal.querySelectorAll('.invalid-feedback').forEach(el => {
            el.remove();
        });
    };

    const resetCaptcha = () => {
        if (typeof grecaptcha !== 'undefined' && getQuoteCaptchaWidgetId !== null) {
            grecaptcha.reset(getQuoteCaptchaWidgetId);
        }
    };

    // Reset form fields
    const resetForm = () => {
        if (form) form.reset();

        if (window.grecaptcha) {
            grecaptcha.reset();
        }
    };

    // Show field errors under inputs
    const showErrors = (errors) => {
        Object.keys(errors).forEach(key => {

            const errorClass = key.replace(/\./g, '-') + '_error';
            const errorEl = form.querySelector('.' + errorClass);

            if (errorEl) {
                errorEl.textContent = errors[key][0];
            } else {
                const input = form.querySelector(`[name="${key}"]`);
                if (input) {
                    const div = document.createElement('div');
                    div.className = 'invalid-feedback d-block';
                    div.textContent = errors[key][0];
                    input.after(div);
                }
            }
        });
    };

    /* ================= OPEN / CLOSE MODAL ================= */

    document.body.addEventListener('click', (e) => {

        // OPEN MODAL
        const openBtn = e.target.closest('[data-open-get-quote]');
        if (openBtn) {
            e.preventDefault();
            modal.classList.add('active');
            resetCaptcha();
            return;
        }

        // CLOSE MODAL (X button)
        if (e.target === closeBtn) {
            modal.classList.remove('active');
            clearErrors();
            resetForm();
            return;
        }

        // CLOSE MODAL (outside click)
        if (e.target === modal) {
            modal.classList.remove('active');
            clearErrors();
            resetForm();
        }
    });

    /* ================= SUBMIT FORM (AJAX) ================= */

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        clearErrors();

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
            .then(async response => {

                // Validation error
                if (response.status === 422) {
                    const data = await response.json();
                    showErrors(data.errors);
                    resetCaptcha();

                    if (window.toastr) {
                        toastr.error('Please fix the errors in the form.');
                    }
                    return;
                }

                // Server error
                if (!response.ok) {
                    throw new Error('Server error');
                }

                return response.json();
            })
            .then(data => {
                if (!data) return;

                if (data.success) {

                    resetForm();
                    modal.classList.remove('active');

                    if (window.toastr) {
                        toastr.success(data.message);
                    } else {
                        alert(data.message);
                    }
                }
            })
            .catch(() => {
                resetCaptcha();
                if (window.toastr) {
                    toastr.error('Something went wrong. Please try again later.');
                } else {
                    alert('Something went wrong. Please try again later.');
                }
            });
    });

});




document.addEventListener('DOMContentLoaded', () => {

    const btn = document.getElementById('getProposalBtn');
    const footer = document.getElementById('footerSection');

    if (!btn || !footer) return;

    btn.addEventListener('click', (e) => {
        e.preventDefault();
        footer.scrollIntoView({ behavior: 'smooth' });
    });
});


// ================ review slider function ======================
function initReviewSlider() {

    const sliderEl = document.querySelector(".reviewSwiper");

    // Agar page me slider exist nahi karta → function stop
    if (!sliderEl) return;

    var swiper = new Swiper(".reviewSwiper", {
        slidesPerView: 5,
        spaceBetween: 40,
        centeredSlides: true,
        loop: true,
        speed: 5000,

        autoplay: {
            delay: 10,
            disableOnInteraction: false,
            reverseDirection: true,
        },

        on: {
            click(swiper) {
                swiper.slideTo(swiper.clickedIndex, 900);
            },

            slideChange(swiper) {
                updateTooltip(swiper);
            },

            init(swiper) {
                updateTooltip(swiper);
            }
        }
    });
}

function updateTooltip(swiper) {
    if (!swiper) return;

    document.querySelectorAll('.tooltip-slide')
        .forEach(s => s.classList.remove('is-center'));

    let centerSlide = swiper.slides[swiper.activeIndex];

    if (centerSlide && centerSlide.classList.contains("tooltip-slide")) {
        centerSlide.classList.add("is-center");
    }
}

// Page load par slider initialize
document.addEventListener("DOMContentLoaded", initReviewSlider);

document.addEventListener("DOMContentLoaded", function () {
    const faqItems = Array.from(document.querySelectorAll(".faqs-list .faq-item"));
    const seeMoreBtn = document.querySelector(".btn-see-more");
    const visibleCount = 4;
    const totalFAQs = faqItems.length;

    const originalBg = "#0071A8";
    const lessBg = "red";

    let currentVisible = visibleCount;

    // Hide extra FAQs initially
    faqItems.forEach((item, index) => {
        if (index >= visibleCount) item.style.display = "none";
    });

    // Accordion toggle (one open at a time)
    faqItems.forEach(item => {
        const title = item.querySelector(".faq-title");
        const content = item.querySelector(".faq-content");

        title.addEventListener("click", () => {
            faqItems.forEach(i => {
                if (i !== item) {
                    i.classList.remove("active");
                    i.querySelector(".faq-content").style.maxHeight = "0px";
                }
            });

            item.classList.toggle("active");
            if (item.classList.contains("active")) {
                content.style.maxHeight = content.scrollHeight + "px";
            } else {
                content.style.maxHeight = "0px";
            }
        });
    });
    if (seeMoreBtn) {
        // ⭐ FINAL UPDATED LOGIC — Show All at Once ⭐
        seeMoreBtn.addEventListener("click", () => {
            const hiddenItems = faqItems.filter(item => item.style.display === "none");

            if (hiddenItems.length > 0) {
                // 👉 Show ALL hidden FAQs at once
                hiddenItems.forEach(item => item.style.display = "block");

                currentVisible = totalFAQs;
                seeMoreBtn.textContent = "Show Less";
                seeMoreBtn.style.backgroundColor = lessBg;

            } else {
                // 👉 Hide all except first 4
                faqItems.forEach((item, index) => {
                    if (index >= visibleCount) {
                        item.style.display = "none";
                        item.classList.remove("active");
                        item.querySelector(".faq-content").style.maxHeight = "0px";
                    }
                });

                currentVisible = visibleCount;
                seeMoreBtn.textContent = "See More";
                seeMoreBtn.style.backgroundColor = originalBg;
            }
        });
    }
});



// ================ offer slider =================




document.querySelectorAll(".offer-slider-wrapper").forEach(wrapper => {

    const offerTrack = wrapper.querySelector(".offer-slider-track");
    const offerCards = wrapper.querySelectorAll(".offer-card");
    const offerPrev = wrapper.querySelector(".offer-prev");
    const offerNext = wrapper.querySelector(".offer-next");
    const pagination = wrapper.querySelector(".offer-pagination");

    let offerIndex = 0;
    let offerVisibleCards = 4;

    function getCardWidth() {
        return offerCards[0].offsetWidth + 20;
    }

    let offerCardWidth = getCardWidth();

    function updateVisibleCards() {
        if (window.innerWidth < 576) offerVisibleCards = 1;
        else if (window.innerWidth < 992) offerVisibleCards = 2;
        else offerVisibleCards = 4;

        offerCardWidth = getCardWidth();
    }

    updateVisibleCards();
    window.addEventListener("resize", updateVisibleCards);

    const totalCards = offerCards.length / 2;

    /* ------------------ Pagination Dots Create -------------------- */
    pagination.innerHTML = "";
    const dots = [];

    for (let i = 0; i < totalCards; i++) {
        const dot = document.createElement("div");
        dot.classList.add("offer-dot");
        if (i === 0) dot.classList.add("active");

        dot.addEventListener("click", () => {
            offerIndex = i;
            slideToIndex();
            updateDots();
        });

        pagination.appendChild(dot);
        dots.push(dot);
    }

    function updateDots() {
        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === offerIndex);
        });
    }

    /* ------------------ Slider Movement -------------------- */


    function slideToIndex() {
        offerTrack.style.transition = "transform 1s linear";
        offerTrack.style.transform = `translateX(-${offerIndex * offerCardWidth}px)`;
        updateDots();
    }

    function autoSlide() {
        offerIndex++;
        slideToIndex();

        if (offerIndex >= totalCards) {
            setTimeout(() => {
                offerTrack.style.transition = "none";
                offerIndex = 0;
                offerTrack.style.transform = `translateX(0)`;
                updateDots();
            }, 1000);
        }
    }

    offerNext.onclick = autoSlide;

    offerPrev.onclick = () => {
        offerIndex--;
        if (offerIndex < 0) {
            offerTrack.style.transition = "none";
            offerIndex = totalCards - 1;
        }
        slideToIndex();
    };

    let sliderInterval = setInterval(autoSlide, 3000);

    function pauseSlider() {
        clearInterval(sliderInterval);
        sliderInterval = null;
    }

    function resumeSlider() {
        if (!sliderInterval) {
            sliderInterval = setInterval(autoSlide, 3000);
        }
    }

    [wrapper, offerPrev, offerNext].forEach(el => {
        el.addEventListener("mouseenter", pauseSlider);
        el.addEventListener("mouseleave", resumeSlider);
    });

});

// =================repair or location  details pages js ==================


// document.addEventListener("DOMContentLoaded", function () {

//     const mainImage = document.getElementById("mainImage");
//     const thumbTrack = document.getElementById("thumbsTrack");
//     const paginationBar = document.getElementById("paginationBar");
//     const prevBtn = document.querySelector(".thumb-prev");
//     const nextBtn = document.querySelector(".thumb-next");

//     // Agar slider ke elements exist hi nahi karte → EXIT
//     if (!mainImage || !thumbTrack || !paginationBar) {
//         console.warn("Slider elements not found on this page.");
//         return;
//     }

//     let offset = 0;
//     const visibleThumbs = 4;
//     const thumbWidth = 92;
//     let thumbElements = document.querySelectorAll(".thumb");

//     const totalPages = Math.ceil(thumbElements.length / visibleThumbs);

//     // Create Pagination
//     for (let i = 0; i < totalPages; i++) {
//         let seg = document.createElement("div");
//         seg.classList.add("pg-segment");
//         seg.dataset.page = i;
//         paginationBar.appendChild(seg);
//     }

//     const pgSegments = document.querySelectorAll(".pg-segment");

//     function setActivePage(page) {
//         pgSegments.forEach(seg => seg.classList.remove("active"));
//         if (pgSegments[page]) pgSegments[page].classList.add("active");
//     }
//     setActivePage(0);

//     function goToPage(page) {
//         offset = -(page * visibleThumbs * thumbWidth);
//         thumbTrack.style.transform = `translateX(${offset}px)`;
//         setActivePage(page);
//     }

//     // Pagination click
//     pgSegments.forEach(seg => {
//         seg.onclick = () => goToPage(parseInt(seg.dataset.page));
//     });

//     // Left Arrow
//     if (prevBtn) {
//         prevBtn.onclick = () => {
//             let currentPage = Math.abs(offset / (visibleThumbs * thumbWidth));
//             if (currentPage > 0) goToPage(currentPage - 1);
//         };
//     }

//     // Right Arrow
//     if (nextBtn) {
//         nextBtn.onclick = () => {
//             let currentPage = Math.abs(offset / (visibleThumbs * thumbWidth));
//             if (currentPage < totalPages - 1) goToPage(currentPage + 1);
//         };
//     }

//     // Thumbnail click
//     window.thumbClicked = function (src) {
//         mainImage.src = src;

//         const clickedThumb = [...thumbElements].find(t => t.src === src);

//         if (clickedThumb) {
//             thumbTrack.appendChild(clickedThumb);
//             thumbElements = document.querySelectorAll(".thumb");
//         }

//         goToPage(0);
//     };
// });

document.addEventListener("DOMContentLoaded", function () {

    const mainImage = document.getElementById("mainImage");
    const thumbTrack = document.getElementById("thumbsTrack");
    const paginationBar = document.getElementById("paginationBar");
    const prevBtn = document.querySelector(".thumb-prev");
    const nextBtn = document.querySelector(".thumb-next");

    if (!mainImage || !thumbTrack || !paginationBar) {
        console.warn("Slider elements not found!");
        return;
    }

    let offset = 0;
    const visibleThumbs = 4;
    const thumbWidth = 92;

    let thumbElements = document.querySelectorAll(".thumb");

    /** ------------------------------------------
     *  1: Set DEFAULT MAIN IMAGE + ACTIVE THUMB
     * ------------------------------------------ */

    if (thumbElements.length > 0) {
        const firstSrc = thumbElements[0].getAttribute("src");
        mainImage.src = firstSrc;

        thumbElements[0].classList.add("active-thumb");
    }

    /** ------------------------------------------
     *  2: Pagination Setup
     * ------------------------------------------ */
    const totalPages = Math.ceil(thumbElements.length / visibleThumbs);

    for (let i = 0; i < totalPages; i++) {
        let seg = document.createElement("div");
        seg.classList.add("pg-segment");
        seg.dataset.page = i;
        paginationBar.appendChild(seg);
    }

    const pgSegments = document.querySelectorAll(".pg-segment");

    function setActivePage(page) {
        pgSegments.forEach(seg => seg.classList.remove("active"));
        if (pgSegments[page]) pgSegments[page].classList.add("active");
    }
    setActivePage(0);

    function goToPage(page) {
        offset = -(page * visibleThumbs * thumbWidth);
        thumbTrack.style.transform = `translateX(${offset}px)`;
        setActivePage(page);
    }

    pgSegments.forEach(seg => {
        seg.onclick = () => goToPage(parseInt(seg.dataset.page));
    });

    if (prevBtn) {
        prevBtn.onclick = () => {
            let currentPage = Math.abs(offset / (visibleThumbs * thumbWidth));
            if (currentPage > 0) goToPage(currentPage - 1);
        };
    }

    if (nextBtn) {
        nextBtn.onclick = () => {
            let currentPage = Math.abs(offset / (visibleThumbs * thumbWidth));
            if (currentPage < totalPages - 1) goToPage(currentPage + 1);
        };
    }

    /** ------------------------------------------
     *  3: On Thumbnail Click → update main + active
     * ------------------------------------------ */
    window.thumbClicked = function (src) {
        mainImage.src = src;

        // Remove previous active thumb
        thumbElements.forEach(t => t.classList.remove("active-thumb"));

        // Add active class to clicked thumb
        const clickedThumb = [...thumbElements].find(t => t.src === src);
        if (clickedThumb) clickedThumb.classList.add("active-thumb");
    };
});


document.addEventListener('DOMContentLoaded', function () {
    loadCities('footer_state', 'footer_city');
    loadCities('form_state', 'form_city');
    loadCities('modal_form_state', 'modal_form_city');
    loadCities('get_quote_form_state', 'get_quote_form_city');
});


function loadCities(stateSelectId, citySelectId) {

    const stateSelect = document.getElementById(stateSelectId);
    const citySelect = document.getElementById(citySelectId);

    // If element does not exist, exit safely
    if (!stateSelect || !citySelect) return;

    stateSelect.addEventListener('change', function () {

        const stateId = this.value;

        citySelect.innerHTML = '<option>Loading...</option>';

        if (!stateId) {
            citySelect.innerHTML = '<option>Select City</option>';
            return;
        }

        fetch(`/ajax/get-cities/${stateId}`)
            .then(response => response.json())
            .then(response => {

                // API error
                if (!response.status) {
                    citySelect.innerHTML = `<option value="" disabled selected>No City Found</option>`;
                    return;
                }

                const cities = response.data || {};

                // No cities case
                if (Object.keys(cities).length === 0) {
                    citySelect.innerHTML = '<option value="" disabled selected>No City Found</option>';
                    return;
                }

                // Cities found
                citySelect.innerHTML = '<option value="">Select City</option>';

                Object.entries(cities).forEach(([id, name]) => {
                    const option = document.createElement('option');
                    option.value = id;
                    option.textContent = name;
                    citySelect.appendChild(option);
                });
            })
            .catch(() => {
                citySelect.innerHTML = '<option value="" disabled selected>Error loading cities</option>';
            });
    });
}




// ============= animate card =========================


// document.addEventListener("DOMContentLoaded", function () {
//     const cards = document.querySelectorAll(".animate-card");

//     const observer = new IntersectionObserver((entries, observer) => {
//         entries.forEach((entry, index) => {
//             if (entry.isIntersecting) {
//                 const card = entry.target;

//                 const delay = Array.from(cards).indexOf(card) * 300;
//                 card.style.setProperty('--delay', `${delay}ms`);

//                 setTimeout(() => {
//                     card.classList.add("show");
//                 }, delay);

//                 observer.unobserve(card);
//             }
//         });
//     }, {
//         threshold: 0.2
//     });

//     cards.forEach(card => observer.observe(card));
// });

document.addEventListener("DOMContentLoaded", function () {

    const cards = document.querySelectorAll(".animate-card");

    const observer = new IntersectionObserver((entries, observer) => {

        entries.forEach(entry => {
            if (!entry.isIntersecting) return;

            const card = entry.target;

            // Find parent row
            const row = card.closest('.row');
            if (!row) return;

            // Cards only inside this row
            const rowCards = row.querySelectorAll('.animate-card');

            // Index inside its own row
            const index = Array.from(rowCards).indexOf(card);

            // Row-wise delay (reset)
            const delay = index * 380; // 0, 300, 600...

            card.style.setProperty('--delay', `${delay}ms`);
            card.classList.add('show');

            observer.unobserve(card); // animate once
        });

    }, {
        threshold: 0.25
    });

    cards.forEach(card => observer.observe(card));
});


//  add fade-left & right js

document.addEventListener("DOMContentLoaded", () => {

    const elements = document.querySelectorAll('.fade-left, .fade-right');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, {
        threshold: 0.2
    });

    elements.forEach(el => observer.observe(el));
});


//==================  navbar mega dropdown toggler  ==========================================

// document.addEventListener('DOMContentLoaded', function () {

//     let closeTimer;

//     document.querySelectorAll('.has-mega').forEach(item => {
//         const menu = item.querySelector('.mega-menu');
//         const toggleBtn = item.querySelector('.mega-toggle'); // mobile toggle button

//         const isDesktop = () => window.innerWidth >= 992;

//         // Desktop → hover only
//         if (isDesktop()) {
//             item.addEventListener('mouseenter', () => {
//                 clearTimeout(closeTimer);
//                 item.classList.add('show');
//             });

//             item.addEventListener('mouseleave', () => {
//                 closeTimer = setTimeout(() => {
//                     item.classList.remove('show');
//                 }, 250);
//             });

//             menu.addEventListener('mouseenter', () => clearTimeout(closeTimer));
//             menu.addEventListener('mouseleave', () => {
//                 item.classList.remove('show');
//             });
//         }

//         // Mobile / MD → click toggle only
//         if (toggleBtn) {
//             toggleBtn.addEventListener('click', (e) => {
//                 e.preventDefault();
//                 if (!isDesktop()) {
//                     item.classList.toggle('show');
//                 }
//             });
//         }
//     });

//     // Click outside → close mobile menu
//     document.addEventListener('click', (e) => {
//         document.querySelectorAll('.has-mega.show').forEach(item => {
//             const toggleBtn = item.querySelector('.mega-toggle');
//             if (!window.innerWidth >= 992 && toggleBtn && !item.contains(e.target)) {
//                 item.classList.remove('show');
//             }
//         });
//     });

//     // Window resize → remove show on desktop
//     window.addEventListener('resize', () => {
//         if (window.innerWidth >= 992) {
//             document.querySelectorAll('.has-mega.show').forEach(item => {
//                 item.classList.remove('show');
//             });
//         }
//     });

// });

// Dilawar JS for mega menu

// document.addEventListener('DOMContentLoaded', function () {

//     let closeTimer;
//     const DESKTOP_WIDTH = 992;
//     const isDesktop = () => window.innerWidth >= DESKTOP_WIDTH;

//     const forceCloseAll = () => {
//         document.querySelectorAll('.has-mega').forEach(item => {
//             item.classList.remove('show');
//             item.classList.add('mega-force-hide');
//         });
//         clearTimeout(closeTimer);
//     };

//     const allowOpenAgain = () => {
//         document.querySelectorAll('.has-mega').forEach(item => {
//             item.classList.remove('mega-force-hide');
//         });
//     };

//     document.querySelectorAll('.has-mega').forEach(item => {

//         const menu = item.querySelector('.mega-menu');
//         const toggleBtn = item.querySelector('.mega-toggle');

//         /* ================= DESKTOP HOVER ================= */
//         item.addEventListener('mouseenter', () => {
//             if (!isDesktop() || item.classList.contains('mega-force-hide')) return;

//             // 🔥 CLOSE ALL FIRST
//             forceCloseAll();
//             allowOpenAgain();

//             item.classList.add('show');
//         });

//         item.addEventListener('mouseleave', () => {
//             if (!isDesktop()) return;
//             closeTimer = setTimeout(() => {
//                 item.classList.remove('show');
//             }, 250);
//         });

//         if (menu) {
//             menu.addEventListener('mouseleave', () => {
//                 if (!isDesktop()) return;
//                 item.classList.remove('show');
//             });
//         }

//         /* ================= MOBILE CLICK ================= */
//         if (toggleBtn) {
//             toggleBtn.addEventListener('click', (e) => {
//                 e.preventDefault();
//                 if (isDesktop()) return;

//                 const isOpen = item.classList.contains('show');
//                 forceCloseAll();
//                 allowOpenAgain();

//                 if (!isOpen) item.classList.add('show');
//             });
//         }
//     });

//     /* ================= CLICK OUTSIDE ================= */
//     document.addEventListener('click', (e) => {
//         document.querySelectorAll('.has-mega.show').forEach(item => {
//             if (!item.contains(e.target)) {
//                 item.classList.remove('show');
//             }
//         });
//     });

//     /* ================= SCROLL ================= */
//     window.addEventListener('scroll', () => {
//         forceCloseAll();
//         setTimeout(allowOpenAgain, 200);
//     }, { passive: true });

//     /* ================= RESIZE ================= */
//     window.addEventListener('resize', () => {
//         forceCloseAll();
//         setTimeout(allowOpenAgain, 200);
//     });

// });

// My JS for mega menu
document.addEventListener('DOMContentLoaded', function () {

    let closeTimer;
    const DESKTOP_WIDTH = 992;
    const isDesktop = () => window.innerWidth >= DESKTOP_WIDTH;

    const forceCloseAll = () => {
        document.querySelectorAll('.has-mega').forEach(item => {
            item.classList.remove('show');
            item.classList.add('mega-force-hide');
        });
        clearTimeout(closeTimer);
    };

    const allowOpenAgain = () => {
        document.querySelectorAll('.has-mega').forEach(item => {
            item.classList.remove('mega-force-hide');
        });
    };

    document.querySelectorAll('.has-mega').forEach(item => {

        const menu = item.querySelector('.mega-menu');
        const toggleBtn = item.querySelector('.mega-toggle');

        /* ================= DESKTOP HOVER ================= */
        item.addEventListener('mouseenter', () => {
            if (!isDesktop() || item.classList.contains('mega-force-hide')) return;
            forceCloseAll();
            allowOpenAgain();
            item.classList.add('show');
        });

        item.addEventListener('mouseleave', () => {
            if (!isDesktop()) return;
            closeTimer = setTimeout(() => {
                item.classList.remove('show');
            }, 250);
        });

        if (menu) {
            menu.addEventListener('mouseleave', () => {
                if (!isDesktop()) return;
                item.classList.remove('show');
            });
        }

        /* ================= MOBILE CLICK (TOGGLE BUTTON) ================= */
        if (toggleBtn) {
            toggleBtn.addEventListener('click', (e) => {
                if (isDesktop()) return; // desktop clicks not blocked
                e.preventDefault();       // only prevent default on mobile
                const isOpen = item.classList.contains('show');
                forceCloseAll();
                allowOpenAgain();
                if (!isOpen) item.classList.add('show');
            });
        }

    });

    /* ================= CLICK OUTSIDE ================= */
    document.addEventListener('click', (e) => {
        document.querySelectorAll('.has-mega.show').forEach(item => {
            if (!item.contains(e.target)) {
                item.classList.remove('show');
            }
        });
    });

    /* ================= SCROLL / RESIZE ================= */
    ['scroll', 'resize'].forEach(evt => {
        window.addEventListener(evt, () => {
            forceCloseAll();
            setTimeout(allowOpenAgain, 200);
        }, { passive: true });
    });

});





// ============= Buy Product moddel open js =====================
let captchaWidgetId = null;
document.addEventListener('DOMContentLoaded', function () {

    if (typeof grecaptcha !== 'undefined') {
        captchaWidgetId = grecaptcha.render('buyCaptcha', {
            sitekey: document.getElementById('buyCaptcha').dataset.sitekey
        });
    }

    const overlay = document.getElementById('buyFormOverlay');
    if (!overlay) return;

    const form = overlay.querySelector('.buy-form');
    const closeBtn = overlay.querySelector('.close-form');

    // ================= OPEN / CLOSE MODAL =================
    document.body.addEventListener('click', function (e) {

        const btn = e.target.closest('[data-open-form]');
        if (btn) {
            e.preventDefault();
            overlay.classList.add('active');

            const slug = btn.dataset.slug ?? '';
            document.getElementById('product_slug').value = slug;
        }

        // Close modal
        if (e.target === closeBtn || e.target === overlay) {
            closeModal();
        }
    });

    function closeModal() {
        overlay.classList.remove('active');
        resetForm();
        resetCaptcha();
    }

    function resetCaptcha() {
        if (typeof grecaptcha !== 'undefined' && captchaWidgetId !== null) {
            grecaptcha.reset(captchaWidgetId);
        }
    }


    function resetForm() {
        form.reset();
        document.getElementById('product_slug').value = '';

        // remove errors
        overlay.querySelectorAll('.error-text').forEach(el => el.innerText = '');
    }

    // ================= FORM SUBMIT AJAX =================
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(form);

        // clear previous errors
        overlay.querySelectorAll('.error-text').forEach(el => el.innerText = '');

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                'Accept': 'application/json',
            },
            body: formData
        })
            .then(async response => {
                if (!response.ok) {
                    const data = await response.json();
                    throw data;
                }
                return response.json();
            })
            .then(res => {
                toastr.success(res.message);
                closeModal();
                resetCaptcha();
            })
            .catch(err => {
                resetCaptcha();
                if (err.errors) {
                    Object.keys(err.errors).forEach(key => {
                        const errorEl = overlay.querySelector(`.${key}_error`);
                        if (errorEl) {
                            errorEl.innerText = err.errors[key][0];
                        }
                    });
                } else {
                    toastr.error('Something went wrong');
                }
            });
    });

});


// ====================== home category slider ===============================

document.addEventListener('DOMContentLoaded', () => {

    const sliderRow = document.querySelector('.category-slider .row');
    const items = document.querySelectorAll('.category-slider .col-auto');
    const prevBtn = document.querySelector('.cat-nav.prev');
    const nextBtn = document.querySelector('.cat-nav.next');

    // Agar slider hi nahi hai to exit
    if (!sliderRow || !items.length || !prevBtn || !nextBtn) return;

    let currentIndex = 0;
    let visibleItems = 7; // default for large screens

    function updateVisibleItems() {
        const width = window.innerWidth;
        if (width < 576) visibleItems = 2; // mobile
        else if (width < 768) visibleItems = 2; // small tablets
        else if (width < 992) visibleItems = 3; // tablets
        else visibleItems = 5; // desktops
    }

    function updateSlider() {
        const itemWidth = items[0].offsetWidth + 16; // gap included
        const maxIndex = Math.max(items.length - visibleItems, 0);
        if (currentIndex > maxIndex) currentIndex = maxIndex;
        sliderRow.style.transform = `translateX(-${currentIndex * itemWidth}px)`;

        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= maxIndex;
    }

    nextBtn.addEventListener('click', () => {
        currentIndex++;
        updateSlider();
    });

    prevBtn.addEventListener('click', () => {
        currentIndex--;
        updateSlider();
    });

    window.addEventListener('resize', () => {
        updateVisibleItems();
        updateSlider();
    });

    // Initial setup
    updateVisibleItems();
    updateSlider();
});



document.addEventListener('DOMContentLoaded', function () {

    function addToCart(productId, qty = 1, btn) {
        console.log(productId, 'productId');
        
        btn.disabled = true;
        btn.innerText = 'Adding...';

        fetch("/cart/add", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                product_id: productId,
                qty: qty
            })
        })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    btn.innerText = 'Added!';
                    // Optional: update cart count in navbar
                    if (window.updateCartCount) {
                        window.updateCartCount(res.cart);
                    }
                    // Reset button text after 1.5s
                    setTimeout(() => {
                        btn.innerText = 'Add to Cart';
                        btn.disabled = false;
                    }, 1500);
                } else {
                    alert(res.message || 'Could not add to cart');
                    btn.innerText = 'Add to Cart';
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Something went wrong');
                btn.innerText = 'Add to Cart';
                btn.disabled = false;
            });
    }

    document.querySelectorAll('.offer-readd-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const productId = this.dataset.id;
            const qty = this.dataset.qty ?? 1;
            if (productId) addToCart(productId, qty, this);
        });
    });

});