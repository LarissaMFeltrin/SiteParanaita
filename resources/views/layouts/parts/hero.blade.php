<section id="hero">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="hero-slide" style="background-image: url('{{ asset('images/carrosel/carrosel2.jpeg') }}');"></div>
            </div>
            <div class="swiper-slide">
                <div class="hero-slide" style="background-image: url('{{ asset('images/carrosel/carrosel3.jpeg') }}');"></div>
            </div>
            <div class="swiper-slide">
                <div class="hero-slide" style="background-image: url('{{ asset('images/carrosel/carrosel4.jpeg') }}');"></div>
            </div>
            <div class="swiper-slide">
                <div class="hero-slide" style="background-image: url('{{ asset('images/carrosel/marialvaigreja.jpg') }}');"></div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

@section('style')
<style>
.hero-swiper {
    width: 100%;
    height: 100vh;
}

.hero-slide {
    width: 100%;
    height: 100vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.hero-swiper .swiper-pagination-bullet {
    background: #fff;
    opacity: 0.5;
}

.hero-swiper .swiper-pagination-bullet-active {
    opacity: 1;
    background: #fc0004;
}

.hero-swiper .swiper-button-next,
.hero-swiper .swiper-button-prev {
    color: #fff;
}

.hero-swiper .swiper-button-next:after,
.hero-swiper .swiper-button-prev:after {
    font-size: 30px;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.hero-swiper', {
        speed: 1000,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});
</script>
@endsection
