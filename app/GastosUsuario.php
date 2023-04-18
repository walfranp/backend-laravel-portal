<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GastosUsuario extends Model
{
    protected $fillable = [
        'usuario', 'convenio', 'valor', 'mesref', 'anoref'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'usuario', 'id_externo');
    }

    public function convenio()
    {
        return $this->belongsTo('App\Convenio', 'convenio', 'codigo');
    }

    public function mesPorExtenso($mes)
    {

        switch ($mes) {
            case 1:
                return "JANEIRO";
                break;
            case 2:
                return "FEVEREIRO";
                break;
            case 3:
                return "MARÇO";
                break;
            case 4:
                return "ABRIL";
                break;
            case 5:
                return "MAIO";
                break;
            case 6:
                return "JUNHO";
                break;
            case 7:
                return "JULHO";
                break;
            case 8:
                return "AGOSTO";
                break;
            case 9:
                return "SETEMBRO";
                break;
            case 10:
                return "OUTUBRO";
                break;
            case 11:
                return "NOVEMBRO";
                break;
            case 12:
                return "DEZEMBRO";
                break;
        }

    }

    public function getGastoMensal($mes, $ano)
    {

        $gastos = DB::table('gastos_usuarios')
            ->leftJoin('users', 'gastos_usuarios.usuario', '=', 'users.id_externo')
            ->leftJoin('convenios', 'gastos_usuarios.convenio', '=', 'convenios.codigo')
            ->where('gastos_usuarios.usuario', '=', Auth::user()->id_externo)
            ->where('gastos_usuarios.mesref', '=', $mes)
            ->where('gastos_usuarios.anoref', '=', $ano)
            ->select('users.matricula', 'users.name', 'convenios.nome as convenio', 'gastos_usuarios.valor')
            ->get();

        $valor_total = DB::table('gastos_usuarios')
            ->leftJoin('users', 'gastos_usuarios.usuario', '=', 'users.id_externo')
            ->leftJoin('convenios', 'gastos_usuarios.convenio', '=', 'convenios.codigo')
            ->where('gastos_usuarios.usuario', '=', Auth::user()->id_externo)
            ->where('gastos_usuarios.mesref', '=', $mes)
            ->where('gastos_usuarios.anoref', '=', $ano)
            ->sum('gastos_usuarios.valor');

        $dados = [
            'nome' => Auth::user()->name,
            'cpf' => Auth::user()->cpf,
            'mes' => $this->mesPorExtenso($mes),
            'ano' => $ano,
            'total' => number_format($valor_total,2,",","."),
            'gastos' => $gastos,

        ];

        return $dados;

    }

    public function getGastoSaude($ano)
    {

        $gastos_unimed = DB::table('gastos_usuarios')
            ->leftJoin('users', 'gastos_usuarios.usuario', '=', 'users.id_externo')
            ->leftJoin('convenios', 'gastos_usuarios.convenio', '=', 'convenios.codigo')
            ->where('gastos_usuarios.usuario', '=', Auth::user()->id_externo)
            ->whereIn('gastos_usuarios.convenio', [69, 110, 116])
            ->where('gastos_usuarios.anoref', '=', $ano)
            ->select('users.matricula', 'users.name', 'convenios.nome as convenio', 'gastos_usuarios.valor', 'gastos_usuarios.anoref',
                \DB::raw('(CASE

            WHEN gastos_usuarios.mesref = "1" THEN "JANEIRO"
            WHEN gastos_usuarios.mesref = "2" THEN "FEVEREIRO"
            WHEN gastos_usuarios.mesref = "3" THEN "MARÇO"
            WHEN gastos_usuarios.mesref = "4" THEN "ABRIL"
            WHEN gastos_usuarios.mesref = "5" THEN "MAIO"
            WHEN gastos_usuarios.mesref = "6" THEN "JUNHO"
            WHEN gastos_usuarios.mesref = "7" THEN "JULHO"
            WHEN gastos_usuarios.mesref = "8" THEN "AGOSTO"
            WHEN gastos_usuarios.mesref = "9" THEN "SETEMBRO"
            WHEN gastos_usuarios.mesref = "10" THEN "OUTUBRO"
            WHEN gastos_usuarios.mesref = "11" THEN "NOVEMBRO"
            WHEN gastos_usuarios.mesref = "12" THEN "DEZEMBRO"
            ELSE "?"
            END) AS mes'))
            ->orderBy('gastos_usuarios.mesref')
            ->orderBy('gastos_usuarios.convenio')
            ->get();

        $valor_total_unimed = DB::table('gastos_usuarios')
            ->leftJoin('users', 'gastos_usuarios.usuario', '=', 'users.id_externo')
            ->leftJoin('convenios', 'gastos_usuarios.convenio', '=', 'convenios.codigo')
            ->where('gastos_usuarios.usuario', '=', Auth::user()->id_externo)
            ->whereIn('gastos_usuarios.convenio', [69, 110, 116])
            ->where('gastos_usuarios.anoref', '=', $ano)
            ->sum('gastos_usuarios.valor');

        $gastos_uniodonto = DB::table('gastos_usuarios')
            ->leftJoin('users', 'gastos_usuarios.usuario', '=', 'users.id_externo')
            ->leftJoin('convenios', 'gastos_usuarios.convenio', '=', 'convenios.codigo')
            ->where('gastos_usuarios.usuario', '=', Auth::user()->id_externo)
            ->whereIn('gastos_usuarios.convenio', [119])
            ->where('gastos_usuarios.anoref', '=', $ano)
            ->select('users.matricula', 'users.name', 'convenios.nome as convenio', 'gastos_usuarios.valor', 'gastos_usuarios.anoref',
                \DB::raw('(CASE

            WHEN gastos_usuarios.mesref = "1" THEN "JANEIRO"
            WHEN gastos_usuarios.mesref = "2" THEN "FEVEREIRO"
            WHEN gastos_usuarios.mesref = "3" THEN "MARÇO"
            WHEN gastos_usuarios.mesref = "4" THEN "ABRIL"
            WHEN gastos_usuarios.mesref = "5" THEN "MAIO"
            WHEN gastos_usuarios.mesref = "6" THEN "JUNHO"
            WHEN gastos_usuarios.mesref = "7" THEN "JULHO"
            WHEN gastos_usuarios.mesref = "8" THEN "AGOSTO"
            WHEN gastos_usuarios.mesref = "9" THEN "SETEMBRO"
            WHEN gastos_usuarios.mesref = "10" THEN "OUTUBRO"
            WHEN gastos_usuarios.mesref = "11" THEN "NOVEMBRO"
            WHEN gastos_usuarios.mesref = "12" THEN "DEZEMBRO"
            ELSE "?"
            END) AS mes'))
            ->orderBy('gastos_usuarios.mesref')
            ->orderBy('gastos_usuarios.convenio')
            ->get();

        $valor_total_uniodonto = DB::table('gastos_usuarios')
            ->leftJoin('users', 'gastos_usuarios.usuario', '=', 'users.id_externo')
            ->leftJoin('convenios', 'gastos_usuarios.convenio', '=', 'convenios.codigo')
            ->where('gastos_usuarios.usuario', '=', Auth::user()->id_externo)
            ->whereIn('gastos_usuarios.convenio', [119])
            ->where('gastos_usuarios.anoref', '=', $ano)
            ->sum('gastos_usuarios.valor');

        $dados = [
            'nome' => Auth::user()->name,
            'cpf' => Auth::user()->cpf,
            'matricula' => Auth::user()->matricula,
            'ano' => $ano,
            'gastos_unimed' => $gastos_unimed,
            'total_unimed' => number_format($valor_total_unimed,2,",","."),
            'gastos_uniodonto' => $gastos_uniodonto,
            'total_uniodonto' => number_format($valor_total_uniodonto,2,",","."),

        ];

        return $dados;

    }


    public function getTotalGastos($mes, $ano)
    {

        $valor_total = DB::table('gastos_usuarios')
            ->leftJoin('users', 'gastos_usuarios.usuario', '=', 'users.id_externo')
            ->leftJoin('convenios', 'gastos_usuarios.convenio', '=', 'convenios.codigo')
            ->where('gastos_usuarios.usuario', '=', Auth::user()->id_externo)
            ->where('gastos_usuarios.mesref', '=', $mes)
            ->where('gastos_usuarios.anoref', '=', $ano)
            ->sum('gastos_usuarios.valor');

        $dados = [
            'nome' => Auth::user()->name,
            'mes' => $this->mesPorExtenso($mes),
            'ano' => $ano,
            'total' => number_format($valor_total,2,",","."),
        ];

        return $dados;

    }

}
