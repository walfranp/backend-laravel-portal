<?php

namespace App\Http\Controllers;

use App;
use App\GastosUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GastosController extends Controller
{
    public function gastosMensal(Request $request)
    {

        $params = $request->all();
        $modelo = new GastosUsuario();
        $dados = $modelo->getGastoMensal($params['mes_ref'], $params['ano_ref']);

        return response()->json($dados);

    }

    public function getUltimosGastos(Request $request)
    {
        $dados = 0;
        $params = $request->all();
        $modelo = new GastosUsuario();
        $dados = $modelo->getTotalGastos($params['mes_ref'], $params['ano_ref']);

        for ($i = $params['mes_ref']; $i > 0; $i--) {

            if ($dados['total'] == 0) {
                $dados = $modelo->getTotalGastos($i, $params['ano_ref']);
            }
        }

        if ($dados['total'] == 0) {
            $dados = $modelo->getTotalGastos(12, $params['ano_ref'] - 1);
        }

        return response()->json($dados);

    }

    public function gastosSaude(Request $request)
    {
        $params = $request->all();
        $modelo = new GastosUsuario();
        $dados = $modelo->getGastoSaude($params['ano_ref']);

        return response()->json($dados);

    }

    public function gastosMensais(Request $request)
    {
        $params = $request->all();
        $gastosMensais = GastosUsuario::where('usuario', Auth::user()->id_externo)
            ->where('anoref', $params['ano_ref'])
            ->select(DB::raw('SUM(valor) as total'), 'mesref')
            ->groupBy('mesref')->get();

        $response = [];

        foreach ($gastosMensais as $gastoMensal) {

            $resultBuilder = [
                "mes" => $gastoMensal->mesPorExtenso($gastoMensal->mesref),
                "total" => $gastoMensal->total
            ];

            array_push($response, $resultBuilder);
        }

        return response()->json($response);
    }

    public function top5GastosMensais(Request $request)
    {
        $params = $request->all();
        $gastosTop5 = GastosUsuario::where('usuario', Auth::user()->id_externo)
        ->leftJoin('convenios', 'gastos_usuarios.convenio', '=', 'convenios.codigo')
            ->where('anoref', $params['ano_ref'])
            ->select(DB::raw('SUM(valor) as total'), 'convenios.nome')
            ->orderBy('total', 'DESC')->limit(5)
            ->groupBy('convenios.nome')->get();

        return response()->json($gastosTop5);
    }

}
