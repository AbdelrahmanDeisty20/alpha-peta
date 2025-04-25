<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script src="{{ asset('web/js/jquery.js') }}"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

<script src="{{ asset('web/js/custome.js') }}"></script>

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('web/js/owl.carousel.min.js') }}"></script>

<!-- aos -->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@if (app()->getLocale() == 'ar')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js"></script>
@else
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_en.min.js"></script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>
<script>
    // AOS.init();
</script>



<!-- Owl Carousel Initialization -->
<script>
    $(document).ready(function() {
        $(".services .owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            dots: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                },
            },
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".projects .owl-carousel").owlCarousel({
            loop: true,
            margin: 30,
            dots: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                },
            },
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".about__service__slider .owl-carousel").owlCarousel({
            loop: true,
            nav: true,
            margin: 10,
            navText: [
                '<i class="fa-solid fa-arrow-left-long"></i>', // Left arrow
                '<i class="fa-solid fa-arrow-right-long"></i>' // Right arrow
            ],
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                },
            },
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".partners .owl-carousel").owlCarousel({
            loop: true,
            margin: 30,
            dots: true,
            responsive: {
                0: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                1000: {
                    items: 4,
                },
                1150: {
                    items: 6,
                },
            },
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".blogs__slider .owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            dots: true,
            responsive: {
                0: {
                    items: 1,
                },
                430: {
                    items: 2,
                },
            },
        });
    });
</script>


<script>
    $(document).ready(function() {
        $(".header .owl-carousel").owlCarousel({
            loop: true,
            margin: 30,
            dots: true,
            responsive: {
                0: {
                    items: 1,
                },
                425: {
                    items: 1,
                },
                1000: {
                    items: 1,
                },
                1150: {
                    items: 1,
                },
            },
        });
    });
</script>

@stack('js')
