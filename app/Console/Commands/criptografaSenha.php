<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class criptografaSenha extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'criptografa:senha';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seta o campo password com o cpf e criptografa...';

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
        $users = User::all();

        $totalUsers = count($users);
        $this->output->progressStart($totalUsers);

        foreach($users as $user){

            $user->password = bcrypt($user->cpf);
            $user->save(); 

            $this->output->progressAdvance();

        }

        $this->output->progressFinish();
        $this->info("Senhas criptografadas com sucesso!");

    }
}
