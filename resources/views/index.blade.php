@extends('layouts.app')

@section('hero-banner')
    @include('layouts.parts.hero')
@endsection

@section('busca')
    @include('layouts.parts.busca')
@endsection

@section('main')
<!-- ======= DESTAQUE DE VENDA ======= -->
<section id="team" class="team section-bg" style="margin-top: 50px;">
    <div class="container">
        <div class="section-title">
            <h2>Imóveis em Destaque para Alugar</h2>
            <p>ALUGAR</p>
        </div>
        <div class="row">
            <div class="swiper team-swiper" style="max-height: 430px;">
                <div class="swiper-wrapper pb-3">
                    @foreach ($a_destaque_locacao as $imv)
                        <div class="swiper-slide col-lg-4 col-md-6">
                            <div class="member">
                                <div class="pic">
                                    <a href="{{ url('/imovel/' . $imv['url_amigavel'] . '/' . $imv['cod_bem']) }}">
                                        <img src="{{ $imv['img'] }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="member-info">
                                    <h4>{{ $imv['vlr_locacao'] }}</h4>
                                    <h4 style="font-size: 11px; text-transform: uppercase;">
                                        {{ $imv['tp_bem'] . ' PARA ' . $imv['finalidade'] . ' EM ' . $imv['cidade'] }}
                                    </h4>
                                    <div class="social">
                                        <a title="Dormitórios"><i class="fa fa-bed" aria-hidden="true"></i> {{ $imv['qtde_quartos'] }}</a>   |
                                        <a title="Banheiros"<i class="fa fa-shower" aria-hidden="true"></i> {{ $imv['qtde_banheiro'] }}</a>   |
                                        <a title="Vagas"><i class="fa fa-car" aria-hidden="true"></i> {{ $imv['qtde_garagens'] }}</a>         |
                                        <a title="Suítes"><i class="fa fa-bath" aria-hidden="true"></i> {{ $imv['qtde_suites'] }}</a>       |
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
<!-- END DESTAQUE DE VENDA -->


<!-- ======= DESTAQUE DE VENDA ======= -->
<section id="team" class="team section-bg">
    <div class="container">
        <div class="section-title">
            <h2>Imóveis em Destaque para Venda</h2>
            <p>COMPRAR</p>
        </div>
        <div class="row">
            <div class="swiper team-swiper" style="max-height: 430px;">
                <div class="swiper-wrapper pb-3">
                    @foreach ($a_destaque_venda as $imv)
                        <div class="swiper-slide col-lg-4 col-md-6">
                            <div class="member">
                                <div class="pic">
                                    <a href="{{ url('/imovel/' . $imv['url_amigavel'] . '/' . $imv['cod_bem']) }}">
                                        <img src="{{ $imv['img'] }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="member-info">
                                    <h4>{{ $imv['valor'] }}</h4>
                                    <h4 style="font-size: 11px; text-transform: uppercase;">
                                        {{ $imv['tp_bem'] . ' PARA ' . $imv['finalidade'] . ' EM ' . $imv['cidade'] }}
                                    </h4>
                                    <div class="social">
                                        <a title="Dormitórios"><i class="fa fa-bed" aria-hidden="true"></i> {{ $imv['qtde_quartos'] }}</a>   |
                                        <a title="Banheiros"<i class="fa fa-shower" aria-hidden="true"></i> {{ $imv['qtde_banheiro'] }}</a>   |
                                        <a title="Vagas"><i class="fa fa-car" aria-hidden="true"></i> {{ $imv['qtde_garagens'] }}</a>         |
                                        <a title="Suítes"><i class="fa fa-bath" aria-hidden="true"></i> {{ $imv['qtde_suites'] }}</a>       |
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
<!-- END DESTAQUE DE VENDA -->
@endsection

@section('style2')
<style>
.pic {
    max-height: 320px !important;
}
</style>
@endsection
