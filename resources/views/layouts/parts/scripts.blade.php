<!-- JQaury -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/floating-whatsapp/floating-wpp.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script type="text/javascript">
    $(function () {
        $('#myButton').floatingWhatsApp({
            phone: '5544988117771',
            popupMessage: 'Tem alguma dúvida, gostaria de mais informações?',
            message: "Sim",
            showPopup: true,
            showOnIE: true,
            headerTitle: 'Sistemas Cordon',
            headerColor: '#25D366',
            backgroundColor: '#075e54',
            buttonImage: `<img src="{{ asset('images/whatsapp.png') }}" />`
        });
    });
</script>

@yield('script-busca')
@yield('scripts')
