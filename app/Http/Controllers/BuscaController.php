<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Util;

class BuscaController extends Controller
{
    public function getBuscaTipo(Request $request)
    {
        $finalidade = $request['finalidade'];

        $data   = DB::table('imovel')
                    ->select('tp_bem', DB::raw('count(*) as count, tp_bem'))
                    ->where('finalidade', '=', $finalidade)
                    ->groupBy('tp_bem')
                    ->get();

        foreach($data as $d){
            if($d->tp_bem !== ''){
             $aData['data'][$d->tp_bem] = Util::getStringUf8($d->tp_bem) . ' ('. $d->count .')';
            }
        }

        return response($aData, 200);
    }

    public function getBuscaBairro(Request $request)
    {
        $finalidade = $request['finalidade'];
        $tipo = $request['tipo'];

        $data   = DB::table('imovel')
                    ->select('bairro', DB::raw('count(*) as count, bairro'))
                    ->where('finalidade', '=', $finalidade)
                    ->where('tp_bem', '=', $tipo)
                    ->groupBy('bairro')
                    ->get();

        foreach($data as $d){
            $aData['data'][$d->bairro] = Util::getStringUf8($d->bairro) . ' ('. $d->count .')';
        }

        return response($aData, 200);
    }
}
