@extends('layouts.app')

@section('main')
<section id="imoveis" class="imoveis-lista">
    <div class="container">
        <div class=" section-title">
            <h2>VENDA</h2>
            <p>Imóveis Disponíveis, Venda</p>
        </div>

        <div class="row border" style="padding: 10px;">
            <div class="col-12">
                <b>Total:</b> {{ $imovel->total() }} imóveis
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12 col-md-9">
                @foreach ($imoveis as $imv)
                    <div class="row mb-3" style="background-color: #f0f4f8; padding: 10px; margin-right: 10px; border: 1px solid #e8e8e8;">
                        <div class="col-sm-12 col-md-5 text-center" style="display: flex; align-items: center; justify-content: center;">
                            <a href="{{ route('imovel', ['descricao' => $imv['url_amigavel'], 'id' => $imv['cod_bem']]) }}">
                                <img src="{{ $imv['img'] }}" class="img-fluid" alt="" style="max-height: 290px;">
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="row">
                                <div class="col-12">
                                    <span style="border: 1px solid; border-radius: 10px; padding: 5px; font-size: 10px">
                                        <b>{{ Str::upper($imv['finalidade']) }}</b>
                                    </span>
                                </div>
                                <div class="col-12 mt-3">
                                    <span style="font-size: 20px; font-weight: bold;">
                                        {{ $imv['bairro'] }} <br>
                                        {{ $imv['cidade'] }}
                                    </span>
                                    <br>
                                    <small>
                                        <b>Ref: {{ $imv['referencia'] }}</b> - {{ $imv['tp_bem'] }}
                                    </small>
                                    @if ($imv['valor'] != 'R$ 0')
                                        <br>
                                        <span>
                                            <b>Valor:</b> {{ $imv['valor'] . ',00' }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row text-center">
                                        <div class="col-3 border">
                                            <i class="fa fa-bed" aria-hidden="true"></i>
                                            <br>
                                            <b>{{ $imv['qtde_quartos'] }}</b> Dorm.
                                        </div>
                                        <div class="col-3 border">
                                            <i class="fa fa-bath" aria-hidden="true"></i>
                                            <br>
                                            <b>{{ $imv['qtde_suites'] }}</b> Suítes
                                        </div>
                                        <div class="col-3 border">
                                            <i class="fa fa-shower" aria-hidden="true"></i>
                                            <br>
                                            <b>{{ $imv['qtde_banheiro'] }}</b> W.C.
                                        </div>
                                        <div class="col-3 border">
                                            <i class="fa fa-car" aria-hidden="true"></i>
                                            <br>
                                            <b>{{ $imv['qtde_garagens'] }}</b> Vagas
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="d-grid gap-2 text-center">
                                            <a href="{{ route('imovel', ['descricao' => $imv['url_amigavel'], 'id' => $imv['cod_bem']]) }}" class="btn btn-dark">
                                                <i class="fas fa-search fa-fw"></i> Ver detalhes do imóvel
                                            </a>
                                            <a href="{{ $imv['whatsapp'] }}" target="_" class="btn btn-success"> <i class="bi bi-whatsapp"></i> Whatsapp</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row mb-3">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            {!! $imovel->links() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <h5 class="text-center border p-1" style="background-color: #fc0004; color: #fff">
                    Busca Rápida - Venda
                </h5>
                <ul class="categoria">
                    @foreach ($tp_bem_venda as $tp_venda)
                        <li>
                            <a href="{{ route('busca.rapida') . '?finalidade=venda&tipo=' . strtolower($tp_venda->tp_bem) }}">{{ $tp_venda->tp_bem }}</a>
                        </li>
                    @endforeach
                </ul>
                <h5 class="text-center border p-1" style="background-color: #fc0004; color: #fff">
                    Busca Rápida - Locação
                </h5>
                <ul class="categoria">
                    @foreach ($tp_bem_locacao as $tp_locacao)
                        <li>
                            <a href="{{ route('busca.rapida') . '?finalidade=locacao&tipo=' . strtolower($tp_locacao->tp_bem) }}">{{ $tp_locacao->tp_bem }}</a>
                        </li>
                    @endforeach
                </ul>
                <form action="{{ route('busca.avancada') }}" method="GET">
                    <input type="text" class="form-control" placeholder="BUSCAR REFERÊNCIA" name="referencia" id="referencia">
                    <input type="hidden" name="finalidade" id="finalidade" value="">
                    <input type="hidden" name="tipo" id="tipo" value="">
                    <div class="d-grid gap-2">
                        <button class="btn btn-success btn-block mt-2">
                            BUSCAR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function submit_orderby() {
        $("#orderby").submit();
    }
</script>
@endsection

@section('style')
<style>
#header{
    background-image: url("{{ asset('images/cidademarialva5.jpeg') }}");
    background-repeat: no-repeat, repeat;
    background-size: 100%;
    background-attachment: fixed;
    background-position: 0px top;
}
#main{
    margin-top: 230px !important;
}
.categoria{
    list-style-type: none;
}
.categoria li {
    padding: 3px;
}
.categoria a {
    text-decoration: none;
    color: #121d24;
}
.categoria a:hover {
    color: red;
}
</style>
@endsection
