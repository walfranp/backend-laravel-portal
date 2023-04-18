<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\GenericLog;

class testelog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:testelog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command para teste de log generico';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       
        $gLog = new GenericLog('checklist', 22);

        $gLog->log("GRAVANDO DADOS INICIAIS", "Gravando dados iniciais com os valores...");
        $gLog->log(null, "tais e tais...");
        $gLog->log(null, "tais e tais...");
        $gLog->log(null, "tais e tais...");
        $gLog->log("DESCARREGANDO RESPOSTAS", "Descarregando 50 respostas...");



    }
}
