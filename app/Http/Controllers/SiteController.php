<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Util;

use App\Models\Imovel;
use App\Models\BenfCruz;

class SiteController extends Controller
{
    public function index()
    {
        $imoveis_venda = Imovel::where('id_imob', '=', '73')->where('finalidade', '=', 'Venda')->limit(10)->get();
        $imoveis_locacao = Imovel::where('id_imob', '=', '73')->where('finalidade', '=', 'Locacao')->inRandomOrder()->limit(10)->get();

        $a_destaque_locacao = $this->getRetorno($imoveis_locacao);
        $a_destaque_venda   = $this->getRetorno($imoveis_venda);

        return view('index', compact('a_destaque_locacao', 'a_destaque_venda'));
    }

    public function venda(Request $request)
    {
        if(isset($request['order'])){
            switch ($request['order']) {
                case '1':
                    $colum   =   'vlr_oferta';
                    $orderby = 'asc';
                    break;
                case '2':
                    $colum   =   'vlr_oferta';
                    $orderby = 'desc';
                    break;
                case '3':
                    $colum   =   'cod_bem';
                    $orderby = 'DESC';
                    break;
            }
        }else{
            $colum   =   'vlr_oferta';
            $orderby = 'asc';
        }
        $imovel     = Imovel::where('finalidade', '=', 'Venda')
                    ->orderBy($colum, $orderby)
                    ->paginate(10);

        $imoveis    = $this->getRetorno($imovel);

        $tp_bem_venda   = DB::table('imovel')
                        ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                        ->where('finalidade', '=', 'Venda')
                        ->groupBy('tp_bem')
                        ->get();

        $tp_bem_locacao  = DB::table('imovel')
                        ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                        ->where('finalidade', '=', 'Locacao')
                        ->groupBy('tp_bem')
                        ->get();

        return view('venda', compact('imovel', 'imoveis', 'tp_bem_venda', 'tp_bem_locacao'));
    }

    public function locacao(Request $request)
    {
        if(isset($request['order'])){
            switch ($request['order']) {
                case '1':
                    $colum   =   'vlr_oferta';
                    $orderby = 'asc';
                    break;
                case '2':
                    $colum   =   'vlr_oferta';
                    $orderby = 'desc';
                    break;
                case '3':
                    $colum   =   'vlr_oferta';
                    $orderby = 'asc';
                    break;
            }
        }else{
            $colum   =   'vlr_oferta';
            $orderby = 'asc';
        }
        $imovel = Imovel::where('finalidade', '=', 'Locacao')
                    ->orderBy($colum, $orderby)
                    ->paginate(10);

        $imoveis = $this->getRetorno($imovel);

        $tp_bem_venda   = DB::table('imovel')
                        ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                        ->where('finalidade', '=', 'Venda')
                        ->groupBy('tp_bem')
                        ->get();

        $tp_bem_locacao  = DB::table('imovel')
                        ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                        ->where('finalidade', '=', 'Locacao')
                        ->groupBy('tp_bem')
                        ->get();

        return view('locacao', compact('imovel', 'imoveis', 'tp_bem_venda', 'tp_bem_locacao'));
    }

    public function busca_rapida(Request $request)
    {
        $busca = $request->all();

        if(isset($request['order'])){
            switch ($request['order']) {
                case '1':
                    $colum   =   'vlr_oferta';
                    $orderby = 'asc';
                    break;
                case '2':
                    $colum   =   'vlr_oferta';
                    $orderby = 'desc';
                    break;
                case '3':
                    $colum   =   'cod_bem';
                    $orderby = 'DESC';
                    break;
            }
        }else{
            $colum   =   'vlr_oferta';
            $orderby = 'asc';
        }

        $imovel = Imovel::where('finalidade', '=', $busca['finalidade'])
                    ->where('tp_bem', '=', $busca['tipo'])
                    ->orderBy($colum, $orderby)
                    ->paginate(10);

        $imoveis = $this->getRetorno($imovel);

        $tp_bem_venda   = DB::table('imovel')
                        ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                        ->where('finalidade', '=', 'Venda')
                        ->groupBy('tp_bem')
                        ->get();

        $tp_bem_locacao  = DB::table('imovel')
                        ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                        ->where('finalidade', '=', 'Locacao')
                        ->groupBy('tp_bem')
                        ->get();

        return view('busca_rapida', compact('imovel', 'imoveis', 'tp_bem_venda', 'tp_bem_locacao', 'busca'));
    }

    public function busca_avancada(Request $request)
    {
        $busca = $request->all();

        if(isset($busca['referencia'])){

            if(is_numeric($busca['referencia'])){
                $imovel = Imovel::where('id_imob', '=', '73')
                ->where('id', 'LIKE', '%' . $busca['referencia'] . '%')
                ->paginate(10);
            }else{
                $imovel = Imovel::where('id_imob', '=', '73')
                ->where('tp_bem', 'LIKE', '%' . $busca['referencia'] . '%')
                ->paginate(10);
            }

        }
        else
        if(isset($busca['finalidade']) && isset($busca['tipo']) && isset($busca['bairro'])){
            $imovel = Imovel::where('finalidade', '=', $busca['finalidade'])
            ->where('tp_bem', '=', $busca['tipo'])
            ->where('bairro', '=', $busca['bairro'])
            ->orderBy('vlr_oferta', 'asc')
            ->paginate(10);
        }
        else
        if(isset($busca['finalidade']) && isset($busca['tipo'])){
            $imovel = Imovel::where('finalidade', '=', $busca['finalidade'])
            ->where('tp_bem', '=', $busca['tipo'])
            ->orderBy('vlr_oferta', 'asc')
            ->paginate(10);
        }else
        if(isset($busca['finalidade'])){
            $imovel = Imovel::where('finalidade', '=', $busca['finalidade'])
            ->orderBy('vlr_oferta', 'asc')
            ->paginate(10);
        }

        if($imovel->total() == 0){
            $tp_bem_venda   = DB::table('imovel')
                    ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                    ->where('finalidade', '=', 'Venda')
                    ->groupBy('tp_bem')
                    ->get();

            $tp_bem_locacao  = DB::table('imovel')
                    ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                    ->where('finalidade', '=', 'Locacao')
                    ->groupBy('tp_bem')
                    ->get();

            return view('n_busca_rapida', compact('imovel', 'tp_bem_venda', 'tp_bem_locacao', 'busca'));
        }

        $imoveis = $this->getRetorno($imovel);

        $tp_bem_venda   = DB::table('imovel')
                    ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                    ->where('finalidade', '=', 'Venda')
                    ->groupBy('tp_bem')
                    ->get();

        $tp_bem_locacao  = DB::table('imovel')
                    ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                    ->where('finalidade', '=', 'Locacao')
                    ->groupBy('tp_bem')
                    ->get();

        return view('busca_rapida', compact('imovel', 'imoveis', 'tp_bem_venda', 'tp_bem_locacao', 'busca'));
    }

    public function imovel($descricao, $id)
    {
        $imv = Imovel::find($id);

        $img_name = 'imgr-'.sprintf("%09d", $imv->cod_bem).'.jpg';
        $url_img  = 'https://www.encontraimoveis.com.br/img/' . $img_name;

        $imovel =  [
            'tipo'          => (Util::getStringUTF8($imv->finalidade) == 'Locacao' ? 'LOCAÇÃO' : 'VENDA'),
            'cod_bem'       => $imv->cod_bem,
            'referencia'    => Util::formata($imv->id ,'ref'),
            'cidade'        => Util::getStringUTF8($imv->cidade) . '/' . $imv->uf,
            'endereco'      => Util::getStringUTF8($imv->endereco_1),
            'endereco_2'    => Util::getStringUTF8($imv->endereco_2),
            'complemento'   => Util::getStringUTF8($imv->complemento),
            'cep'           => Util::getStringUTF8($imv->cep),
            'bairro'        => Util::getStringUTF8($imv->bairro),
            'proximidade1'  => Util::getStringUTF8($imv->proximidade1),
            'proximidade2'  => Util::getStringUTF8($imv->proximidade2),
            'proximidade3'  => Util::getStringUTF8($imv->proximidade3),
            'proximidade4'  => Util::getStringUTF8($imv->proximidade4),
            'proximidade5'  => Util::getStringUTF8($imv->proximidade5),
            'img'           => $this->getImagemPrincipal($imv->cod_bem),
            'img_pach'      => $this->getImagemPatch($imv->cod_bem),
            'tp_bem'        => Util::getStringUTF8($imv->tp_bem),
            'finalidade'    => Util::getStringUTF8($imv->finalidade),
            'aplicacao'     => (Util::getStringUTF8($imv->aplicacao) == 'Misto' ? 'Residencial ou Comercial' : Util::getStringUTF8($imv->aplicacao)),
            'estrutura'     => Util::getStringUTF8($imv->estrutura),
            'estado'        => Util::getStringUTF8($imv->estado),
            'valor'         => 'R$ ' . number_format($imv->vlr_oferta, 0, ',', '.'),
            'vlr_locacao'           => 'R$ ' . number_format($imv->vlr_locacao, 0, ',', '.'),
            'vlr_rentabilidade'     => 'R$ ' . number_format($imv->vlr_rentabilidade, 0, ',', '.'),
            'vlr_financiamento'     => 'R$ ' . number_format($imv->vlr_financiamento, 0, ',', '.'),
            'vlr_sld_devedor'       => 'R$ ' . number_format($imv->vlr_sld_devedor, 0, ',', '.'),
            'vlr_direitos'          => 'R$ ' . number_format($imv->vlr_direitos, 0, ',', '.'),
            'vlr_poupanca'          => 'R$ ' . number_format($imv->vlr_poupanca, 0, ',', '.'),
            'vlr_parcela'           => 'R$ ' . number_format($imv->vlr_parcela, 0, ',', '.'),
            'vlr_iptu'              => 'R$ ' . number_format($imv->vlr_iptu, 0, ',', '.'),
            'vlr_condominio'        => 'R$ ' . number_format($imv->vlr_condominio, 0, ',', '.'),
            'area_total'    => ($imv->area_total > 0 ? number_format($imv->area_total, 2, ',', '.') . ' m<sup>2</sup>' : null),
            'area_util'     => ($imv->area_util > 0 ? number_format($imv->area_util, 2, ',', '.') . ' m<sup>2</sup>' : null),
            'qtde_quartos'  => ($imv->qtde_quartos      == 0 ? '' : $imv->qtde_quartos),
            'qtde_suites'   => ($imv->qtde_suites       == 0 ? '' : $imv->qtde_suites),
            'qtde_salas'    => ($imv->qtde_salas        == 0 ? '' : $imv->qtde_salas),
            'qtde_cozinha'  => ($imv->qtde_cozinhas     == 0 ? '' : $imv->qtde_cozinhas),
            'qtde_banheiro' => ($imv->qtde_banheiros    == 0 ? '' : $imv->qtde_banheiros),
            'qtde_garagens' => ($imv->qtde_garagens     == 0 ? '' : $imv->qtde_garagens),
            'qtde_aservico' => ($imv->qtde_area_servico == 0 ? '' : $imv->qtde_area_servico),
            'anuncio'       => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->anuncio)),
            'descr_adicional' => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->descr_adicional)),
            'observacao1'   => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->observacao1)),
            'observacao2'   => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->observacao2)),
            'observacao3'   => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->observacao3)),
            'observacao4'   => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->observacao4)),
            'estrutura'     => Util::getStringUTF8($imv->estrutura),
            'google_maps'   => Util::getGoogleMaps($imv->endereco_1, $imv->bairro, $imv->cidade . '-' . $imv->uf),
            'url_amigavel'  => Util::getStringUTF8($imv->finalidade) .
                                "+" . Util::getStringUTF8($imv->tp_bem) .
                                "+" . Util::getStringUTF8($imv->bairro)  .
                                "+" . Util::getStringUTF8($imv->cidade) . '-' . $imv->uf,
        ];


        $imovel['whatsapp'] = $this->getUrlWhatsApp($imovel);

        $string_benf = Util::getStringUTF8($imv->benfeitorias);
        $aBenf = $this->trataBenfeitoria($string_benf);
        $aBenf = explode(',', $aBenf);

        foreach ($aBenf as $kay=> $benf) {
            $aBenf[$kay] = Util::getStringUTF8(ltrim($benf));
        }

        $aBenf = array_filter($aBenf);
        $imovel['benfeitorias'] = $aBenf;

        $qtde = $this->contBenfeitoria($string_benf);

        foreach ($qtde as $key => $qtd) {

            if($qtd['item'] == 'DormitÃ³rio'){
                $imovel['qtde_quartos'] = $qtd['qtd'];
            }
            if($qtd['item'] == 'Banheiros'){
                $imovel['qtde_banheiro'] = $qtd['qtd'];
            }
            if($qtd['item'] == 'VAGA(S) DE GARAGEM'){
                $imovel['qtde_garagens'] = $qtd['qtd'];
            }
            if($qtd['item'] == 'SuÃ­te(s)'){
                $imovel['qtde_suites'] = $qtd['qtd'];
            }
            if($qtd['item'] == 'S/ SUÃ­TE'){

                if($imovel['qtde_suites'] != ''){
                    $imovel['qtde_suites'] =+ $qtd['qtd'];
                }else{
                    $imovel['qtde_suites'] = $qtd['qtd'];
                }

            }

        }

        return view('imovel', compact('imovel'));
    }

    private function getRetorno($aRetorno)
    {
        $i=0;

        $imoveis = [];

        foreach ($aRetorno as $imv) {

                //USAR LOCAL
                //$url_img  = 'https://www.encontraimoveis.com.br/img/' . $img_name;

                $imoveis[$i] =  [
                    'tipo'          => (Util::getStringUTF8($imv->finalidade) == 'Locacao' ? 'LOCAÇÃO' : 'VENDA'),
                    'cod_bem'       => $imv->cod_bem,
                    'referencia'    => Util::formata($imv->id ,'ref'),
                    'cidade'        => Util::getStringUTF8($imv->cidade) . '/' . $imv->uf,
                    'endereco'      => Util::getStringUTF8($imv->endereco_1),
                    'endereco_2'   => Util::getStringUTF8($imv->endereco_2),
                    'complemento'   => Util::getStringUTF8($imv->complemento),
                    'cep'           => Util::getStringUTF8($imv->cep),
                    'bairro'        => Util::getStringUTF8($imv->bairro),
                    'proximidade1'  => Util::getStringUTF8($imv->proximidade1),
                    'proximidade2'  => Util::getStringUTF8($imv->proximidade2),
                    'proximidade3'  => Util::getStringUTF8($imv->proximidade3),
                    'proximidade4'  => Util::getStringUTF8($imv->proximidade4),
                    'proximidade5'  => Util::getStringUTF8($imv->proximidade5),
                    'img'           => $this->getImagemPrincipal($imv->cod_bem),
                    'img_pach'      => $this->getImagemPatch($imv->cod_bem),
                    'tp_bem'        => Util::getStringUTF8($imv->tp_bem),
                    'finalidade'    => (Util::getStringUTF8($imv->finalidade) == 'Locacao' ? 'Locação' : 'Venda'),
                    'aplicacao'     => (Util::getStringUTF8($imv->aplicacao) == 'Misto' ? 'Residencial ou Comercial' : Util::getStringUTF8($imv->aplicacao)),
                    'estrutura'     => Util::getStringUTF8($imv->estrutura),
                    'estado'        => Util::getStringUTF8($imv->estado),
                    'valor'         => 'R$ ' . number_format($imv->vlr_oferta, 0, ',', '.'),
                    'vlr_locacao'           => 'R$ ' . number_format($imv->vlr_locacao, 0, ',', '.'),
                    'vlr_rentabilidade'     => 'R$ ' . number_format($imv->vlr_rentabilidade, 0, ',', '.'),
                    'vlr_financiamento'     => 'R$ ' . number_format($imv->vlr_financiamento, 0, ',', '.'),
                    'vlr_sld_devedor'       => 'R$ ' . number_format($imv->vlr_sld_devedor, 0, ',', '.'),
                    'vlr_direitos'          => 'R$ ' . number_format($imv->vlr_direitos, 0, ',', '.'),
                    'vlr_poupanca'          => 'R$ ' . number_format($imv->vlr_poupanca, 0, ',', '.'),
                    'vlr_parcela'           => 'R$ ' . number_format($imv->vlr_parcela, 0, ',', '.'),
                    'vlr_iptu'              => 'R$ ' . number_format($imv->vlr_iptu, 0, ',', '.'),
                    'vlr_condominio'        => 'R$ ' . number_format($imv->vlr_condominio, 0, ',', '.'),
                    'area_total'    => ($imv->area_total > 0 ? number_format($imv->area_total, 2, ',', '.') . ' m<sup>2</sup>' : null),
                    'area_util'     => ($imv->area_util > 0 ? number_format($imv->area_util, 2, ',', '.') . ' m<sup>2</sup>' : null),
                    'qtde_quartos'  => ($imv->qtde_quartos      == 0 ? '' : $imv->qtde_quartos),
                    'qtde_suites'   => ($imv->qtde_suites       == 0 ? '' : $imv->qtde_suites),
                    'qtde_salas'    => ($imv->qtde_salas        == 0 ? '' : $imv->qtde_salas),
                    'qtde_cozinha'  => ($imv->qtde_cozinhas     == 0 ? '' : $imv->qtde_cozinhas),
                    'qtde_banheiro' => ($imv->qtde_banheiros    == 0 ? '' : $imv->qtde_banheiros),
                    'qtde_garagens' => ($imv->qtde_garagens     == 0 ? '' : $imv->qtde_garagens),
                    'qtde_aservico' => ($imv->qtde_area_servico == 0 ? '' : $imv->qtde_area_servico),
                    'dt_reserva'    => $imv->dt_reserva,
                    'anuncio'       => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->anuncio)),
                    'descr_adicional' => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->descr_adicional)),
                    'observacao1'   => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->observacao1)),
                    'observacao2'   => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->observacao2)),
                    'observacao3'   => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->observacao3)),
                    'observacao4'   => Util::getStringUTF8(str_replace(chr(10), '<br>', $imv->observacao4)),
                    'estrutura'     => Util::getStringUTF8($imv->estrutura),
                    'google_maps'   => Util::getGoogleMaps($imv->endereco_1, $imv->bairro, $imv->cidade . '-' . $imv->uf),
                    'url_amigavel'  => Util::getStringUTF8($imv->finalidade) .
                                        "+" . Util::getStringUTF8($imv->tp_bem) .
                                        "+" . Util::getStringUTF8($imv->bairro)  .
                                        "+" . Util::getStringUTF8($imv->cidade) . '-' . $imv->uf,
            ];

            $imoveis[$i]['whatsapp'] = $this->getUrlWhatsApp($imoveis[$i]);

            $string_benf = Util::getStringUTF8($imv->benfeitorias);
            $qtde = $this->contBenfeitoria($string_benf);

            foreach ($qtde as $key => $qtd) {

                if($qtd['item'] == 'DormitÃ³rio'){
                    $imoveis[$i]['qtde_quartos'] = $qtd['qtd'];
                }
                if($qtd['item'] == 'Banheiros'){
                    $imoveis[$i]['qtde_banheiro'] = $qtd['qtd'];
                }
                if($qtd['item'] == 'VAGA(S) DE GARAGEM'){
                    $imoveis[$i]['qtde_garagens'] = $qtd['qtd'];
                }
                if($qtd['item'] == 'SuÃ­te(s)'){
                    $imoveis[$i]['qtde_suites'] = $qtd['qtd'];
                }
                if($qtd['item'] == 'S/ SUÃ­TE'){

                    if($imoveis[$i]['qtde_suites'] != ''){
                        $imoveis[$i]['qtde_suites'] =+ $qtd['qtd'];
                    }else{
                        $imoveis[$i]['qtde_suites'] = $qtd['qtd'];
                    }

                }

            }

            $i++;
        }

        return $imoveis;

    }

    private function getUrlWhatsApp($aDados)
    {
        $url =  'https://api.whatsapp.com/';
        $url .= 'send?l=pt-BR&';
        $url .= 'text=';
        $url .= '%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D';
        $url .= '%0A%';
        $url .= '20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20IM%C3%93VEL%20'. $aDados['tipo'];
        $url .= '%0A';
        $url .= '%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D';
        $url .= '%0A';
        $url .= '*REF%3A*%20'. $aDados['referencia'];
        $url .= '%0A';
        $url .= '*Cidade%3A*%20' . $aDados['cidade'];
        $url .= '%0A';
        $url .= '*Bairro%3A*%20' . $aDados['bairro'];
        $url .= '%0A';
        $url .= '*Tipo%3A*%20'. $aDados['tp_bem'];
        $url .= '%0A*';
        $url .= 'Aplica%C3%A7%C3%A3o%3A*%20'. $aDados['aplicacao'];
        $url .= '%0A*';
        $url .= 'Valor%3A*%20'. $aDados['valor'];
        $url .= '%0A';
        $url .= '%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D';
        $url .= '%0A';
        $url .= '%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D';
        if($aDados['tipo'] == 'VENDA'){
            $url .= '&phone=5544999765500';
        }else{
            $url .= '&phone=5544999765500';
        }

        return $url;
    }

    private function trataBenfeitoria($string, $chSeparador=", ")
    {
        $benf = new BenfCruz;
        $dataProvider = $benf::all();

        foreach ($dataProvider as $data) {
            $return[$data->id] = $data->aLegenda;
        }

        $benfe = explode(',', $string);

        foreach ($benfe as $benfeitoria) {
            $ids[] = explode('[', str_replace(' ', '', $benfeitoria));
        }

        $benfeitorias = '';

        foreach ($ids as $id) {
            // $qtd = substr($id[1], -2,1);
            // $qtd = substr($id[1], -9,7);
            if (isset($id[1])) {
                $qtd = substr($id[1], 1, -1);
            } else {
                $qtd = 0;
            }
            if (isset($id[1][0])) {
                $tp = $id[1][0];
            } else {
                $tp = "";
            }
            if (isset($return[$id[0]])) {
                $item = $return[$id[0]];
            } else {
                $item = "";
            }

            $benfeitorias .= $this->TrataTipoBenfeitoria($item, $tp, $qtd) . $chSeparador;
        }
        return $benfeitorias;
    }

    private function contBenfeitoria($string, $chSeparador=", ")
    {
        $benf = new BenfCruz;
        $dataProvider = $benf::all();

        foreach ($dataProvider as $data) {
            $return[$data->id] = $data->aLegenda;
        }

        $benfe = explode(',', $string);

        foreach ($benfe as $benfeitoria) {
            $ids[] = explode('[', str_replace(' ', '', $benfeitoria));
        }

        $benfeitorias = [];
        $i            = 0;

        foreach ($ids as $id) {
            // $qtd = substr($id[1], -2,1);
            // $qtd = substr($id[1], -9,7);
            if (isset($id[1])) {
                $qtd = substr($id[1], 1, -1);
            } else {
                $qtd = 0;
            }
            if (isset($id[1][0])) {
                $tp = $id[1][0];
            } else {
                $tp = "";
            }
            if (isset($return[$id[0]])) {
                $item = $return[$id[0]];
            } else {
                $item = "";
            }

            $benfeitorias[$i] = [
                'item'      => $item,
                'tp'        => $tp,
                'qtd'       => $qtd,
                'tratado'   => $this->TrataTipoBenfeitoria($item, $tp, $qtd)
            ];

            $i++;
        }
        return $benfeitorias;
    }

    private function TrataTipoBenfeitoria($benf, $tp, $qt)
    {
        switch ($tp) {
            case 'F' : {
                    if (strpos(strtoupper($benf), 'CONVENIO_') === FALSE){
                        return $benf;
                    } else{
                        return '';
                    }
                    break;
                }
            case 'Q' : {
                    return substr($qt, -2, 1) . " " . $benf;
                    break;
                }
            case 'M' : {
                    return substr($benf, 0, -2) . " " . number_format($qt, 2, ",", "") . " m&sup2;";
                    //return substr($benf, 0, -2) . " " . $qt . " m&sup2;";
                    break;
                }
            case 'A' : {
                    return substr($benf, 0, -2) . " " . $qt . "";
                    break;
                }
            case 'V' : {
                    return $benf . " " . "R$ " . $qt;
                    break;
                }
            case '' : {
                    return $qt;
                    break;
                }
            default : {
                    return $qt . " " . $benf;
                    break;
                }
        }
    }

    private function getImagemPrincipal($id_bem)
    {
        $aPath = '/home/sambura/img/';
        //$aPath = '/opt/www/nossolar/public/img/';
            $aNome = sprintf("????-%09d.???", $id_bem);
            $aArrayArq = glob($aPath . $aNome);

            $aArrayPrefixos = [
            'imgr', 'im01', 'impl', 'im02', 'im03', 'im04', 'im05',
            'im06', 'im07', 'im08', 'im09', 'im10', 'im11', 'im12', 'im13','im14', 'im15','im15','im16','im17','im18','im19','im20',
            ];

            foreach($aArrayPrefixos as $aPref) {
                if(strlen(trim($aPref)) <= 0) {
                    continue;
                }
                for($nIdx=0; $nIdx < count($aArrayArq); $nIdx++) {
                    if(strlen(trim($aArrayArq[$nIdx])) > 0) {
                        $aArrayArq[$nIdx] = str_replace($aPath, "", $aArrayArq[$nIdx]);
                        if(strstr($aArrayArq[$nIdx], $aPref) ) {
                            // imagem principal
                            $aArrayRtn[] = $aArrayArq[$nIdx];
                            $aArrayArq[$nIdx] = "";
                            break;
                        }
                    }
                }
            }

            if(isset($aArrayRtn)){
                $imagem_0 = $aArrayRtn[0];
                $imagem_1 = array_filter($aArrayArq);
                $url = 'https://www.encontraimoveis.com.br/img/';
                $url_img = $url . $imagem_0;
                //$url_img  = (Storage::disk('public')->exists('img/' . $imagem_0) ? $url . $imagem_0 : asset('images/logo.png'));
            }else{
                $url_img = asset('images/imovel-sem-foto3.jpg');
            }

            return $url_img;

    }

    private function getImagemPatch($id_bem)
    {
        //$aPath = '/home/jmimobiliaria/novo.jmimobiliariaivp.com.br/public/storage/img/';
        ///home/sambura/public_html/img/im01-000039050.jpg
        $aPath = '/home/sambura/img/';
        $aNome = sprintf("????-%09d.???", $id_bem);
        $aArrayArq = glob($aPath . $aNome);

       	$aNewArray = [];
       	$i=1;

            foreach($aArrayArq as $img) {
                $str = substr($img, 18);
                $str_c = substr($str, 0, 4);

                if($str_c == "imgr"){
                    $aNewArray[0] = $str;
                    $i++;
                }else{
                    $aNewArray[$i] = $str;
                    $i++;
                }

            }

            ksort($aNewArray);
            $url = 'https://www.encontraimoveis.com.br/img/';

            foreach($aNewArray as $kay => $img){
                $imagem_1[$kay] = $url . $img;
                //$imagem_1[$kay] = (Storage::disk('public')->exists('img/' . $img) ? $url . $img : asset('images/imovel-sem-foto3.jpg'));
            }

            if(!isset($imagem_1)){
                $imagem_1 = '';
            }

            return $imagem_1;

    }
}
