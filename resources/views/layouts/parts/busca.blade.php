<section id="buscar" class="buscar">
    <div class="container">
        <div class="row texto mb-5">
            <div class="col-12">
                <h1>Soluções Imobiliárias de Vanguarda há 30 Anos: Seu Negócio, Nossa Tecnologia!</h1>
            </div>
        </div>
        <form action="{{ route('busca.avancada') }}" method="GET" name="form-busca" id="form-busca">
            <div class="row buscar-div">
                <div class="col-md-3 col-sm-12 mb-1">
                    <select class="form-select" id="finalidade" name="finalidade">
                        <option value="0" selected>O que você precisa?</option>
                        <option value="Locacao">ALUGAR</option>
                        <option value="Venda">COMPRAR</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-12 mb-1">
                    <select class="form-select" id="tipo" name="tipo">
                        <option selected>Qual tipo?</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-12 mb-1">
                    <select class="form-select" id="bairro" name="bairro">
                        <option selected>Qual Bairro?</option>
                    </select>
                </div>
                <div class="col-md-1 col-sm-12 mb-1">
                    <div class="d-grid gap-2">
                        <button class="btn btn-warning" type="submit">
                          <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12 mb-1">
                  <div class="input-group">
                      <input class="form-control border-end-0 border rounded-pill" type="text" id="referencia" name="referencia" placeholder="Busca">
                      <span class="input-group-append">
                          <button class="btn btn-outline-secondary bg-white border-start-0 border rounded-pill" id="ms_n3" type="button">
                              <i class="fa fa-search"></i>
                          </button>
                      </span>
                  </div>
                </div>
              </div>
        </form>
    </div>
</section>

@section('script-busca')
<script>
    $("#finalidade").change(function (){
        var finalidade = $(this).val();

        if(finalidade != 0){

            var form      = document.getElementById('form-busca');
            formData      = new FormData(form);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{ route('busca.tipo') }}",
                contentType : false,
                processData : false,
                data: formData,
                beforeSend : function(){
                    $('#tipo').html("<option>Carregando...</option>");
                }
            })
            .done(function(data) {
                $('#tipo').empty();
                $('#tipo').html("<option value=''>Selecione um tipo</option>");

                $.each(data.data, function(i, item) {
                    $('#tipo').append("<option value='" + i + "'>"+ item +"</option>");
                });
            });

        }
    });
    $("#tipo").change(function (){
        var finalidade = $("#finalidade").val();
        var tipo    = $(this).val();

        if(tipo != 0){

            var form      = document.getElementById('form-busca');
            formData      = new FormData(form);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "{{ route('busca.bairro') }}",
                contentType : false,
                processData : false,
                data: formData,
                beforeSend : function(){
                    $('#bairro').html("<option>Carregando...</option>");
                }
            })
            .done(function(data) {
                $('#bairro').empty();
                $('#bairro').html("<option value=''>Selecione um tipo</option>");

                $.each(data.data, function(i, item) {
                    $('#bairro').append("<option value='" + i + "'>"+ item +"</option>");
                });
            });

        }
    });
</script>
@endsection

@section('style')
<style>
</style>
@endsection
