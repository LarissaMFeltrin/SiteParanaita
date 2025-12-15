<header id="header">
    <div class="container d-flex align-items-center justify-content-between">

      <!--<h1 class="logo"><a href="index.html">Dewi</a></h1>-->
        <a href="{{ route('index') }}" class="logo">
          <img src="{{ asset('images/logoParanaitaBrancaCreci.png') }}" alt="" class="img-fluid">
        </a>

      <nav id="navbar" class="navbar">
        <ul>
            <li>
                <a
                class="nav-link scrollto
                @if(Route::currentRouteName() === 'home') active @endif"
                href="{{ route('index') }}">
                    Home &nbsp;
                </a>
            </li>
            <li>
                <a
                class="nav-link scrollto
                @if(Route::currentRouteName() === 'venda') active @endif"
                href="{{ route('venda') }}">
                    Venda
                </a>
            </li>
            <li>
                <a
                class="nav-link scrollto
                @if(Route::currentRouteName() === 'locacao') active @endif"
                href="{{ route('locacao') }}">
                    Locação
                </a>
            </li>
            <li>
                <a class="getstarted scrollto" href="#">
                    <i class="bi bi-telephone-fill"></i>
                    &nbsp;
                    (44)  99976-5500
                </a>
            </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->

    </div>
  </header>
