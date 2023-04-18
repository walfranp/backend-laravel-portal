<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenericLog extends Model
{
    private $nome_arqivo;
    private $nome_pasta;
    private $id;

    public function __construct($nome, $id)
    {
        $data = date("d/m/Y");
        $data_formatada = substr($data, 0, 2) . "." . substr($data, 3, 2) . "." . substr($data, 6, 4);

        $this->nome_arqivo = $nome . "_" . $id . "_" . $data_formatada . '.log';
        $this->nome_pasta = $nome . '-logs';
        $this->id = $id;
    }

    public function log($titulo = null, $descricao)
    {

        if ($titulo != null) {

            $arquivo = fopen(storage_path() . '/logs' . '/' . $this->nome_arqivo, 'a');
            $linha = "+--------------------------------------------------------------------+" . "\n"
            . "[" . date("d/m/Y H:i:s") . "]" . " - " . $titulo . "\n"
                . "+--------------------------------------------------------------------+" . "\n"
                . $descricao . "\n";
          //      . "----------------------------------------------------------------------" . "\n" . "\n";
            fwrite($arquivo, $linha);

            fclose($arquivo);

        } else {

            $arquivo = fopen(storage_path() . '/logs' . '/' . $this->nome_arqivo, 'a');
            $linha = $descricao . "\n";
          //      . "----------------------------------------------------------------------" . "\n" . "\n";
            fwrite($arquivo, $linha);
            fclose($arquivo);

        }

    }

}
