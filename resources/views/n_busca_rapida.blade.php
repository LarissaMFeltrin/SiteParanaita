<?php
use App\Models\Util;
?>
@extends('layouts.app')

@section('main')
<section id="imoveis" class="imoveis-lista">
    <div class="container">
        <div class=" section-title">
            <h2>{{ Str::upper($_GET['finalidade']) }}</h2>
            <p>Imóveis Disponíveis, {{ Str::upper($_GET['finalidade']) }}</p>
        </div>

        <div class="row border" style="padding: 10px;">
            <div class="col-12">
                <b>Total:</b> {{ $imovel->total() }} imóveis
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12 col-md-9">
                <h3>Nenhum imovel encontrado!</h3>
            </div>
            <div class="col-sm-12 col-md-3">
                <h5 class="text-center border p-1" style="background-color: #FCB900; color: #fff">
                    Busca Rápida - Venda
                </h5>
                <ul class="categoria">
                    @foreach ($tp_bem_venda as $tp_venda)
                        <li>
                            <a href="{{ route('busca.rapida') . '?finalidade=venda&tipo=' . strtolower($tp_venda->tp_bem) }}">
                                {{ Util::getStringUTF8($tp_venda->tp_bem) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <h5 class="text-center border p-1" style="background-color: #FCB900; color: #fff">
                    Busca Rápida - Locação
                </h5>
                <ul class="categoria">
                    @foreach ($tp_bem_locacao as $tp_locacao)
                        <li>
                            <a href="{{ route('busca.rapida') . '?finalidade=locacao&tipo=' . strtolower($tp_locacao->tp_bem) }}">
                                {{ Util::getStringUTF8($tp_locacao->tp_bem) }}
                            </a>
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
    background-image: url("{{ asset('images/banner_00.png') }}");
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
