@extends('layouts.app')

@section('main')
<div class="container" style="margin-top: 120px;">
    <section id="contact" class="contact">
        <div class="container">
            <div class="roe" style="margin-bottom: 30px;">
                <h4>Ref.:  {{ $imovel['tp_bem'] . ' - ' . $imovel['cidade'] }}</h4>
            </div>
        </div>
        <hr>
        <!--
        <div class="container">
            <div class="row bg-light border p-3 mb-3 d-flex align-items-center">
                @if ($imovel['tp_bem'] !== 'Terreno')
                    <div class="col-lg-2 col-6 text-center">
                        @if ($imovel['qtde_quartos'] != '')
                            <i class="fas fa-bed fa-fw fa-lg"></i> <br>
                            {{ $imovel['qtde_quartos'] }}
                            Quartos
                        @endif
                    </div>
                    <div class="col-lg-2 col-6 text-center">
                        @if ($imovel['qtde_banheiro'] != '')
                            <i class="fas fa-shower fa-fw fa-lg"></i> <br>
                            {{ $imovel['qtde_banheiro'] }}
                            Banheiros
                        @endif
                    </div>
                    <div class="col-lg-2 col-6 text-center">
                        @if ($imovel['qtde_suites'] != '')
                            <i class="fas fa-bath fa-fw fa-lg"></i> <br>
                            {{ $imovel['qtde_suites'] }}
                            Suites
                        @endif
                    </div>
                    <div class="col-lg-2 col-6 text-center">
                        @if ($imovel['qtde_garagens'] != '')
                            <i class="fas fa-car fa-fw fa-lg"></i> <br>
                            {{ $imovel['qtde_garagens'] }}
                            Vagas
                        @endif
                    </div>
                @endif
            </div>
        </div>
        -->
        <div class="container" style="margin-top: 20px;">
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-2">
                    <ul id="imageGallery">
                        @if ($imovel['img_pach'] != '')
                            @foreach ($imovel['img_pach'] as $img)
                                <li data-thumb="{{ $img }}" data-src="{{ $img }}" style="text-align: center; background-color: #a5a0a0;">
                                    <img class="img-fluid" src="{{ $img }}" id="img_responsive"/>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="" style="width: 100%; text-align: right; display: flex;">
                        <div class="col-6" style="text-align: left;">
                            <h4>Informações</h4>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ $imovel['whatsapp'] }}" target="blank" class="btn btn-outline-secondary btn-lg btn-whats" title="Fale com um de nossos atendentes.">
                                <i class="fab fa-whatsapp fa-fw" style="font-size: 20px"></i>
                                Conversar
                            </a>
                        </div>
                    </div>
                    <hr>
                    <span><b>REF.:</b> {{ $imovel['referencia'] }}</span>           <br>
                    <span><b>Cidade.:</b> {{ $imovel['cidade'] }}</span>            <br>
                    <span><b>Bairro.:</b> {{ $imovel['bairro'] }}</span>            <br>
                    @if ($imovel['finalidade'] == 'Locacao')
                        <span><b>Endereço.:</b> {{ $imovel['endereco'] }},          <br> {{ $imovel['endereco_2'] }}</span>    <br>
                        <span><b>Complemento.:</b> {{ $imovel['complemento'] }}</span>    <br>
                    @endif

                    <br>

                    <span><b>Tipo.:</b> {{ $imovel['tp_bem'] }}</span>              <br>
                    <span><b>Aplicação.:</b> {{ $imovel['aplicacao'] }}</span>      <br>
                    <span><b>Valor.:</b> {{ $imovel['valor'].',00' }}</span>        <br>

                    @if ($imovel['finalidade'] == 'Locacao')
                        @if($imovel['vlr_iptu'].',00' !== 'R$ 0') <span><b>IPTU.:</b> {{ $imovel['vlr_iptu'].',00' }}</span>                        <br>    @endif
                        @if($imovel['observacao1'].',00' !== '')  <span><b>Seguro Incêndio Anual:</b> {{ $imovel['observacao1'] }}</span>           <br>    @endif
                        @if($imovel['vlr_condominio'].',00' !== 'R$ 0') <span><b>Condomínio Apxm.:</b> {{ $imovel['vlr_condominio'].',00' }}</span> <br>    @endif
                    @endif

                    <br>
                   <!-- <span style="color: red;">
                        @if ($imovel['finalidade'] == 'Locacao')
                            Atenção: O Valor do imóvel está bonificado. A disponibilidade e os valores dos imóveis estão sujeitos a alteração sem aviso prévio.
                        @else
                            Atenção: A disponibilidade e os valores dos imóveis estão sujeitos a alteração sem aviso prévio.
                        @endif
                    </span>-->
                </div>
            </div>
        </div>
        <div class="container mt-3 p-4">
            <div class="row bg-light border p-3 mb-5 d-flex align-items-center">
                <div class="col-12">
                    <p class="text-justify">
                        {!! $imovel['descr_adicional'] !!}
                    </p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <h4>Características</h4>
                    <hr>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <b>Categoria:</b>
                            <p>{{ $imovel['tp_bem'] }}</p>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <b>Tipo:</b>
                            <p>{{ $imovel['estrutura'] }}</p>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <b>Área útil:</b>
                            <p>{!! $imovel['area_util'] !!}</p>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <b>Área do Terreno:</b>
                            <p>{!! $imovel['area_total'] !!}</p>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <b>Valor:</b>
                            <p>
                                @if(Str::upper($imovel['finalidade']) === 'VENDA')
                                    {{ $imovel['valor'] . ',00' }}
                                @else
                                    {{ $imovel['vlr_locacao'] . ',00' }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <h4>Itens do imóvel</h4>
                    <hr>
                </div>
                <div class="col-12">
                    <div class="row">
                        @foreach ($imovel['benfeitorias'] as $benf)
                            <div class="col-md-2 col-sm-12">
                                <p>
                                    <i class="fas fa-check-square" style="font-size: 14px;"></i>
                                    {!! $benf !!}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if ($imovel['finalidade'] == 'Locacao')
                <div class="row">
                    <div class="col-12">
                        <h4>Localização</h4>
                        <hr>
                    </div>
                    <div class="col-12">
                        <p>
                            {{ $imovel['endereco'] }} <br>
                            <span>{{ $imovel['bairro'] . ' - ' . $imovel['cidade'] }}</span>
                        </p>
                    </div>
                    <div class="col-12 mt-2">
                        <iframe frameborder="0" style="border:0; width: 100%; height: 500px;" src="{{ $imovel['google_maps'] }}" allowfullscreen></iframe>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/lightslider/js/lightslider.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.1.8/lightgallery.min.js" integrity="sha512-BQPHJVHCOVIdd6S0Vi8+7gaPHy0cZxXNEzqn1gQWeYEMQMQDolld6PGJtShlVcCHEOwve3XHBwKaarmRO/Dnjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
<script>
    $(document).ready(function() {
        $('#imageGallery').lightSlider({
            gallery:true,
            item:1,
            loop:true,
            thumbItem:7,
            slideMargin:0,
            enableDrag: false,
            currentPagerPosition:'left',
            onSliderLoad: function(el) {
                lightGallery(document.getElementById('imageGallery'));
            }
        });
    });
</script>
@endsection

@section('style')
<link rel="stylesheet"  href="{{ asset('assets/plugins/lightslider/css/lightslider.min.css') }}"/>
<link href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css" rel="stylesheet">
<style>
#header{
    background-image: url("{{ asset('images/carrosel/carrosel2.jpeg') }}");
    background-repeat: no-repeat, repeat;
    background-size: 100%;
    background-attachment: fixed;
    background-position: 0px top;
}
#main{
    margin-top: 250px !important;
}
#imageGallery{
    max-height: 430px !important;
}
.lSPager{
    max-height: 65px !important;
}
.btn-whats {
    color: green;
    font-size: 13px;
}
.btn-whats:hover{
    background: green;
    color: #fff;
}
#img_responsive {
    max-height: 500px;
}
@media screen and (max-width: 375px) {
  #img_responsive {
      max-height: 260px;
  }
}
@media screen and (max-width: 390px) {
  #img_responsive {
      max-height: 260px;
  }
}
@media screen and (max-width: 450px) {
  #img_responsive {
      max-height: 300px;
  }
}
</style>
@endsection
