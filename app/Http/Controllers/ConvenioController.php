<?php

namespace App\Http\Controllers;

use App\Convenio;
use Illuminate\Http\Request;

class ConvenioController extends Controller
{
    public function getConvenios(){

        $convenios = Convenio::select('codigo', 'nome')->orderBy('nome')->get();

        return response()->json($convenios);
    }
}
