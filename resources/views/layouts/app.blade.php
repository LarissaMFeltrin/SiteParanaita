<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @include('layouts.parts.description')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Imobiliária Paranaíta | Marialva - PR</title>
    <!-- ======= styles ======= -->
    @include('layouts.parts.styles')
    <!-- End styles -->
</head>

<body>

  <!-- ======= Header ======= -->
  @include('layouts.parts.header')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  @yield('hero-banner')
  <!-- End Hero -->

  @yield('busca')

  <main id="main">
        @yield('main')
  </main>
  <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('layouts.parts.footer')
    <!-- End Footer -->

    <!-- ======= Scripts ======= -->
    @include('layouts.parts.scripts')
    <!-- ======= End Scripts ======= -->

</body>

</html>
