<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Imovel
 *
 * @property int $cod_bem
 * @property int $id_imob
 * @property int $id
 * @property int $trata_endereco
 * @property string|null $endereco_1
 * @property string|null $endereco_2
 * @property string|null $complemento
 * @property string|null $cidade
 * @property string|null $uf
 * @property int|null $cep
 * @property string|null $bairro
 * @property string $incorporacao
 * @property string $quadra
 * @property string $lote
 * @property float|null $area_total
 * @property float|null $area_util
 * @property int|null $qtde_quartos
 * @property int|null $qtde_suites
 * @property int|null $qtde_salas
 * @property int|null $qtde_cozinhas
 * @property int|null $qtde_banheiros
 * @property int|null $qtde_garagens
 * @property int|null $qtde_area_servico
 * @property string|null $observacao1
 * @property string|null $observacao2
 * @property string|null $observacao3
 * @property string|null $observacao4
 * @property string|null $proximidade1
 * @property string|null $proximidade2
 * @property string|null $proximidade3
 * @property string|null $proximidade4
 * @property string|null $proximidade5
 * @property string|null $regiao
 * @property string|null $estrutura
 * @property string|null $estrutura_Ajustada
 * @property string|null $benfeitorias
 * @property string|null $comentario
 * @property string|null $dt_reserva
 * @property string|null $tp_bem
 * @property string|null $tp_bem_Ajustado
 * @property string|null $finalidade
 * @property string|null $aplicacao
 * @property string|null $aplicacao_Cruzada
 * @property string|null $estado
 * @property int|null $nClasse
 * @property string|null $tp_financ
 * @property int|null $anos_financ
 * @property int|null $meses_financ
 * @property int|null $anos_fim_financ
 * @property int|null $meses_fim_financ
 * @property float|null $vlr_oferta
 * @property float|null $vlr_locacao
 * @property float|null $vlr_rentabilidade
 * @property float|null $vlr_financiamento
 * @property float|null $vlr_sld_devedor
 * @property float|null $vlr_direitos
 * @property float|null $vlr_poupanca
 * @property float|null $vlr_parcela
 * @property float|null $vlr_condominio
 * @property float|null $vlr_iptu
 * @property string|null $imagem
 * @property string|null $planta_baixa
 * @property string|null $imagem1
 * @property string|null $imagem2
 * @property string|null $imagem3
 * @property string|null $imagem4
 * @property string|null $imagem5
 * @property string|null $imagem6
 * @property string|null $imagem7
 * @property string|null $imagem8
 * @property string|null $imagem9
 * @property string|null $imagem10
 * @property string|null $video
 * @property int $destaque
 * @property int $lista
 * @property int $visualizacao
 * @property string $utima
 * @property int $informacao
 * @property int $lancamento
 * @property int $oportunidade
 * @property int $recomendacao
 * @property string|null $anuncio
 * @property string|null $descr_adicional
 * @property bool $familia
 * @property bool $casal
 * @property bool $idosos
 * @property bool $estudantes
 * @property bool $diversidade
 * @property bool $empresario
 * @property bool $mulher
 * @property bool $solteiro
 * @property Carbon|null $data_inc
 * @property string $angariador
 * @property Carbon|null $dt_opcao
 * @property float $lat
 * @property float $lng
 * @property Carbon|null $dt_latlng
 * @property string $aImagem
 * @property string $aAlbum
 * @property int|null $nSituacao
 * @property string|null $integracao
 * @property int $nPermiteVender
 * @property string|null $aPaginaExibicao
 *
 * @package App\Models
 */
class Imovel extends Model
{
	protected $table = 'imovel';
	protected $primaryKey = 'cod_bem';
	public $timestamps = false;

	protected $casts = [
		'id_imob' => 'int',
		'id' => 'int',
		'trata_endereco' => 'int',
		'cep' => 'int',
		'area_total' => 'float',
		'area_util' => 'float',
		'qtde_quartos' => 'int',
		'qtde_suites' => 'int',
		'qtde_salas' => 'int',
		'qtde_cozinhas' => 'int',
		'qtde_banheiros' => 'int',
		'qtde_garagens' => 'int',
		'qtde_area_servico' => 'int',
		'nClasse' => 'int',
		'anos_financ' => 'int',
		'meses_financ' => 'int',
		'anos_fim_financ' => 'int',
		'meses_fim_financ' => 'int',
		'vlr_oferta' => 'float',
		'vlr_locacao' => 'float',
		'vlr_rentabilidade' => 'float',
		'vlr_financiamento' => 'float',
		'vlr_sld_devedor' => 'float',
		'vlr_direitos' => 'float',
		'vlr_poupanca' => 'float',
		'vlr_parcela' => 'float',
		'vlr_condominio' => 'float',
		'vlr_iptu' => 'float',
		'destaque' => 'int',
		'lista' => 'int',
		'visualizacao' => 'int',
		'informacao' => 'int',
		'lancamento' => 'int',
		'oportunidade' => 'int',
		'recomendacao' => 'int',
		'familia' => 'bool',
		'casal' => 'bool',
		'idosos' => 'bool',
		'estudantes' => 'bool',
		'diversidade' => 'bool',
		'empresario' => 'bool',
		'mulher' => 'bool',
		'solteiro' => 'bool',
		'lat' => 'float',
		'lng' => 'float',
		'nSituacao' => 'int',
		'nPermiteVender' => 'int'
	];

	protected $dates = [
		'data_inc',
		'dt_opcao',
		'dt_latlng'
	];

	protected $fillable = [
		'id_imob',
		'id',
		'trata_endereco',
		'endereco_1',
		'endereco_2',
		'complemento',
		'cidade',
		'uf',
		'cep',
		'bairro',
		'incorporacao',
		'quadra',
		'lote',
		'area_total',
		'area_util',
		'qtde_quartos',
		'qtde_suites',
		'qtde_salas',
		'qtde_cozinhas',
		'qtde_banheiros',
		'qtde_garagens',
		'qtde_area_servico',
		'observacao1',
		'observacao2',
		'observacao3',
		'observacao4',
		'proximidade1',
		'proximidade2',
		'proximidade3',
		'proximidade4',
		'proximidade5',
		'regiao',
		'estrutura',
		'estrutura_Ajustada',
		'benfeitorias',
		'comentario',
		'dt_reserva',
		'tp_bem',
		'tp_bem_Ajustado',
		'finalidade',
		'aplicacao',
		'aplicacao_Cruzada',
		'estado',
		'nClasse',
		'tp_financ',
		'anos_financ',
		'meses_financ',
		'anos_fim_financ',
		'meses_fim_financ',
		'vlr_oferta',
		'vlr_locacao',
		'vlr_rentabilidade',
		'vlr_financiamento',
		'vlr_sld_devedor',
		'vlr_direitos',
		'vlr_poupanca',
		'vlr_parcela',
		'vlr_condominio',
		'vlr_iptu',
		'imagem',
		'planta_baixa',
		'imagem1',
		'imagem2',
		'imagem3',
		'imagem4',
		'imagem5',
		'imagem6',
		'imagem7',
		'imagem8',
		'imagem9',
		'imagem10',
		'video',
		'destaque',
		'lista',
		'visualizacao',
		'utima',
		'informacao',
		'lancamento',
		'oportunidade',
		'recomendacao',
		'anuncio',
		'descr_adicional',
		'familia',
		'casal',
		'idosos',
		'estudantes',
		'diversidade',
		'empresario',
		'mulher',
		'solteiro',
		'data_inc',
		'angariador',
		'dt_opcao',
		'lat',
		'lng',
		'dt_latlng',
		'aImagem',
		'aAlbum',
		'nSituacao',
		'integracao',
		'nPermiteVender',
		'aPaginaExibicao'
	];
}
